<?php

require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

include_once ('classes/visitors.php');
$visitors = new visitors($db_connect); 

include_once ('classes/utils.php');
$utils = new utils($db_connect);

if(isset($_POST['json']) and isset($_SESSION['company_id'])){
    $jobj =  json_decode($_POST['json'], true);

    if (isset($jobj[0]['function'])){

    switch ($jobj[0]['function']) {//salva novo usuário
      case 'saveNewVisitor':

      if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
        if($priv->GetUsersInfo('visitors', $userProfile)>1 ){//verifica se o privilegios do usuario permitem Salvar
          if($visitors->VisitorExistByCPF(strip_tags($jobj[0]['NewVisitorCPF']), $_SESSION['company_id'])){
            echo $utils->jsonfyresponse("5001","CPF já cadastrado");
          }else{
            if($visitors->insertNewVisitorbyCompany(strip_tags($jobj[0]['NewVisitorName']), strip_tags($jobj[0]['NewVisitorCPF']), strip_tags($jobj[0]['NewVisitorPicData']), strip_tags($jobj[0]['NewVisitorType']), $_SESSION['company_id'])){
            echo $utils->jsonfyresponse("5002","Salvo com Sucesso");
            }
            else{
              echo 'nok insert';
            }
          }

        }else{ echo 'ea3';}
      }else{ echo 'ea4';}
      break;

    

        case 'saveEditVisitor':

        if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
          if($privileges = $priv->GetUsersInfo('visitors', $userProfile) and $privileges >1 ){//verifica se o privilegios do usuario permitem Salvar
              if($visitors->EditVisitorbyCompany(strip_tags($jobj[0]['NewVisitorName']), strip_tags($jobj[0]['NewVisitorCPF']), strip_tags($jobj[0]['NewVisitorPicData']), strip_tags($jobj[0]['NewVisitorType']), strip_tags($jobj[0]['visitorID']), $_SESSION['company_id'])){
                  echo $utils->jsonfyresponse("5002","Salvo com Sucesso");
              }
              else{
                echo 'nok insert';
              }


          }else{ echo 'ea3';}
        }else{ echo 'ea4';}
        break; 

          break;

      case 'GetVisitorsList'://retorna lista de visitantes]
        if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
          if($privileges = $priv->GetUsersInfo('visitors', $userProfile) and $privileges >0 ){
              if($sendBack['numRows'] = $visitors->getVisitorsInfoByCompanyRowCount($_SESSION['company_id'])){
                
                
                if(isset($jobj[0]['pagelimit']) and $jobj[0]['pagelimit'] != 30 and is_numeric($jobj[0]['pagelimit'])){
                  $pagelimit = $jobj[0]['pagelimit'];}
                  else{
                    $pagelimit = 30;}
                if(isset($jobj[0]['page']) and $jobj[0]['page'] != 1 and is_numeric($jobj[0]['page'])){
                  $requestPage = $jobj[0]['page'];}
                  else{
                    $requestPage = 1;}
                 if(is_float(($sendBack['numRows'] / $pagelimit))){
                   $numberOfPages = intval(($sendBack['numRows'] / $pagelimit))+1;
                  }else{
                   $numberOfPages = ($sendBack['numRows'] / $pagelimit);
                  }
                  if($requestPage <= 1){$requestFrom =  0;}else{
                    $requestFrom =  ($pagelimit*$requestPage);
                    $requestFrom =  $requestFrom-$pagelimit; 
                    }
                  $requestTo = $pagelimit * $requestPage;
                  if (isset($jobj[0]['search']) and $jobj[0]['search'] != 'false' ){
                    $search = $jobj[0]['search'];
                  }else{
                    $search = 'false';
                  }
                if($resposneArray = $visitors->getVisitorsInfoByCompany($_SESSION['company_id'],$requestFrom, $pagelimit,$search)){
                  $sendBack['search']= $search;
                  $sendBack['result']= 'success';
                  $sendBack['message']= 'Visitors List';
                  $sendBack['fromTo']= $requestFrom.' '.$requestTo;
                  $sendBack['pages']= $numberOfPages;
                  $sendBack['activePage']= $requestPage;
                  $sendBack['Visitors']= $resposneArray;
                  $response = json_encode($sendBack);
                  header('Content-type: application/json');
                  echo $response;
                }else{ 
                  echo 're+========= '.$requestFrom; echo $utils->jsonfyresponse("5003","sem resposta");}
              }else{}
            }else{ echo $utils->jsonfyresponse("5003","sem resposta");}
          }else{ echo 'ea3 get list';}
   
        break;
        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
        case 'GetVisitorsPictures'://retorna lista de visitantes]
          if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
            if($privileges = $priv->GetUsersInfo('visitors', $userProfile) and $privileges >0 ){
              if($resposneArray = $visitors->getVisitorPictureById(strip_tags($jobj[0]['visitorID']), $_SESSION['company_id'])){
                $response = json_encode($resposneArray);
                echo $response;


              }else{ echo 'ea2';}
            }else{ echo 'ea3';}
          }else{ echo 'ea4';}
          break;

        //+++++++++++++++++++++++++++++++===============+++++++++++++++++++++++++++++++++++++++++++
      case 'GetVisitorsProfiles':// pegar perfis dos visitantes

        if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){
          if($privileges = $priv->GetUsersInfo('visitors', $userProfile) and $privileges >0 ){
            if($resposneArray = $visitors->GetVisitorsProfiles($_SESSION['company_id'], true)){

              $response = json_encode($resposneArray);
              echo $response;


            }else{ echo 'ea2';}
          }else{ echo 'ea3 get profiles';}
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
