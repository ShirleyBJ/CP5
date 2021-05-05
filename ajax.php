<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Appel Ajax</title>
</head>
<body class="container">
    
    <h1>Liste des pays par langue parlé</h1>

    <?php
        include_once('inc/constants.inc.php');
        include_once('class/database.class.php');
    //Utilisation de la classe Database
        $db = new Database(HOST,DATA,USER,PASS);
    //Afficher toutes les régions
        $sql = 'SELECT DISTINCT language FROM countrylanguage ORDER BY language';
        echo $db->getHtmlSelect('lang',$sql);
    // Afficher les pays en fonction du select de langue parlé
    ?>
    <div id="pays" class='mt-3'>
    <?php
    echo $db->getHtmlTable('SELECT Code,Name,Continent,Region,SurfaceArea,IndepYear,Population,LifeExpectancy FROM country');
    ?>
    </div>
</body>
<script src="js/ajax.js"></script>
</html>