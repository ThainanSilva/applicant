<?php
include_once ('../api/classes/devices.php');
$device = new devices($db_connect);




if(isset($_POST['request']) and $_POST["request"]!= ""){
    $requestObj = json_decode($_POST["request"]);
    if(isset($requestObj['key']) and $requestObj != ""){
        
    }else{
        if(isset($requestObj['CNPJ']) and $requestObj != ""){    }

        echo $device->jsonfyError('error', '0002', 'me dá a deviceId porra');
    }
}else{
    echo $device->jsonfyError('error', '0001', 'Wrong method! Get is not a valid request method!');
}