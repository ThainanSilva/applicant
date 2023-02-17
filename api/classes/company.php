<?php
 
 
 
class company  
{
    private $db;

    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
 
      //===============================================================================================================================
      //================================= cria token =============================================
      //===============================================================================================================================




      public function SaveNewProfile($company_id, $data)
      {
         try {

             $stmt = $this->db->prepare('INSERT INTO profiles (company_id, name, config, config_user, visitors, schedules, Reports, Registeraccess, devices)VALUES (:company_id, :name, :config, :config_user, :visitors, :schedules, :reports, :registeraccess, :devices )');
             foreach($data as $key=>$value) {
                 $stmt->bindValue(':'.$key, $value);
             }
             $stmt->bindValue(':company_id', $company_id);
            if ($stmt->execute()) {
                 return true;
             } else {
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
      //================================= cria token =============================================
      //===============================================================================================================================




      public function ProfileExist($company_id, $data)
      {
         try {
             $query = 'Select * from profiles where company_id = '.$company_id.' and name = "'.$data.'" ';
            $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
             if (!empty($resrow)){
                 
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
      //===============================================================================================================================
      //================================= cria token =============================================
      //===============================================================================================================================




      public function getCompanyTimezone($company_id)
      {
         try
         {
             $query = "SELECT timezone FROM company WHERE id =".$company_id." limit 1 ";
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

     
      //===============================================================================================================================
      //================================= cria token =============================================
      //===============================================================================================================================




      public function CompanyExistsByCNPJ($CNPJ)
      {
         try
         {
             $query = "SELECT * FROM company WHERE CNPJ_CPF =".$CNPJ." limit 1 ";


             $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll();
             if ($resrow){
               return $resrow[0]['id'];//retorna os dados do banco como array


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
      //================================= cria token =============================================
      //===============================================================================================================================

      public function getCompanyInfo( $company_id)
      {
         try
         {
             $query = "SELECT * FROM company WHERE id =".$company_id." limit 1 ";             
             $sql = $this->db->prepare($query);
             $sql->execute();
             $row=$sql->fetch(PDO::FETCH_OBJ);
             if (!empty($row) ){
               return $row;//retorna os dados do banco como array
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
      //================================= cria token =============================================
      //===============================================================================================================================

     public function getCompanyConfig($company_id, $option)
     {
        try
        {
            $query = "SELECT ".$option." FROM company WHERE id =".$company_id." limit 1 ";
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if (!empty($result) and $result->rowCount()>0){
              foreach($resrow as $key){
                return $key[$option];
              }

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
//********************************************saveeditcompany***************************************

     public function saveEditCompany($RAZAO_SOCIAL, $CNPJ_CPF, $timezone, $NAME, $company_id)
     {
        try
        {
            $stmt = $this->db->prepare("UPDATE company set RAZAO_SOCIAL = :RAZAO_SOCIAL, CNPJ_CPF = :CNPJ_CPF, timezone = :timezone, NAME = :NAME  WHERE id =".$company_id." limit 1 ");
            $stmt->bindValue(':RAZAO_SOCIAL', $RAZAO_SOCIAL);
            $stmt->bindValue(':CNPJ_CPF', $CNPJ_CPF);
            $stmt->bindValue(':timezone', $timezone);
            $stmt->bindValue(':NAME', $NAME);
            if($stmt->execute()){
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
    //********************************************get company profiles***************************************

     public function getCompanyProfiles($company_id)
     {
        try
        {
 
            $query = "Select * from profiles where company_id = ".$company_id;
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

    
 
    //********************************************get company profiles***************************************

     public function getCompanyProfilesAttr($company_id)
     {
        try
        {
            $stmt = $this->db->prepare("Select * from profiles where company_id = ".$company_id);
            $result = $stmt->fetchAll();
            if($result){
                return $result;
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

    public function getCompanyFieldsByCompanyID($company_id) {
                try
        {
            $stmt = $this->db->prepare("Select * from fields where company_id = ".$company_id);
            $result = $stmt->fetchAll();
            if($result){
                return $result;
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
?>