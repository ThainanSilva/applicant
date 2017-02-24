<?php
require_once('classes/db.php');

if( isset($_POST['email']) || isset($_POST['password']) || !empty($_POST['email']) || !empty($_POST['password'] )){
    if($user_info = $user->login(strip_tags($_POST['email']), strip_tags($_POST['password']))){
        session_start();
        $_SESSION['user_id'] = $user_info['id'];
        $_SESSION['user_name'] = $user_info['name'];
        echo $user->jsonfyResponse('success', "welcome");

    }else{

        echo $user->jsonfyResponse('erro', "informações incorretas");
    }









   // $user->updateUserData($user_id, )
}
