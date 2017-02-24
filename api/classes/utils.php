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
    public function jsonfyResponse($result,$message)
    {
           $response = array('result' => $result, "message"=> $message);
           $response_array = json_encode($response);
           return $response_array;
    }
    
    }