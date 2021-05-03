<?php 
    //*récupération des valeurs saisies et application sécurité

    foreach($_POST as $key => $val){
        $params[':' .$key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
    }

    //*crypte mail et pswd
    $params[':mail'] = md5(md5($params[':mail']).strlen($params[':mail']));
    $params[':pass'] = sha1(md5($params[':pass']).md5($params[':pass']));

    var_dump($_POST);
    var_dump($params);

    include_once('inc/constants.inc.php');
    //Teste si le mail n'existe pas déja 
    try{
        include_once('inc/constants.inc.php');
        //Connexion à la BDD
        $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DATA . ';port=' . PORT . ';charset=utf8', USER, PASS);
        //Options=> Gestion des attributs de la connexion : exception et retour du SELECT
        $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //Teste si le mail n'existe pas déja
        $sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail=?'; //paramétrage anonyme
        //Prépare la réquete - eviter injections sql
        $qry = $cnn -> prepare($sql);
        //Executon de la requête
        $qry ->execute(array($params[':mail']));//renvoie de la requete
        $row = $qry -> fetch();
        var_dump($row);
        if($row['nb'] == 1){
            echo '<p>Cette adresse mail existe déja</p>';
            echo '<a href = "index.php"> Retour à l\accueil </a>';
        } else{
            $sql ='INSERT INTO users(pseudo,mail,pass) VALUES (:pseudo, :mail, :pass)';
            $qry = $cnn->prepare($sql);
            $qry ->execute($params);
            //déconnexion de la variable
            unset($cnn);
            header('location:login.php?m=ccok');
        };
    } catch(PDOException $err){
        $err->getMessage();
    }

?>