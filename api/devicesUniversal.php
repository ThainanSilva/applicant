<?php
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');
include_once ('classes/visitors.php');
include_once ('classes/utils.php');
include_once ('classes/devices.php');
$devices = new devices($db_connect);
$utils = new utils($db_connect);
$visitors = new visitors($db_connect);       

if(gettype(file_get_contents('php://input')) === "string"){
    $requestBody = json_decode(file_get_contents('php://input'));
}elseif (gettype(file_get_contents('php://input')) === "object") {
    $requestBody =  file_get_contents('php://input');
}

header("Content-Type: application/json");

if(isset($requestBody->function) and isset($_SESSION['company_id'])){

    if (isset($requestBody->function)){

    switch ($requestBody->function) {//salva novo usuário
      case 'getDevices':

      if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){//verifica se o usuario tem acesso a essa empresa
        if($priv->GetUsersInfo('devices', $userProfile)>1 ){//verifica se o privilegios do usuario permitem Salvar
            try{
                $dbDevices = $devices->getDevicesByCompanyId($_SESSION['company_id']);
      
                if($dbDevices){
                    echo json_encode($dbDevices);
                }else{
                    throw new Exception($utils->jsonfyResponse('error', 'Empty query result'));
                }
                
            } catch (Exception $ex) {
                echo  $ex->getMessage();
                echo $dbDevices;
            }
            

        }else{ echo 'ea3';}
      }else{ echo 'ea4';}
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
    