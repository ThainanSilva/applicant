<?php

if ($_SERVER['SERVER_NAME'] == "localhost") {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'access';
    $connstate = '';
} else {
    $host = 'mysql.hostinger.com.br';
    $user = 'u184619155_acess';
    $password = '020406tai@JA';
    $db = 'u184619155_acess';
    $connstate = '';
}
if ($_SERVER['SERVER_NAME'] == "aldeia.nextecbrasil.com.br") {
    $host = 'localhost';
    $user = 'u508239042_aldeia';
    $password = '020406tai@TNS';
    $db = 'u508239042_aldeia';
    $connstate = '';
}

try {
    $db_connect = new PDO("mysql:host=$host;dbname=$db", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES  utf8"));
    /*** echo a message saying we have connected ***/
} catch (PDOException $e) {
    echo $e->getMessage();
}
