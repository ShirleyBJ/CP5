<?php
/**
 * Mini framework ayant comme théme, connexions à une BDD MySQL ou MariaDB et exploitation
 */

class Database{
    //*Attributs privés
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $cnn; // généré par le constructeur pour obtenir une connexion
    private $connected=false; //généré par le constructeur

    //*Constructeurs
    //assignation des différents paramétre au variables de la classe
    public function __construct(string $newHost, string $newDbname, string $newUser, string $newPass)
    {
        //Assigne la valeur des paramétre au attributs
        $this -> setHost($newHost);
        $this -> setDbname($newDbname);
        $this -> setUser($newUser);
        $this -> setPass($newPass);

        //Tente une connexion à la BDD
        try{
            $this -> cnn = new PDO('mysql: host='. $this->getHost() . ' ;dname= ' . $this->getDbname() . '; charset=utf8', $this->getUser(),$this->getPass());
            //Options de connexion  : erreur + type de renvoie
            $this -> cnn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //Précise que lorsque connexion renvoie le résultat de la requéte,il le renvoie ss forme de tableau asssociatif
            $this -> cnn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $this -> connected = true;
        }catch(PDOException $err){
            throw new Exception(__CLASS__. ' : '. $err -> getMessage());
        }
    }

    //*Accesseurs
    public function getHost() : string {
        return $this -> host;
    }

    public function getDbname() : string{
        return $this -> dbname;
    }

    public function getUser() : string{
        return $this -> user;
    }

    public function getPass() : string{
        return $this -> pass;
    }

    //*Mutateurs
    public function setHost(string $newHost){
        $this -> host = $newHost;
    }

    public function setDbname(string $newDbname){
        $this -> dbname = $newDbname;
    }

    public function setUser(string $newUser){
        $this -> user = $newUser;
    }

    public function setPass(string $newPass){
        $this -> pass = $newPass;
    }
}


?>