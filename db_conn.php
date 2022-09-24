<?php
function conexion(){

    $dbname = 'sessions';
    $dbuser = 'stuard';
    $dbpass = '';
    $dbhost = 'localhost';
    
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    
    return $pdo;
}

?>