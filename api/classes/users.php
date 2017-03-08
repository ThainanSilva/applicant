<?php
class USER
{
    private $db;

    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
        //===============================================================================================================================
        //================================= retorna os dados da empresa num array =============================================
        //===============================================================================================================================
        public function getCompanyInfo($company_id)
        {
           try
           {
               $query = "SELECT * FROM company WHERE id = '".$company_id."' LIMIT 1";
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
    //===============================================================================================================================
    //================================= verifica se as datas batem com a atual=============================================
    //===============================================================================================================================
    public function ValidateDate($m, $d, $y)
    {
        if($m >= date('m') and $d >= date('d')and $y >= date('y')){
            return true;
        }else{
            return false;
        }
   }
       //===============================================================================================================================
       //================================= atualiza o token e o invalida=============================================
       //===============================================================================================================================
    public function invalidateToken($token)
    {
       try
       {
           $query = " update tokens set valid = 0 where token = '".$token."' ";
           $sql = $this->db->prepare($query);
           $sql->execute();
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
    //===============================================================================================================================
    //================================= atualiza senha do ususario=============================================
    //===============================================================================================================================
    public function updateUserPassword($user_id, $user_password)
    {
       try
       {
           $new_password = password_hash($user_password, PASSWORD_DEFAULT);
           $query = " update Users set password = '".$new_password."' where id = ".$user_id. " LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute(); 
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
    //===============================================================================================================================
    //================================= atualiza nome do ususario=============================================
    //===============================================================================================================================
    public function updateUserName($user_id, $user_name)
    {
       try
       {
           $query = " update Users set name = '".$user_name."' where id = ".$user_id. " LIMIT 1";
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
    //===============================================================================================================================
    //================================= retorna informções do token num array=============================================
    //===============================================================================================================================
    public function getTokenInfo($token)
    {
       try
       {
           $query = "SELECT * FROM tokens WHERE token= '".$token."' LIMIT 1";
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
    //===============================================================================================================================
    //================================= envia email de cadastro de novo usuário =============================================
    //===============================================================================================================================
    public function SendTokenNewUser($to, $token, $company)
    {
        $subject = 'Cadastro AcessoCloud 5FCloud';
        $headers = "From: no-reply@5fcloud.com\r\n";
        $headers .= "Reply-To: no-reply@5fcloud.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = '<html>
        <body>
        <div style="background: #333;height: 48px;">
        <img style="margin-left: 10%;margin-top: 1%;height: 31px;" src="http://acessocloud.5fcloud.com/images/5fcloudlogosmall.png">
        </div>
        <br/>
        <h1>Olá, bem vindo ao universo 5FCloud,<h1><h2> sua conta foi criada para acessar a empresa '.$company.', <h2>
        <h4> Para ativar sua conta e cadastrar uma senha clique <a href="http://acessocloud.5fcloud.com/api/newUserFirstAuth.php?token='.$token.'" >aqui</a>
        </body>
        </html>';
        if(mail($to, $subject, $message, $headers)){
            return true;
        } else{
            return false;
        }
    }
    //===============================================================================================================================
    //================================= cria token =============================================
    //===============================================================================================================================
    public function newToken($userId, $type, $company_id)//type 0 novo cadastro:::::  1 recuperar senha
    {
       try
       {
           $length = 78;
           if (function_exists('openssl_random_pseudo_bytes')) {
               $token = bin2hex(openssl_random_pseudo_bytes($length));
            }

           if($this->checkTokenExists($token)){
               if (function_exists('openssl_random_pseudo_bytes')) {
                   $token = bin2hex(openssl_random_pseudo_bytes($length));
                }
            }
            $sql = "INSERT INTO tokens(
            token,
            user_id,
            date,
            valid,
            type,
            company_id
            ) VALUES(
            '".$token."',
            '".$userId."',
            '".date("d/m/Y").": ".date("H:i")."',
            1,
            '".$type."',
            ".$company_id."
            )";
           $stmt = $this->db->prepare($sql);
           if($stmt->execute()){
             return $token;
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
    //================================= adiciona os privilegios na criação de um novo usuário =============================================
    //===============================================================================================================================
    public function newUserPrivileges($userId, $profileId, $companyId, $creatorUserId)
    {
       try
       {
           $stmt = $this->db->prepare("INSERT INTO privileges(
           company_id,
           user_id,
           profile_id,
           date,
           creator_id
           ) VALUES(
           '".$companyId."',
           '".$userId."',
           '".$profileId."',
           '".date("d/m/Y").": ".date("h:m")."',
           '".$creatorUserId."'
           )");
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
    //================================= verifica se o token é valido=============================================
    //===============================================================================================================================
    public function checkTokenValid($token)
    {
       try
       {
           $query = "SELECT * FROM tokens WHERE token= '".$token."' and valid = 1 LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
               foreach($resrow as $row){
                   $dbToken = $row['token'];
                   $dbDate = $row['date'];
               }
               if($dbToken == $token){
                   $d = substr($dbDate, 0,2);
                   $m = substr($dbDate, 3,2);
                   $y = substr($dbDate, 6,4);
                   if($this->ValidateDate($m, $d, $y)){
                       return "valid";
                   }else{
                       return 'expired';
                   }
               }else{
                   return "nonvalid";
               }
           }else
           {
               return "nonvalid";
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
    //================================= verifica se o token existe=============================================
    //===============================================================================================================================
    public function checkTokenExists($token)
    {
       try
       {
           $query = "SELECT * FROM tokens WHERE token= '".$token."' LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
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
     //===============================================================================================================================
    //================================= verifica se o usuario existe=============================================
    //===============================================================================================================================
    public function checkuserexists($email)
    {
       try
       {
           $query = "SELECT * FROM Users WHERE email= '".$email."' LIMIT 1";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
               foreach($resrow as $row) {
                   return $row['id'];
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
     //================================= Retorna o Id do usuario pelo email fornecido na variavel email =============================================
     //===============================================================================================================================
     public function GetUserIdByEmail($email)
     {
        try{
            $query = "SELECT id FROM Users WHERE email = '".$email."' LIMIT 1";
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if (!empty($result) and $result->rowCount()>0){
              foreach ($resrow as $key) {
                return $key['id'];
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
    //=================================================================================================
    //================================= cria um novo Usuário na tablea Users apneas com o Email e a data atual===========
    //===============================================================================================================================
    public function insertNew($email)
    {
       try
       {
           $sql = "INSERT INTO Users(email, date) VALUES('".$email."', '".date("d/m/Y").": ".date("h:m")."')";
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
    //==================== dá uma resposta padrão {result: variavelresult, message variavelmessage} em formato json =================
    //===============================================================================================================================
    public function jsonfyResponse($result,$message)
    {
           $response = array('result' => $result, "message"=> $message);
           $response_array = json_encode($response);
           return $response_array;
    }
    //===============================================================================================================================
    //================================= registra novo usuario facebook (função não utiliada)=============================================
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
    //================================= verifica se usuario facebook existe (função não utiliada)=============================================
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
    //================================= verifica se os dados fornecidos na tela de login batem com o DB =================
    //===============================================================================================================================

    public function login($uemail,$upass)
    {
       try
       {
           $query = "SELECT * from Users where email = '".$uemail."' ";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
               foreach($resrow as $row) {
                   if (password_verify($upass, $row['password'])) {
                    return $row;
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
    //================================= executa login com facebook(função não utilizada)=============================================
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
    //=================================  verifica se o usuario já está logado=============================================
    //===============================================================================================================================
    public function isLoggedIn()
   {
      if(isset($_SESSION['user_id']))
      {
         return true;
      }
   }
    //===============================================================================================================================
    //================================= executa o logout                 =============================================
    //===============================================================================================================================
    public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
   //================================================================================================
   //======= retorna se o usuário fornecido tem acesso á empresa forneceida pelas variaveis ========
   //================================================================================================

     public function companyByUser($user_id, $company_id)
    {
         try
         {
             $sql = "SELECT * from  privileges WHERE user_id = ".$user_id." and company_id = ".$company_id;
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
    //================================================================================================
    //================= retorna o numero de empresas que o usuario tem acesso  (exemploe :1 :2 :3) ==========================
    //================================================================================================

    public function numCompanyByuser($user_id)
   {
        try
        {
            $sql = "SELECT * from  privileges WHERE user_id = ".$user_id;
            $this->db->prepare($sql);
            $result = $this->db->query($sql);
            if (!empty($result) and $result->rowCount()>0){
				return $result->rowCount();
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



     //================================================================================================================
    //=== retorna a quantidade de empresas, perfil e o nome da empresa do usuario fornecido pela variavel =============
    //================================================================================================================
    public function viewCompanysByUser($user_id)
   {
        try
        {
            $sql = "
					SELECT company.name, company.id, profiles.name as perfil
					FROM company
					  INNER JOIN privileges
						ON company.id = privileges.company_id
					INNER JOIN profiles
						ON profiles.id = privileges.profile_id
					WHERE user_id = ".$user_id;
            $this->db->prepare($sql);
            $result = $this->db->query($sql);
            if (!empty($result) and $result->rowCount()>0){
				return $result;
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
    //================================= envia email e recuperação de senha  =============================================
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
    //===============================================================================================================================
    //================================= is_loggedin verifica se o usuario já está logado=============================================
    //===============================================================================================================================

    public function redirect($url)
   {
       header("Location: $url");
   }
}
