<?php

require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');


if(isset($_SESSION['company_id']) and isset($_POST['user_id'])){
  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
    if($priv->GetUsersInfo('config_user', $userProfile) >= 2){
      if($infousers = $priv->getUserInfoByCompany( $_SESSION['company_id'], strip_tags($_POST['user_id'])) ){
        if($profiles = $priv->getProfiles($_SESSION['company_id'])){
          $infousers['all_profiles'] = $profiles;
          $jsonInfoUsers = json_encode($infousers);
        echo $jsonInfoUsers;
        
        }
        else{
          echo 'ola';
        }
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
