<?php
require_once('classes/db.php');
$dbDate = "26/08/2016: 23:26";

$d = substr($dbDate, 0,2);
$m = substr($dbDate, 3,2);
$y = substr($dbDate, 6,4);


echo $d.$m.$y;

if($m >= date('m') and $d >= date('d')and $y >= date('y')){
            echo 'true';
        }else{
            echo 'false';

        }

if($token = $user->newToken(2, 0, 1)){
  if($user->SendTokenNewUser('thainan.nunes@nextecbrasil.com.br', $token, 'Nextec')){
    echo 'enviado';
  }else{
    echo 'não enviado';
  }
}else{
  echo 'não gerado nenhum token';
}
