<?php
class visitors
{
  private $db;
  function __construct($db_connect)
  {
    $this->db = $db_connect;
  }



     //===========================================================================================================
      //================================= retorna os tipos de visitantes
      //=======================================================================================================


      public function GetVisitorsProfiles($company_id, $Use_Global_Types)
      {
         try
         {
             if($Use_Global_Types == true){
                $query = "SELECT visitors_type.id, visitors_type.name, visitors_type.company_id, visitors.visitors_type as hasRelations FROM visitors_type left Join visitors on visitors.visitors_type = visitors_type.id where visitors_type.company_id = ".$company_id." and visitors_type.company_id = ".$company_id." or visitors_type.company_id = 0";

             }else{
                 $query = "SELECT visitors_type.id, visitors_type.name, visitors_type.company_id, visitors.visitors_type as hasRelations FROM visitors_type left Join visitors on visitors.visitors_type = visitors_type.id where visitors_type.company_id =".$company_id;
             }
             $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
             $result = $this->db->query($query);
             if (!empty($result) and $result->rowCount()>0){

               return $resrow;//retorna os dados do banco como array


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




          //===========================================================================================================
           //================================= retorna os tipos de visitantes
           //=======================================================================================================


           public function VisitorExistByID($ID, $company_id)
           {
              try
              {

                  $query = "SELECT cpf FROM visitors  where id = $ID and company_id =  $company_id";
                  $sql = $this->db->prepare($query);
                  $sql->execute();
                  $resrow = $sql->fetchAll();
                  $result = $this->db->query($query);
                  if (!empty($result) and $result->rowCount()>0){
                    return true;//retorna os dados do banco como array


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

          //===========================================================================================================
           //================================= retorna os tipos de visitantes
           //=======================================================================================================


           public function VisitorExistByCPF($CPF, $company_id)
           {
              try
              {

                  $query = "SELECT cpf FROM visitors  where cpf = $CPF and company_id =  $company_id";
                  $sql = $this->db->prepare($query);
                  $sql->execute();
                  $resrow = $sql->fetchAll();
                  $result = $this->db->query($query);
                  if (!empty($result) and $result->rowCount()>0){
                    return true;//retorna os dados do banco como array


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


          //===========================================================================================================
          //================================= pega informações dos visitantes
          //=======================================================================================================


          public function getVisitorPictureById($visitor_id, $company_id)
          {
             try
             {
                 $query = "SELECT visitors.picture, visitors.id, visitors.company_id  from visitors where visitors.company_id = ".$company_id." and visitors.id = ".$visitor_id;

                 $sql = $this->db->prepare($query);
                 $sql->execute();
                 $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
                 $result = $this->db->query($query);
                 if (!empty($result) and $result->rowCount()>0){
                   return $resrow;//retorna os dados do banco como array


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


      //===========================================================================================================
      //================================= pega informações dos visitantes
      //=======================================================================================================


      public function getVisitorsInfoByCompanyRowCount($company_id){
         try
         {
             $query = "SELECT visitors.name, visitors.id, visitors.company_id, visitors.cpf, visitors.visitors_type, visitors_type.name as typeofvisitor  from visitors INNER JOIN visitors_type ON visitors.visitors_type = visitors_type.id where visitors.company_id = ".$company_id ;
             $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
             $result = $this->db->query($query);
             if (!empty($result) and $result->rowCount()>0){return $result->rowCount();//retorna os dados do banco como array
             }else{return false;}
             $this->db = null;
         }
         catch(PDOException $e){echo $e->getMessage();}
              $this->db = null;
     }

      //===========================================================================================================
      //================================= pega informações dos visitantes
      //=======================================================================================================


      public function getVisitorsInfoByCompany($company_id, $from, $to, $search){
         try {
            // "SELECT COUNT(*) FROM `table` WHERE `some_condition`"
            if($search !="" and $search != "false"){
                if(is_numeric($search)){
                    $query = "SELECT visitors.name, visitors.id, visitors.company_id, visitors.cpf, visitors.visitors_type, visitors_type.name as typeofvisitor  from visitors INNER JOIN visitors_type ON visitors.visitors_type = visitors_type.id where visitors.company_id = ".$company_id." and visitors.cpf like '%".$search."%' order by visitors.name limit ".$from.",".$to;
                }else{
                    $query = "SELECT visitors.name, visitors.id, visitors.company_id, visitors.cpf, visitors.visitors_type, visitors_type.name as typeofvisitor  from visitors INNER JOIN visitors_type ON visitors.visitors_type = visitors_type.id where visitors.company_id = ".$company_id." and visitors.name like '%".$search."%' order by visitors.name limit ".$from.",".$to;
                }
            }else{
                $query = "SELECT visitors.name, visitors.id, visitors.company_id, visitors.cpf, visitors.visitors_type, visitors_type.name as typeofvisitor  from visitors INNER JOIN visitors_type ON visitors.visitors_type = visitors_type.id where visitors.company_id = ".$company_id." order by visitors.name limit ".$from.",".$to;
                

            }

             $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
             $result = $this->db->query($query);
             if (!empty($result) and $result->rowCount()>0){

               return $resrow;//retorna os dados do banco como array


             }else{
                 return false;
             }
             $this->db = null;
         }
         catch(PDOException $e){
             echo $e->getMessage();
         }
              $this->db = null;
     }

     //===========================================================================================================
     //================================= insere novo visitante
     //=======================================================================================================


     public function insertNewVisitorbyCompany($name, $cpf, $picture, $visitors_type, $company_id)
     {
        try
        {
            $query = "INSERT INTO visitors (name, cpf, picture, visitors_type, company_id)VALUES('".$name."', '".$cpf."', '".$picture."', ".$visitors_type.", ".$company_id.") ";

            $sql = $this->db->prepare($query);
            $result = $this->db->query($query);
            if ($result){
              return true;
            }else{
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

    //===========================================================================================================
    //================================= insere novo visitante
    //=======================================================================================================


    public function EditVisitorbyCompany($name, $cpf, $picture, $visitors_type, $visitor_id, $company_id)
    {
       try
       {
           $query = " UPDATE visitors SET   name = '".$name."', cpf = '".$cpf."', picture ='".$picture."', visitors_type = ".$visitors_type." where id = ".$visitor_id." and company_id =".$company_id." ";

           $sql = $this->db->prepare($query);
           $result = $this->db->query($query);
           if ($result){
             return true;
           }else{
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
