<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';

$user = new USER($db_connect);
 

$priv = new privileges($db_connect);

if(isset($_GET['token']) and $_GET['token'] != ""){
    if($user->checkTokenValid($_GET['token']) == "valid"){
        $returndbtokeninfo = $user->getTokenInfo($_GET['token']);
        $token= $returndbtokeninfo[0]['token'];
        $user_id = $returndbtokeninfo[0]['user_id'];
        include_once('../pages/newUserRegisterPassword.php');

    }

    if($user->checkTokenValid($_GET['token']) =="nonvalid"){
  
        include_once('../pages/expiredToken.html');

        }
    if($user->checkTokenValid($_GET['token']) =="expired"){
        include_once('../pages/expiredToken.html');

        }




}
