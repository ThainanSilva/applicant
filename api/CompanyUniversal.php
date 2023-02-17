<?php

require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

include_once ('classes/visitors.php');
$visitors = new visitors($db_connect);

require_once('classes/company.php');
$company = new company($db_connect);

require_once('classes/access.php');
$access = new access($db_connect);



require_once('classes/utils.php');
$utils = new utils($db_connect);

if(isset($_POST['json']) and isset($_SESSION['company_id'])){

    $jobj =  json_decode($_POST['json'], true);

    if (isset($jobj['function'])){

//   ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    switch ($jobj['function']) {


        case "getUserEditableInfo": //TODO  vai para userUniversal.php ná versão 1.5 ###############################
            header('content-type:application/json');

            if(isset($_SESSION['company_id']) and isset($jobj['user_id'])){
              if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
                if($priv->GetUsersInfo('config_user', $userProfile) >= 2){
                  if($infousers = $priv->getUserInfoByCompany( $_SESSION['company_id'], strip_tags($jobj['user_id'])) ){
                    if($profiles = $priv->getProfiles($_SESSION['company_id'])){
                        foreach ($infousers as   $value){
                            $infouserToSend = $value;
                         
                        }
                        @$infouserToSend->all_profiles = $profiles;
                        echo json_encode($infouserToSend);

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
                break;





            case 'SaveEditCompany':

                  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >1 ){//verifica se o privilegios do usuario permitem Salvar
                    if($jobj['RAZAO_SOCIAL'] != "" && !empty($jobj['RAZAO_SOCIAL']) && is_numeric($jobj['CNPJ_CPF']) && $jobj['CNPJ_CPF'] != "" && !empty($jobj['CNPJ_CPF']) && is_numeric($jobj['timezone']) && $jobj['timezone'] != "" && !empty($jobj['timezone']) && $jobj['NAME'] != "" && !empty($jobj['NAME']) ){
                      if($company->saveEditCompany(strip_tags($jobj['RAZAO_SOCIAL']), strip_tags($jobj['CNPJ_CPF']),strip_tags($jobj['timezone']),strip_tags($jobj['NAME']), $_SESSION['company_id'] )){

                        echo $utils->jsonfyResponse('success', 'Saved');
                      }else{

                      }
                    }else{
                      echo $utils->jsonfyResponse('666', 'You shall not pass');
                    }


                    }else{ echo $utils->jsonfyResponse('4001','Sem Privilegios');}
                  }else{ echo $utils->jsonfyResponse('400','Não autenticado');}
                break;

            case 'getTimeZone':
                if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem Salvar
                        if($timezones = $utils->getTimeZone()){
                            $return = array('timezones' => $timezones);
                            if($companyTimezone = $company->getCompanyTimezone($_SESSION['company_id'])){//pega o timezone da empresa
                                $return['companytimezone'] = $companyTimezone;
                                $jsonencoded = json_encode($return);
				 echo $jsonencoded;
                            }
                        }
                    }
        	    }
            break;

      case 'getFields':
          header('content-type:application/json');
             if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem visualizar
                        if($sendback = $company->getCompanyFieldsByCompanyID($_SESSION['company_id'])){
                            if(count($sendback) > 0 or $sendback != false){
                                echo json_encode($sendback);
                            }else{
                                echo '[{"name":"Sem Campos de Cadastro"}]';
                            }

                        }else{
                                echo '[{"name":"Sem Campos de Cadastro"}]';
                            }

                    }
        	    }

        break;
        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++

      case 'getProfiles':
             if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem visualizar
                        if($sendback = $company->getCompanyProfiles($_SESSION['company_id'])){
                           header("Content-Type: application/json;charset=utf-8");
                            $return = json_encode($sendback);
                            echo $return;
                        }

                    }
        	    }

        break;

        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
        case 'removeProfiles':

           header('Content-Type: application/json');
            if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa

                if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges > 2 ){//verifica se o privilegios do usuario permitem Salvar
                    if(!$priv->ProfileHasUsers($jobj['profiles'], $_SESSION['company_id'])){
                        if(!empty($jobj['profiles'])){


                        if($priv->removeProfiles($_SESSION['company_id'], $jobj['profiles'])){
                          echo '{"result": "success"}';  
                        }else{
                           echo '{"result": "Erro ao deletar"}'; 
                        }
                        

                        }else{
                           echo '{"result": "erro_empty_data"}'; 
                        }
                    }else{
                        echo $utils->jsonfyResponse('error', 'Profile has association', '4050');

                    }


                }else{
                    echo $utils->jsonfyResponse('error', 'Not enougth privileges', '1001');
                }

            }else{
                echo $utils->jsonfyResponse('error', 'Not enougth privileges','1001');
            }

            break;


        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
        case 'SaveNewProfile'://retorna lista de visitantes]
header('content-type:application/json');
                  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem Salvar
                        if($company->ProfileExist($_SESSION['company_id'], $jobj['data']['name'])!= true){
                            
                      
                       
                        if($sendback = $company->SaveNewProfile($_SESSION['company_id'], $jobj['data'])){
                            //header('content-type:application/json');
                          echo $utils->jsonfyResponse('success', 'salvo com sucesso');
                        }    
                        
                    }else{echo $utils->jsonfyResponse('Error', 'Profille already exists');}

                    }
        	    }
          break;
        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
        case 'getProfilesAttr'://retorna lista de visitantes]
                  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem Salvar
                        if($sendback = $company->getCompanyProfilesAttr($_SESSION['company_id'])){
                          $return = json_encode($sendback);
                          echo $return;
                        }

                    }
        	    }
          break;

        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
      case '':// pegar perfis dos visitantes


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
