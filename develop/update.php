<?php


    
            $host = 'localhost';
            $user = 'u184619155_acess';
            $password = '020406tai@JA';
            $db = 'oneworld';
            $connstate = '';
 
        
        try {
            $db_connect = new PDO("mysql:host=$host;dbname=$db", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES  utf8"));
            /*** echo a message saying we have connected ***/

        }
        catch(PDOException $e)
        {
           echo $e->getMessage();
        }





class update
{
    private $db;

    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
    
    
    ///*********************************************************************
         public function insertNewUsr($name)
     {
        try
        {
            
            
            
            $query = "SELECT name FROM usr where name = '$name'";
            $sql = $this->db->prepare($query);
            $result = $this->db->query($query);
        
            if ($result->rowCount()<=0){
                
             
          
            $query = "INSERT INTO  usr (name,active)VALUES('".$name."', 1)";
            $sql = $this->db->prepare($query);
            $result = $this->db->query($query);
            if ($result){
              return true;
            }else{
                return false;
            }
            $this->db = null;
        }}
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
             $this->db = null;
    }

    
    

    //**********************************************************************
    public function getOthers($name)
        {
           try
           {
               $query = "SELECT * FROM usr WHERE active = 1 and name != '$name'";
               $sql = $this->db->prepare($query);
               $sql->execute();
               $resrow = $sql->fetchAll();
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
    
    //***********************************************************************
    public function updatePosition($name, $width, $height, $gbc)
    {
       try
       {
           $query = " update usr set width = '$width', height = '$height', gbc =$gbc where name = '$name' ";

           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if ($result){
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


$update = new update($db_connect);


if(isset($_POST['newUsr'])){

    if (isset($_POST['newUsr']) and $_POST['newUsr'] == 0){
        if($update->updatePosition($_POST['name'], $_POST['width'], $_POST['height'], $_POST['gbc'])){
            if($jsonReturn = $update->getOthers($_POST['name'])){
                $jsonencoded = json_encode($jsonReturn);
                echo $jsonencoded;
           
            
        }
            
        }
    }    
    if (isset($_POST['newUsr']) and $_POST['newUsr'] == 1){
        if($update->insertNewUsr($_POST['name'])){
            echo "'message': 'ok'";
        }
        
    }




}else{
  $json_a['result'] = 'error';
  $json_b = json_encode($json_a);
  echo $json_b;
}












?>