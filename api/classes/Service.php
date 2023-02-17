<?php



class Service{
     

     private $container;
     public  $mimeTypes = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json;charset=UTF-8',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
      public  $errorCodes = array(

            '1001' => 'text/plain',
            '1002' => 'text/html',
            '1003' => 'text/html',
            '1004' => 'text/html',
            '1005' => 'Invalid or Missing Token'
        );

    public function detectRequestBody() {
        $rawInput = fopen('php://input', 'r');
        $tempStream = fopen('php://temp', 'r+');
        stream_copy_to_stream($rawInput, $tempStream);
        rewind($tempStream);

        return $tempStream;
    }


/**
 * Calcula o fatorial de um número
 *
 * @param string $route o Final da URL
 * @param return $return 
 * @return int Chama toda a função dentro do encapsulamento.
 * @param string $encoding espera receber o tipo de retorno da requisiçao Ex. Html, JSON e etc.
 */
     public function post($route, $return, $encoding = 'htm' ){
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode('api/', trim($_SERVER['REQUEST_URI'],'/'));//o nome da pasta onde o index roda tem que 
        if(end($request) === $route && $method === "POST" or strpos($_SERVER['REQUEST_URI'], $route) && $method === "POST"){
            $return = $return->bindTo(new $this);
            try{
                $requestContent = json_encode(file_get_contents('php://input'));
            }catch (Exception $e){
                exit('erro');
            }

            $this->hType($encoding);
            $return($requestContent, $this->mimeTypes);  
        }
    }
    
     public function get($route, $return, $encoding = 'htm'){
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode('api/', trim($_SERVER['REQUEST_URI'],'/'));
        if(end($request) === $route && $method === "GET"){
            $return = $return->bindTo(new StdClass); 
            $requestContent = json_decode(file_get_contents('php://input'));
            $this->hType($encoding);
            $return($requestContent, $this->mimeTypes );  
        }
    }
    
    public function hType($encoding){ //tipo de retorno
        try {
          return header('content-type:'.$this->mimeTypes[$encoding]);
        } catch (Exception $ex) {
            exit(   );
        } 
    }
    
    
        public function error($code){
        try {
            $returnError = (object) "";
            @$returnError->result = 'error';
            $returnError->errorCode = $code;
            $returnError->message = $this->errorCodes[$code];
            return json_encode($returnError);
        } catch (Exception $ex) {
            
        } 
    }
    /* @var $post post( $route, $execute)  */
}
 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 

