<?php

require_once('../api/classes/db.php');
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

    if (isset($jobj[0]['function'])){
 
 

    switch ($jobj[0]['function']) {
            case 'SaveEditCompany':
              
                  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >1 ){//verifica se o privilegios do usuario permitem Salvar
                    if($jobj[0]['RAZAO_SOCIAL'] != "" && !empty($jobj[0]['RAZAO_SOCIAL']) && is_numeric($jobj[0]['CNPJ_CPF']) && $jobj[0]['CNPJ_CPF'] != "" && !empty($jobj[0]['CNPJ_CPF']) && is_numeric($jobj[0]['timezone']) && $jobj[0]['timezone'] != "" && !empty($jobj[0]['timezone']) && $jobj[0]['NAME'] != "" && !empty($jobj[0]['NAME']) ){
                      if($company->saveEditCompany(strip_tags($jobj[0]['RAZAO_SOCIAL']), strip_tags($jobj[0]['CNPJ_CPF']),strip_tags($jobj[0]['timezone']),strip_tags($jobj[0]['NAME']), $_SESSION['company_id'] )){

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

      case 'getProfiles':
             if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('config', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem Salvar
                        if($sendback = $company->getCompanyProfiles($_SESSION['company_id'])){
                          $return = json_encode($sendback);
                          echo $return;
                        }

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
