<?php 
require_once('classes/db.php');

if(isset($_POST['token']) || isset($_POST['name']) || isset($_POST['password']) || !empty($_POST['token']) || !empty($_POST['name']) || !empty($_POST['password'] )){
    if($user->checkTokenValid($_POST['token']) == "valid"){
        if($tokenInfo = $user->getTokenInfo($_POST['token'])){

            if($user->updateUserName(strip_tags($tokenInfo[0]['user_id']), strip_tags($_POST['name']) ) ){
                if($user->updateUserPassword(strip_tags($tokenInfo[0]['user_id']), strip_tags($_POST['password']))){
                    if($user->invalidateToken($_POST['token'])){
                        echo $user->jsonfyResponse('success', "Salvo com sucesso");
                         
                    }else{
                         echo $user->jsonfyResponse('erroR', "erro ao definir o token como invalido");

                    }  
                }else{
                   
                }//update senha

            }else{
                    echo $user->jsonfyResponse('error', "erro ao salvar o nome");
                }//update nome

        }else{
                    echo $user->jsonfyResponse('error', "erro ao obter informações do token");
                }//get token info 



        
        
}
 
    if($user->checkTokenValid($_GET['token']) =="invalid"){
        $user->jsonfyResponse('Error_Invalid_Token::', "Invalid Token");
            
        }
    if($user->checkTokenValid($_GET['token']) =="expired"){
        $user->jsonfyResponse('Error_Expired_Token::', "Token Expired");

        }        
    
 

 
 
    
    
   // $user->updateUserData($user_id, )
}

