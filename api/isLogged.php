<?php
 session_start();

 include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';

$user = new USER($db_connect);

 
 // Force HTTPS for security
if($_SERVER["HTTPS"] != "on") {
    $pageURL = "Location: https://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    header($pageURL);
}
if ($user->isLoggedIn()){}else{
    session_destroy();
    $user->redirect('http://'.$_SERVER["SERVER_NAME"].'/login.php');
    exit;    
}
?> 