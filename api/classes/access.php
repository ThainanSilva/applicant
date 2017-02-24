<?php

class access
{
  private $db;
  function __construct($db_connect)
  {
    $this->db = $db_connect;
  }


 
     //===========================================================================================================
      //================================= retorna os tipos de visitantes
      //=======================================================================================================


      public function RegistSimpleAccess($company_id, $user_id, $visitor_id, $visitor_type_id, $access_type, $date, $hour)
      {
         try
         {
                         
             $query = "INSERT INTO access (date, hour, user_id, visitor_id, visitor_type_id, access_type, company_id) 
             VALUES ('".$date."','".$hour."', '".$user_id."','".$visitor_id."','".$visitor_type_id."','".$access_type."','".$company_id."')";
             $sql = $this->db->prepare($query);
             $result = $this->db->query($query);
             if (!empty($result) and $result->rowCount()>0){
                return true;
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



}
