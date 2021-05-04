<?php
include_once('animal.class.php');

class Human extends Animal{
    //Attribut privé
        private $fname;

    //Constructeur
        public function __construct(String $newFname,String $newName,String $newDob, float $newWeight, bool $newFemale){
        //Assigne la valeur des paramétre aux attributs de la fille 
        $this -> setFname($newFname);
        //Assigne la valeur des paramétre aux attributs de la mére
        $this -> name = $newName;
        $this -> setDob($newDob);
        $this -> setWeight($newWeight);
        $this -> setFemale($newFemale);
        //Incrémente le nbr d'instance de la mére
        parent::$nb++;
        }
    
    //Accesseurs 
        public function getFname(){
            return  $this->fname;
        }

    //Mutateurs
        public function setFname(String $newFname){
            $this->fname = $newFname;
        }

        public function setWeight(float $newWeight){
            //test si le poids est cohérent 
            if($newWeight < .5 || $newWeight > 650){
                throw new Exception(__CLASS__.' : Le poids doit être compris entre 500g et 650kg.');
            }else {
                $this -> weight = $newWeight;
            }
        }
    
    //Destructeur
        public function __destruct()
        {
            //Décrémente le nbr d'instance de la mére
            parent::$nb--;
        }
    

}

?>