<?php 
include_once('../class/animal.class.php');
echo '<h2> Instanciation de la classe </h2>';

$milou = new Animal();
$milou -> name = 'Milou';
//$milou -> dob = '1925-05-03';
//$milou -> weight = 6.54;
//$milou -> female = false;


var_dump($milou);

echo '<h2> Encapsulation getters et setters </h2>';

//$milou -> setDob('toto');
$milou -> setDob('1999-05-13');
//$milou -> setWeight(.1);
$milou -> setWeight(6.54);
$milou -> setFemale('non');

var_dump($milou);

echo '<h2> Constructeurs </h2>';
    $pet2 = new Animal('Garfield','chat','1956-12-24',7.8, false);
    var_dump($pet2);

echo '<h2> Constantes de classe </h2>';
    $pet3 = new Animal('Grosminet','chat','1996-09-18',6.25,false);
    echo '<p>' . $pet3 -> speak() . '</p>';

echo '<h2> Méthode getAGE </h2>';
echo '<p>Age de Milou : </p>' . $milou -> getAge();
echo '<p>Age de Garfield : </p>' . $pet2 -> getAge();
echo '<p>Age de Grosminet : </p>' . $pet3 -> getAge();

echo '<h2> Méthode EAT </h2>';
$pet4 = new Animal('Jerry','souris','2015-05-10',.35,false);
$pet5 = new Animal('Tom','chat','2010-11-05',4.65,false);
var_dump($pet5);
$pet5->eat($pet4);
var_dump($pet5);
unset($pet4);
?>