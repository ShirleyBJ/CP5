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
$milou -> setDob('2021-05-03');
//$milou -> setWeight(.1);
$milou -> setWeight(6.54);
$milou -> setFemale('non');

var_dump($milou);

echo '<h2> Constructeurs </h2>';
    $pet2 = new Animal('Garfield','chat','2021-05-03',7.8, false);
    var_dump($pet2);

echo '<h2> Constantes de classe </h2>';
    $pet3 = new Animal('Grosminet','chat','1954-02-08',6.25,false);
    echo '<p>' . $pet3 -> speak() . '</p>';
?>