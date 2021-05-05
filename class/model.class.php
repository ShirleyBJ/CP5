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