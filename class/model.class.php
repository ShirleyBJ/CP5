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

}

?>