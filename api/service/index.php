<?php
require './slim/vendor/autoload.php';


$service = new \Slim\App();



$service->get('/auth', function( ){

    $return = (object)[];
    $return->result = 'error';
    $return->message = 'wrong access method. User Post instead';
    
   echo json_encode( $return); 
});

$service->post('/auth', function ($request, $response, $args){
    header('Content-Type: json/application; charset=utf-8');
    $body = $request->getParsedBody();

    //return $next($request, $response);
    echo var_dump($body);
  
    
});
$service->post('/visitors', function ($request, $response, $args){
   
});

$service->run();
 

