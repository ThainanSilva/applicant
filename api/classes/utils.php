   <?php
class utils
{
    private $db;

    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
    
        //===============================================================================================================================
        //================================= retorna os dados da empresa num array =============================================
        //===============================================================================================================================
        public function getTimeZone()
        {
           try
           {
               $query = "SELECT * FROM timezone";
               $sql = $this->db->prepare($query);
               $sql->execute();
               $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
               $result = $this->db->query($query);
               if (!empty($result) and $result->rowCount()>0){
                  return $resrow;


               }else
               {
                   return false;
               }
               $this->db = null;
           }
           catch(PDOException $e)
           {
               echo $e->getMessage();
           }
                $this->db = null;
       }

     //===============================================================================================================================
    //==================== dá uma resposta padrão {result: variavelresult, message variavelmessage} em formato json =================
    //===============================================================================================================================

               public function getTimezoneValue($timezone)
        {
           try
           {
               $query = "SELECT value FROM timezone where id =".$timezone." limit 1"; 
               $sql = $this->db->prepare($query);
               $sql->execute();
               $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
               $result = $this->db->query($query);
               if (!empty($result) and $result->rowCount()>0){
                  return $resrow[0]['value'];
               }else
               {
                   return false;
               }
               $this->db = null;
           }
           catch(PDOException $e)
           {
               echo $e->getMessage();
           }
                $this->db = null;
       }
     //===============================================================================================================================
    //==================== dá uma resposta padrão {result: variavelresult, message variavelmessage} em formato json =================
    //===============================================================================================================================
    public function jsonfyResponse($result,$message, $code = '0001')
    {
           $response = array('result' => $result, "message"=> $message, "errorCode"=>$code);
           $response_array = json_encode($response);
           return $response_array;
    }
    public function sendmail($to, $subject, $message, $ishtml = false,  $atachmentPath = "", $atachmentName = ""){
        $mailer = new PHPMailer();
        $mailer->CharSet = 'UTF-8';
        $mailer->Encoding = 'base64';
        $mailer->IsSMTP();
        $mailer->SMTPDebug = 1;
        $mailer->Port = 587; //Indica a porta de conexão 
        $mailer->Host = 'smtp.weblink.com.br';//Endereço do Host do SMTP 
        $mailer->SMTPAuth = true; //define se haverá ou não autenticação 
        $mailer->Username = 'noreply@nextecbrasil.com.br'; //Login de autenticação do SMTP
        $mailer->Password = '020406tai@JA'; //Senha de autenticação do SMTP
        $mailer->FromName = 'Nextec'; //Nome que será exibido
        $mailer->From = 'noreply@nextecbrasil.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
        $mailer->AddAddress($to,'');
        if($atachmentPath != ""){
            if($atachmentName !=""){
                $mailer->addAttachment($atachmentPath, $atachmentName);
            }else{
                $mailer->addAttachment($atachmentPath, "Anexo");
            }
            
            
        }
        //Destinatários
        $mailer->isHTML($ishtml);
        $mailer->Subject = $subject;
        $mailer->Body = $message; 
        if(!$mailer->Send())
        {        return false;
        
        }else{
        return true;    
        } 
    }
    
    }