<?php


        if($_SERVER['SERVER_NAME'] == "localhost"){
            $host = 'localhost';
            $user = 'u184619155_acess';
            $password = '020406tai@JA';
            $db = 'u184619155_acess';
            $connstate = '';

        }else{
            $host = 'mysql.hostinger.com.br';
            $user = 'u184619155_acess';
            $password = '020406tai@JA';
            $db = 'u184619155_acess';
            $connstate = '';
        }
        try {
            $db_connect = new PDO("mysql:host=$host;dbname=$db", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES  utf8"));
            /*** echo a message saying we have connected ***/

        }
        catch(PDOException $e)
        {
           echo $e->getMessage();
        }


include_once 'users.php';
$user = new USER($db_connect);

// include_once 'visitors.php';
// $visitors = new visitors($db_connect);  //deve ser instanciada de acordo com a necessidade de cada arquivo

include_once 'privileges.php';
$priv = new privileges($db_connect);


// include_once 'company.php';
// $company = new company($db_connect);
