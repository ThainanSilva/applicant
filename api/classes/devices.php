<?php

class devices
{
 


public function CheckDeviceKey($key){


}  

function jsonfyError($result, $code, $message){
    $return['result'] = $result;
    $return['code'] = $code;
    $return['message'] = $message;
    return json_encode($return);
}  


}