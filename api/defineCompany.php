<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';

$user = new USER($db_connect);
 

$priv = new privileges($db_connect);

session_start();
if(isset($_POST['company_id']) and $_POST['company_id'] != ""){
  if($user->companyByUser($_SESSION['user_id'], strip_tags($_POST['company_id']))){
    if($user->getCompanyInfo($_POST['company_id'])){
        $companyInfo = $user->getCompanyInfo($_POST['company_id']);
        $_SESSION['company_id'] = $_POST['company_id'];
      $_SESSION['company_identifier'] = $companyInfo[0]['NAME'];
      echo $user->jsonfyResponse('success','Company Defined');
    }



  }else{
    echo $user->jsonfyResponse('ERROR_COMPANY_UNAUTHORIZED','Company undefuned');
  }




}else{
  echo $user->jsonfyResponse('ERROR_COMPANY_EMPTY_RESOURCES)','Company undefuned');
}
