<?php
    include_once('../inc/constants.inc.php');
    include_once('../class/database.class.php');

    echo '<h2>Instanciation database : </h2>';

    $mydb = new Database(HOST,DATA,USER,PASS);
    var_dump($mydb);
?>