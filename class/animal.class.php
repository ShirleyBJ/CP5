<?php
/**
* * Initiation à la POO en php
* * Class Animal
*/

class Animal {
    //Attribut public
        public  $name;
        public  $type;
    //Attribut privates
        private $dob;
        private $weight;
        private $female;

    //* Constantes de classe
    const TYPE_DOG = 'chien';
    const TYPE_CAT = 'chat';
    const TYPE_BIRD = 'oiseau';
    const TYPE_FISH = 'poisson';
    const TYPE_FERRET = 'furet';

    //* Constructeurs
    //est une fonction public
    public function __construct(string $newName='', string $newType='',string $newDob ='1970-01-02', float $newWeight=.2, bool $newFemale=true){
        $this-> name = $newName;
        $this-> type = $newType;
        $this->setDob($newDob);
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
    }

    //Accesseurs et mutateurs
        //**Getter
        public function getDob(){
            //this fait réference à element de la classe
            return $this -> dob;
        }

        public function getWeight(){
            return $this -> weight;
        }

        public function getFemale(){
            return $this -> female;
        }


        //**Setter
        public function setDob(string $newDob){
            //teste si un parametre est une date
            if((bool) strtotime($newDob)){
                $this -> dob = $newDob;
            }else{
                //renvoie le nom de classe contacéner avec un msg
                throw new Exception(__CLASS__.' : Le paramétre doit être une date');
            }
        }

        public function setWeight(float $newWeight){
            //test si le poids est cohérent 
            if($newWeight < .2 || $newWeight > 1000){
                throw new Exception(__CLASS__.' : Le poids dit être compris entre 200g et 1t.');
            }else {
                $this -> weight = $newWeight;
            }
        }

        public function setFemale(bool $newFemale){
            $this -> female = $newFemale;
        }


        //* Methode SPEAK : cri de l'animal selon son type
        public function speak(){
            switch (strtolower($this->type)){
                case Animal::TYPE_DOG:
                    return 'Wooof';
                    break;

                case Animal::TYPE_CAT:
                    return 'Miaouu';
                    break;
                
                case Animal::TYPE_BIRD:
                    echo 'cui-cui';
                    break;
                
                case Animal::TYPE_FISH:
                    return 'blub';
                    break;

                case Animal::TYPE_FERRET:
                    return 'Les furets.com';
                    break;
                
                default:
                    return 'Pfffft';
                    break;
            }
        }

        

        //*Destructeurs

        public function __destruct(){
            return $this-> name. ' est parti. ';
        }
}

?>