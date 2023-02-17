<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';

$user = new USER($db_connect);
 

$priv = new privileges($db_connect);
 

if ($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])) {
} else {
}
?>

<?php if ($priv->GetUsersInfo('beta_tester', $userProfile) > 0) {

    require_once "headerv2.php";
} else {
    require_once "headerv1.php";
} ?>


