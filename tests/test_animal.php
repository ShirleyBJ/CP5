<?php 
include_once('../class/animal.class.php');
include_once('../class/human.class.php');

echo '<h2> Instanciation de la classe Animal </h2>';

$pet1= new Animal();
$pet1 -> name = 'Milou';
//$milou -> dob = '1925-05-03';
//$milou -> weight = 6.54;
//$milou -> female = false;

var_dump($pet1);

echo '<h2> Encapsulation getters et setters </h2>';

//$milou -> setDob('toto');
$pet1 -> setDob('1999-05-13');
//$milou -> setWeight(.1);
$pet1 -> setWeight(6.54);
$pet1 -> setFemale('non');

var_dump($pet1);
echo '<p>Nb d\'instances : '. Animal::countInstances();

echo '<h2> Constructeurs </h2>';
    $pet2 = new Animal('Garfield','chat','1956-12-24',7.8, false);
    var_dump($pet2);
    echo '<p>Nb d\'instances : '. Animal::countInstances();

echo '<h2> Constantes de classe </h2>';
    $pet3 = new Animal('Grosminet','chat','1996-09-18',6.25,false);
    echo '<p>' . $pet3 -> speak() . '</p>';
    echo '<p>Nb d\'instances : '. Animal::countInstances();

echo '<h2> Méthode getAGE </h2>';
echo '<p>Age de Milou : </p>' . $pet1 -> getAge();
echo '<p>Age de Garfield : </p>' . $pet2 -> getAge();
echo '<p>Age de Grosminet : </p>' . $pet3 -> getAge();


echo '<h2> Méthode EAT </h2>';

$pet4 = new Animal('Jerry','souris','2015-05-10',.35,false);
$pet5 = new Animal('Tom','chat','2010-11-05',4.65,false);
    var_dump($pet5);
$pet5->eat($pet4);
    var_dump($pet5);
    echo '<p>Nb d\'instances : '. Animal::countInstances();

unset($pet4);
echo '<p>Nb d\'instances : '. Animal::countInstances();

echo '<h2> Instanciation de la classe HUMAN </h2>';
$man1 = new Human('Gaston','Lagaffe','1957-05-06',77,false);
var_dump($man1);
echo '<p>Nb d\'instances : '. Human::countInstances();
?>