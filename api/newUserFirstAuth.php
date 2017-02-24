<?php
require_once('classes/db.php');

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
