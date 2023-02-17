<?php

require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

include_once ('classes/getVisitors.php');
$visitors = new visitors($db_connect);

require_once('classes/company.php');
$company = new company($db_connect);

require_once('classes/access.php');
$access = new access($db_connect);

require_once('classes/reports.php');
$reports = new reports($db_connect);


if(isset($_POST['json']) and isset($_SESSION['company_id'])){
    $jobj =  json_decode($_POST['json'], true);

    if (isset($jobj[0]['function'])){
        
        $timezone=$company->getCompanyConfig($_SESSION['company_id'], 'timezone'); //(GMT -04.0) EST (americas/Manaus)
        $dateWithTimeZone =  gmdate("H:i", time() + 3600*($timezone+date("I")));  
        $day = date("Y-m-d");
 

    switch ($jobj[0]['function']) {//salva novo usuário
            case 'DashBarReport':
            
                  if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
                    if($privileges = $priv->GetUsersInfo('Reports', $userProfile) and $privileges >0 ){//verifica se o privilegios do usuario permitem Salvar
 
                          if(1==1){
                              $reports->barDashAccessDayliReport($_SESSION['company_id']);
                          }else{
                              echo '{"result":"3002","message":"Visitante Não existe"}';
                          }


                    }else{ echo 'ea3';}
                  }else{ echo 'ea4';}
                break;

                case 'saveEditVisitor':
            break;

      case 'GetVisitorsList'://retorna lista de visitantes]

        break;
        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
        case 'GetVisitorsPictures'://retorna lista de visitantes]

          break;

        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
      case 'GetVisitorsProfiles':// pegar perfis dos visitantes


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
