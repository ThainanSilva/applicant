<?php
 
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/users.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';

$user = new USER($db_connect);
 

$priv = new privileges($db_connect);

if(isset($_SESSION['user_id']) and isset($_SESSION['company_id'])){
  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
    if($priv->GetUsersInfo('config_user', $userProfile) >0){
      if($companyInfo = $user->getCompanyInfo( $_SESSION['company_id'])){
        $jsonInfoUsers = json_encode($companyInfo);
        echo $jsonInfoUsers;

      }else{//else do getUsersInfoByCompany
        echo 'ola1';
      }
}else{//else do getUserInfo
        echo 'ola2';
}



  }else{//else do getuserprofile
        echo 'ola3';
  }

//aqui vai entrar a checagem de privilégios


}else{

}

?>
