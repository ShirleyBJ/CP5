<?php

    include_once('../inc/constants.inc.php');
    include_once('../class/database.class.php');

    echo '<h2>Instanciation database : </h2>';

    $mydb = new Database(HOST,DATA,USER,PASS);
    var_dump($mydb);

    echo '<h2>GET RESULT: </h2>';
    $sql = 'SELECT * FROM users WHERE active=?';
    $params = array(1);
    $data = $mydb-> getResult($sql,$params);
    var_dump($data);

    echo '<h2>GET JSON : </h2>';
    $json=$mydb->getJSON($sql,$params);
    echo $json;

    echo '<h2>GET HTML TABLE: </h2>';
    $sql = 'SELECT * FROM country';
    //echo $mydb->getHtmlTable($sql);

    echo '<h2> GETHmlSelect: </h2>';
    //Test 1 : avec table city
        $sql = 'SELECT name FROM city';
        echo $mydb->getHtmlSelect('city',$sql);
    //Test 2 : avec table country
        $sql = 'SELECT * FROM country';
        echo $mydb->getHtmlSelect('country',$sql);
    //Test 3 : avec table country
    $sql = 'SELECT * FROM country WHERE continent = ? AND IndepYear < ?';
    $params=array('Asia',1900);
    echo $mydb->getHtmlSelect('country2',$sql,$params);

?>