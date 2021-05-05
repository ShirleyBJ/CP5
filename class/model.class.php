<?php
include_once('database.class.php');
include_once('../inc/constants.inc.php');

/**
 * Classe fille model qui hériçte de la classe mére Database
 * Objectif : CRUD
 */

final class Model extends Database{
    //Attributs privées de la classe
        private $db=null;
        private $table='';

    //Constructeurs
    public function __construct(string $newHost, string $newDbname, string $newUser, string $newPass, string $newTable)
    {
        //Assigne les valeurs des arguments aux attrobuts de la classe fille
        $this->setTable($newTable);
        //Assigne les valeurs des arguments aux attrobuts de la classe mére : connexion
        $this->db = new Database( $newHost,$newDbname,$newUser,$newPass);
    }

    //Accesseurs
    public function getTable() : string {
        return $this->table;
    }

    //Mutateurs
    public function setTable(string $newTable){
        $this->table = $newTable;
    }

//METHODES :

    /**
     * Méthode qui ajoute une nouvelle ligne dans la table (C de CRUD)
     * @param array $data - tableau associatif de type post contenant les valeurs à insérer dans la table 
     * @return int renvoie TRUE si insertion OK
     */
    public function create(array $data) : bool {
        //tentative d'insertion
        try{
            //Remplit le tableau de parametre pour la requete
            foreach($data as $key => $val){
                $params[':'.$key]=htmlspecialchars($val);
            }
            //prépare et exécute la requête
            //construction de la requete SQL
            $sql = 'INSERT INTO '.$this->getTable().'('.implode(',' , array_keys($data)).') VALUES('.implode(',' , array_keys($params)).')';//récupére nom des colonnes entre concat des parenthéses ouverte et fermante
            //préparation de la requête
            $qry=$this->db->cnn->prepare($sql);
            //exécution de la requete
            return $qry->execute($params);

        }catch(PDOException $err){
            throw new Exception(__CLASS__. ' : ' . $err->getMessage());
        }
    }

    /**
     * Renvoie toutes les lignes de la table 
     */
    public function readAll() : array {
        //définir la requête
        $sql='SELECT * FROM '. $this->getTable();
        return $this->db->getResult($sql);
    }

    /**
     * Renvoie une seule ligne de la table
     * @param string $pk - colonne clé primaire
     * @param string $id - valeur de la clé primaire
     * @return array - retourne un tableau correspondant au résultat demandé
     */
    public function read(string $pk, string $id) : array {
        //définir la requête
        $sql='SELECT * FROM '. $this->getTable() . ' WHERE ' . $pk . ' =?';
        $params = array($id);
        return $this->db->getResult($sql,$params);
    }

    


}

?>