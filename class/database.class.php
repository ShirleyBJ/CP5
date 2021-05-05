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
        $this->setHost($newHost);
        $this->setDbname($newDbname);
        $this->setUser($newUser);
        $this->setPass($newPass);

        //Tente une connexion à la BDD
        try{
            $this->cnn = new PDO('mysql: host='. $this->getHost() . ';dbname=' . $this->getDbname() . ';charset=utf8', $this->getUser(),$this->getPass());
            //Options de connexion  : erreur + type de renvoie
            $this->cnn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //Précise que lorsque connexion renvoie le résultat de la requéte,il le renvoie ss forme de tableau asssociatif
            $this->cnn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $this->connected = true;
        }catch(PDOException $err){
            throw new Exception(__CLASS__. ' : '. $err->getMessage());
        }
    }

    //*Accesseurs
    public function getHost() : string {
        return $this->host;
    }

    public function getDbname() : string{
        return $this->dbname;
    }

    public function getUser() : string{
        return $this->user;
    }

    public function getPass() : string{
        return $this->pass;
    }

    //*Mutateurs
    public function setHost(string $newHost){
        $this->host = $newHost;
    }

    public function setDbname(string $newDbname){
        $this->dbname = $newDbname;
    }

    public function setUser(string $newUser){
        $this->user = $newUser;
    }

    public function setPass(string $newPass){
        $this->pass = $newPass;
    }


    /**
     * * Méthode qui renvoie le résultat d'une réquête dont l'instruction est passé en paramétre sous la forme d'un tableau associatif
     * *Demande 2 paramétres :
     * @param string $sql - instruction sql préparé de type SELECT
     * @param array $params - valeur des paramétre pour la requête préparée
     * @return array  (renvoie sous la forme d'un  tableau associatif)
     */
    public function getResult(string $sql, array $params = array()) : array {
        try{
            //Prépare la réquête 
            $qry = $this->cnn->prepare($sql);
            //Exécution de la requete
            $qry->execute($params);
            //Renvoie du tab
            return $qry->fetchAll();
        } catch(PDOException $err){
            throw new Exception(__CLASS__ . ' : '. $err->getMessage());
        }
    }

    public function getJSON(string $sql, array $params = array()) : string {
        $data = $this->getResult($sql,$params);
        return json_encode($data);
    }

    /**
     * *Méthode renvoie sous la forme d'un tableau HTML le résultat d'une requête paramétré
     * @param string $sql -requete sql de type select paramétrée
     * @param array $params - tableau contenant les valeurs à associer aux paramétres de la requête SQL(par défaut vide)
     * @return string code HTML correspondant au tableau rempli
     */
    public function getHtmlTable(string $sql, array $params=array()) : string {
        //Récupére sous la forme d'un tableau associatif le résultat de la requête SQL
        //Préparation de la requete
        $qry = $this->cnn->prepare($sql);
        //Exécution de la requete
        $qry->execute($params);
        
        //En-tête du tableau HTML
        $html = '<table class="table table-striped">';
        $html .= '<thead><tr>';
            //parcourt toute les colonnes qu'il y a dans le résulatat de la requete pour récupérer le nom de mes colonnes
            for($i=0; $i<$qry->columnCount();$i++){
                $meta=$qry->getColumnMeta($i);
                $html.='<th>'.$meta['name'].'</th>';
            }
        $html .= '</tr></thead><tbody>';

            //Parcourt le premier array qui contient des tableau associatif
            foreach($qry->fetchAll() as $row){//ligne de la table résultat du sql
                $html .= '<tr>';
                //Parcourt le second array
                foreach($row as $key => $val){
                    $html.= '<td>'. $val .'</td>';
                }
                $html .= '</tr>';
            } 
        //on concaténe $html par sa valeur actuel avec la balise fermante (.=)
        $html.='</tbody></table>';

        return $html;
    } 

    public function getHtmlSelect(string $id, string $sql, array $params=array()) :string{
        //Prépare et exécute la requête
        $qry=$this->cnn->prepare($sql);
        $qry->execute($params);
        //Récupére le résultat dans un tableau indéxés
        $data = $qry->fetchAll(PDO::FETCH_NUM);

        $html = '<select class="form-control" id="'. $id .'">';
            foreach($data as $val){
                //Si la requête renvoie une seule colonnes
                if($qry->columnCount() === 1){
                    $html.='<option value="'.$val[0].'">'.$val[0].'</option>';
                } else {
                    $html.='<option value="'.$val[0].'">'.$val[1].'</option>';
                }
            }
        $html .= '</select>';
        
        return $html;
    }
}

?>