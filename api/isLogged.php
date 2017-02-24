<?php

session_start();
 
if ($user->isLoggedIn())
{

}
else{ 
    session_destroy();
    $user->redirect('http://'.$_SERVER["SERVER_NAME"].'/login');
    exit;    
}
?>