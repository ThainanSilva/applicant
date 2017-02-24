<?php

require_once('../api/classes/db.php');
require_once('../api/isLogged.php');

require_once('../api/companycheck.php');

include_once 'classes/visitors.php';
$visitors = new visitors($db_connect);


if(isset($_POST['json']) and isset($_SESSION['company_id'])){
    $jobj =  json_decode($_POST['json'], true);

    if (isset($jobj[0]['function'])){

    switch ($jobj[0]['function']) {//salva novo usuário
      case 'saveNewVisitor':

   echo 'newuser';

        break;

      case 'GetVisitorsList'://retorna lista de visitantes]
        if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
          if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >= 99 ){
            if($resposneArray = $visitors->getVisitorsInfoByCompany($_SESSION['company_id'])){
              $response = json_encode($resposneArray);
              echo $response;


            }else{ echo 'ea2';}
          }else{ echo 'ea3';}
        }else{ echo 'ea4';}
        break;

      case 'GetVisitorsProfiles':// pegar perfis dos visitantes

        if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
          if($privileges = $priv->GetUsersInfo('visitors', $userProfile) and $privileges >0 ){
            if($resposneArray = $visitors->GetVisitorsProfiles($_SESSION['company_id'], true)){
              $response = json_encode($resposneArray);
              echo $response;


            }else{ echo 'ea2';}
          }else{ echo 'ea3';}
        }else{ echo 'ea4';}

        break;
      case 'value':
        # code...
        break;

      default:
        $json_a['result'] = 'no function defined';
        $json_b = json_encode($json_a);
        echo $json_b;
        break;
    }



}




}else{
  $json_a['result'] = 'error';
  $json_b = json_encode($json_a);
  echo $json_b;
}

?>
