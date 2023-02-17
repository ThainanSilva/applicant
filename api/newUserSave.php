<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');


if(isset($_SESSION['user_id']) and isset($_SESSION['company_id']) and isset($_POST['email']) and isset($_POST['profile_id'])){
  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
    if($priv->GetUsersInfo('config_user', $userProfile) > 1){
      if($user->checkuserexists(strip_tags($_POST['email']))){
        if($userId = $user->GetUserIdByEmail(strip_tags($_POST['email']))){
          if($user->companyByUser($userId, $_SESSION['company_id'])){
            echo $user->jsonfyresponse("ERROR_USER_ALREADY_ADDED", "Esse usuário já pertence a essa empresa");
          }else{
            if($user->newUserPrivileges($userId, strip_tags($_POST['profile_id']), $_SESSION['company_id'], $_SESSION['user_id'])){
                echo $user->jsonfyresponse("SUCCESS", "Cadastro salvo com sucesso");
            }
          }
        }
      }else{
        if($user->insertNew(strip_tags($_POST['email']))){
          if($userId = $user->GetUserIdByEmail(strip_tags($_POST['email']))){
            if($user->newUserPrivileges($userId, strip_tags($_POST['profile_id']), $_SESSION['company_id'], $_SESSION['user_id'])){
              if($token = $user->newToken($userId, 0, $_SESSION['company_id'])){
                if($user->SendTokenNewUser(strip_tags($_POST['email']), $token, $_SESSION['company_identifier'])){
                  
                  echo $user->jsonfyresponse("SUCCESS", "Email de cadastro enviado!");
                }else{echo $user->jsonfyresponse("ERROR_EMAIL_NOT_SENT", "erro ao enviar email");}

              }else{ 
                echo $user->jsonfyresponse("ERROR_TOKEN_NOT_GENERATED", "Erro ao gerar token");}
            }
          }
        }

        }
        //usuario não existe
      }else{
        echo 'sem privilegios';
      }

}else{echo 'ola2';}




  }else{echo 'ola3';}

//aqui vai entrar a checagem de privilégios
