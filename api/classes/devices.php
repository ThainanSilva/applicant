<?php

class devices{
	
        private $db;

    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
	
	//===============================================================================================================================
	//================================= cria token =============================================
	//===============================================================================================================================
	public function RegistNewDevice($DeviceId, $DeviceInfo, $company_id)//type 0 novo cadastro:::::  1 recuperar senha
	{
		try
		{ 
                    $token = md5(uniqid(rand(), true));
                    $sql = "INSERT INTO devices(company_id, name, token, deviceInfo, deviceId) VALUES( ".$company_id.", '".$DeviceInfo."', '".$token."', '".$DeviceInfo."', '".$DeviceId."')";
 
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
	//================================= cria token =============================================
	//===============================================================================================================================
	public function checkDevice($DeviceId, $DeviceInfo, $company_id)//type 0 novo cadastro:::::  1 recuperar senha
	{
		try
		{  
                    $query = "SELECT * FROM devices where company_id = ".$company_id." and deviceInfo =  '".$DeviceInfo."' and deviceId =  '".$DeviceId."' LIMIT 1";
                    $sql = $this->db->prepare($query);
                    $sql->execute();
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
 


	public function CheckDeviceToken($key){
			try
		{  
                    $query = "SELECT token FROM devices where token = '".$key."' LIMIT 1";
                    $sql = $this->db->prepare($query);
                    $sql->execute();
                    $row=$sql->fetch(PDO::FETCH_OBJ);
                    if (!empty($row)  ){
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
	
	function jsonfyError($result, $code, $message){
	    $return['result'] = $result;
	    $return['code'] = $code;
	    $return['message'] = $message;
	    return json_encode($return);
	}
        
        
        //===============================================================================================================================
	//================================= cria token =============================================
	//===============================================================================================================================
     public function getDeviceToken($company_id, $DeviceInfo, $DeviceId) {
         
		try
		{  
                    $query = "SELECT token FROM devices where company_id = ".$company_id." and deviceInfo =  '".$DeviceInfo."' and deviceId =  '".$DeviceId."' LIMIT 1";
                    $sql = $this->db->prepare($query);
                    $sql->execute();
                    $result = $this->db->query($query);
                    $row=$sql->fetch(PDO::FETCH_OBJ);
                    if (!empty($row) and $result->rowCount()>0){
                      return $row->token;//retorna os dados do banco como array
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

     public function getDeviceConfigByDevicId($deviceId) {
		try
		{  
                    $query = "SELECT devices.controleDE, ambients.name as ambientName, ambients.id as ambientId FROM devices left JOIN ambients ON devices.ambientID = ambients.id WHERE deviceId =  '".$deviceId."' LIMIT 1";
                    $sql = $this->db->prepare($query);
                    $sql->execute();
                    $result = $this->db->query($query);
                    $row=$sql->fetch(PDO::FETCH_OBJ);
                    if (!empty($row) and $result->rowCount()>0){
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

    public function getCompanyIdByToken($token)
    {
        try
        {
            $query = "SELECT company_id from devices WHERE token =  '".$token."' LIMIT 1";
            $sql =  $this->db->prepare($query);
            $sql->execute();                    
            
            $row=$sql->fetch(PDO::FETCH_OBJ);
            if (!empty($row)){
                return $row->company_id;//retorna os dados do banco como array
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

    public function getDevicesByCompanyId($company_id) {
        try
        {
            $query = "SELECT  devices.*, ambients.name as ambient from devices left JOIN ambients ON devices.ambientID = ambients.id WHERE devices.company_id = ".$company_id;
             $sql =  $this->db->prepare($query);
            $sql->execute(); 
            $row=$sql->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($row)){
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

}