<?php
require_once('classes/db.php');



if (isset($_POST['login']) and isset($_POST['password'])){
    echo $user->jsonfyResponse('success', 'welcome');
}else{
    
    
    echo $user->jsonfyResponse('error01', 'wrong login method');

} 
?> 