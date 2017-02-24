<?php
class USER
{
    private $db;
 
    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }

    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
    
    public function insertNew($uname,$uemail,$upass)
    {
       try
       {
                echo $uname;
                echo $uemail;
                echo $upass;
           
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $sql = "INSERT INTO usuarios(nome,email,senha, create_date) VALUES('".$uname."','".$uemail."', '".$new_password."','".date("d/m/Y")."')";
           echo $sql;
           $caller = $this->db->prepare($sql);
           $result = $caller->execute();
           if ($result){
                return true;
            }
            else
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
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
    
    public function fbRegister($fname,$faceid)
    {
       try
       {
            
           $stmt = $this->db->prepare("INSERT INTO usuarios(nome,faceid, create_date) 
                                                       VALUES('".$fname."', '".$faceid."', '".date("d/m/Y")."')");
              
           $stmt->execute(); 
   
           return $stmt; // retorna true or false 
           $this->db = null;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }  
             $this->db = null;
    }    
    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
    public function fbLoginExist($fid)
    {
        try
        {
            
            $sql = "SELECT faceid  FROM usuarios where faceid = '".$fid."'";
            $this->db->prepare($sql);
            $result = $this->db->query($sql);
            if ($result->rowCount()>0){
                //   foreach($db_connect->query($sql) as $row) {
                return true; //etc...
                
            }
            else{
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
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //===============================================================================================================================    
    
    public function login($uemail,$upass)
    {
       try
       {
            
           
           $query = "SELECT * FROM usuarios WHERE email= '".$uemail."' and ultimaempresa != 0 LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
               foreach($resrow as $row) {
                   if (password_verify($upass, $row['senha'])) {
                   $_SESSION['user_session'] = $row['id'];
                   $_SESSION['user_faceid'] = $row['faceid'];
                   $_SESSION['user_email'] = $row['email'];
                   $_SESSION['user_name'] = $row['nome'];
                   $_SESSION['user_editando_empresa'] = $row['ultimaempresa'];
                    return true;
                }
                   else {
                       return false;
                   }
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
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //===============================================================================================================================    
    
    public function fbLoginExecute($fid)
    {
       try
       {
           session_start('usuario');
          $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE faceid = '".$fid."'");
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             
                $_SESSION['user_session'] = $userRow['id'];
                $_SESSION['user_faceid'] = $fid;
                $_SESSION['user_name'] = $userRow['nome'];
              
                return true;
             
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
           return false;
       }
   }

    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //===============================================================================================================================
   
    public function isLoggedIn()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;    
      }
   }
    
    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
   
    public function redirect($url)
   {
       header("Location: $url");
   }
    
    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
   
    public function metaRedirect($url)
   {
        echo '<META http-equiv="refresh" content="0;URL='.$url.'">';
   }
    
    
    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //=============================================================================================================================== 
   
    public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }

    
    
    //===============================================================================================================================
    //================================= is_adm verifica se o usuario é administrador=============================================
    //=============================================================================================================================== 
   
    public function isAdm($user_id)
   {
        try
        {    
                
            $sql = "SELECT id adm FROM usuarios WHERE id= ".$user_id." and adm = 1 LIMIT 1";
            $this->db->prepare($sql);
            $result = $this->db->query($sql);
            if (!empty($result) and $result->rowCount()>0){
                return true;
            }
            else
            {
                return false;
            }
         $this->db = null;
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
           return false;
       }
        
        
        $this->db = null;
        return true;
   }  
    //===============================================================================================================================
    //================================= emailExist =============================================
    //=============================================================================================================================== 
   
    public function emailExist($email)
   {
        try 
        {       
            $sql = "SELECT email FROM usuarios WHERE email= '".$email."' LIMIT 1";
            $this->db->prepare($sql);
            $result = $this->db->query($sql);
            if (!empty($result) and $result->rowCount()>0){
                return true;
            }
            else
            {
                return false;
            }
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
           return false;
       }
        
        
        $this->db = null;
   }
    
    
    
    //===============================================================================================================================
    //================================= validEmail =============================================
    //=============================================================================================================================== 
   
    public function validEmail($email)
   {
 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return  true;
        
        }
        else{
            return false;
                
        }

    
    
    }
    
    
    //===============================================================================================================================
    //================================= validName =============================================
    //=============================================================================================================================== 
   
    public function validName($name)
   {
 
        if (preg_match("#^([àáãâéêíóõôúüça-z\\._\/ ]+)$#i",$name)) {
            return true;
        }
        else{
            return false;
                
        }

    
    
    }
    
       
        //===============================================================================================================================
    //================================= validName =============================================
    //=============================================================================================================================== 
   
    public function validNum($name)
   {
 
        if (is_numeric($name)) {
            return true;
        }
        else{
            return false;
                
        }

    
    
    }
    
       
    
    //===============================================================================================================================
    //================================= emailExist =============================================
    //=============================================================================================================================== 
    
    
        public function sendRecEmail($email)
   {
            try{
                
                 $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = '".$email."'");
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             
                $nome= $userRow['nome'];
              
          }
                
                
                
                $textEmail = "
                <!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==' crossorigin='anonymous'>

                <h2>Ola $nome,</h2>
                <p>recebemos uma solicitaçao de recuperaçao de senha, para que você possa alterarsua senha clique no link a baixo</p>
                
                <h3><a href='#'>Recuperar senha</a></h3>
                
                
                
                ";
 

            
                // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
                // O return-path deve ser ser o mesmo e-mail do remetente.
                $headers = "MIME-Version: 1.1\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: noreply@peguei.net\r\n"; // remetente
                $headers .= "Return-Path: noreply@peguei.net\r\n"; // return-path
                $envio = mail($email, "Recuperaçao de Senha", $textEmail, $headers);

                if($envio)
                return true;
                else
                    return false;

            }
            catch (Exception $e) {
                return false;
                
            }
    
            $this->db = null;
    }
    
    
    
    
    
}
