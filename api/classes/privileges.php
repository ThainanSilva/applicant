<?php

class privileges
{
  private $db;
  function __construct($db_connect)
  {
    $this->db = $db_connect;
  }



 

      //===========================================================================================================
      //================================= pega informações de um unico usuário fornecido na variavel user_id
      //=======================================================================================================




      public function getUserInfoByCompany( $company_id, $user_id)
      {
         try
         {
             $query = "SELECT Users.name, Users.id, Users.email, profiles.name AS perfil
             FROM company
             INNER JOIN privileges ON company.id = privileges.company_id
             INNER JOIN profiles ON profiles.id = privileges.profile_id
             INNER JOIN Users ON Users.id = privileges.user_id
             WHERE company.id =".$company_id." and Users.id = ".$user_id." LIMIT    1";


             $sql = $this->db->prepare($query);
             $sql->execute();
             $resrow = $sql->fetchAll(PDO::FETCH_OBJ);
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

//********************************************delete company profiles***************************************

public function removeProfiles($company_id, $deletlist)
{
   try
   {

       $query = " DELETE FROM profiles WHERE company_id = ".$company_id." and id IN (".implode(',', (array)$deletlist).")";
       //echo $query;
       $sql = $this->db->prepare($query);
       $sql->execute();
       $resrow = $sql->fetchAll(PDO::FETCH_ASSOC);
       $result = $this->db->query($query);
       if(!empty($result)){
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


//==================================================================================================================
//============ pega informações de varios usuarios exceto as do fornecido na variavel user_id
//===============================================================================================================




      public function getUsersInfoByCompany( $company_id, $user_id)
      {
         try
         {
             $query = "SELECT Users.name, Users.id, Users.email, profiles.name AS perfil
             FROM company
             INNER JOIN privileges ON company.id = privileges.company_id
             INNER JOIN profiles ON profiles.id = privileges.profile_id
             INNER JOIN Users ON Users.id = privileges.user_id
             WHERE company.id =".$company_id." and Users.id != ".$user_id;


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




    public function getUserProfile($user_id, $company_id)
    {
       try
       {
           //echo 'teste  1 ';
           if(!isset($user_id,$company_id) && empty($user_id) && $company_id == ""){
               return false;
           }
           $query = "SELECT * FROM privileges WHERE company_id = '".$company_id."' and user_id = '".$user_id."' LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
             foreach ($resrow as $key) {
                 //echo 'perfil id: '.$key['profile_id'];
               return $key['profile_id'];
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



  //========================================================================================
  //================================= retorna qual o nivel de privilegio que o susuário tem no objeto selecionado
  //================================================================================================================

  public function GetAllUsersProfileInfo($userProfile)
  {
     try
     {
         $query = "SELECT * FROM profiles WHERE id = '".$userProfile."' LIMIT 1";
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

    
    
  //========================================================================================
  //================================= retorna qual o nivel de privilegio que o susuário tem no objeto selecionado
  //================================================================================================================

  public function GetUsersInfo($option, $userProfile)
  {
     try
     {
         $query = "SELECT ".$option." FROM profiles WHERE id = '".$userProfile."' LIMIT 1";
         $sql = $this->db->prepare($query);
         $sql->execute();
         $resrow = $sql->fetchAll();
         $result = $this->db->query($query);
         if (!empty($result) and $result->rowCount()>0){
           foreach ($resrow as $key) {
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


 //===============================================================================================================================
 //================================= cria token =============================================
 //===============================================================================================================================




 public function getProfiles($company_id)
 {
    try
    {

        $query = "SELECT id, name FROM profiles WHERE company_id = ".$company_id." or company_id = 0";
        $sql = $this->db->prepare($query);
        $sql->execute();
        $resrow = $sql->fetchAll(PDO::FETCH_OBJ);
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
    //================================= cria token =============================================
    //===============================================================================================================================




    public function ProfileHasUsers($profiles, $company_id)
    {
        try
        {


            $query = "SELECT profile_id FROM privileges WHERE company_id = ".$company_id." and id IN (".implode(',', (array)$profiles).")";

            $sql = $this->db->prepare($query);
            $sql->execute();
            $result = $this->db->query($query);
            if (!empty($result)){
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
