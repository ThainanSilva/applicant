<?php

require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';

$user = new USER($db_connect);
 

$priv = new privileges($db_connect);

if(isset($_SESSION['user_id']) and isset($_SESSION['company_id'])){
  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
    if($privileges = $priv->GetUsersInfo('config_user', $userProfile) and $privileges >0 ){
      if($infousers = $priv->getUsersInfoByCompany( $_SESSION['company_id'],$_SESSION['user_id'])){
        $jsonInfoUsers = json_encode($infousers);
        $json_a = json_decode($jsonInfoUsers, true);
        $json_a['result'] = 'success';
        $json_a['privileges'] = $privileges;
        $json_b = json_encode($json_a);
        echo $json_b;

      }else{//else do getUsersInfoByCompany
        $json_a['result'] = 'erro';
        $json_a['privileges'] = $privileges;
        $json_b = json_encode($json_a);
        echo $json_b;
      }
}else{//else do getUserInfo
  $json_a['result'] = 'nonprivileges';
  $json_a['privileges'] = $privileges;
  $json_b = json_encode($json_a);
  echo $json_b;
}



  }else{//else do getuserprofile
    $json_a['result'] = 'error';
    $json_b = json_encode($json_a);
    echo $json_b;
  }

//aqui vai entrar a checagem de privilégios


}else{
  $json_a['result'] = 'error';
  $json_b = json_encode($json_a);
  echo $json_b;
}

?>
