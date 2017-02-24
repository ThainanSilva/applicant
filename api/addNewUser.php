<?php
require_once('classes/db.php');



if (isset($_POST['email']) and isset($_POST['profile']) and $_POST['email'] != "" and $_POST['profile'] != ""){
    if()
    
    echo $user->jsonfyResponse('success', 'welcome');
}else{
    
    
    echo $user->jsonfyResponse('error01', 'wrong login method');

} 
?> 