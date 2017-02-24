<?php
class dbtrans
{
    private $db;
 
    function __construct($db_connect)
    {
      $this->db = $db_connect;
    }
    
        
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 
    
    public function showListas()
    {
       try
       {
           $query = "SELECT *  FROM listas";
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if (!empty($result) and $result->rowCount()>0){
               $i = 1;
               echo '<table class="table table-striped">
               <thead>
               <tr>
               <th>#</th>
               <th>ID</th>
               <th>Nome</th>
               <th>Padrão do sistema</th>
               </tr>
               </thead>
               <tbody>';  
                foreach($db_connect->query($sql) as $row) {
                echo "<tr><th scope='row' >".$i."</th>";
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['nome'].'</td>';
                echo '<td>'.$row['default'].'</td>';
                echo '</tr>';
                    $i++;
                }

                echo '</tbody></table>';
            
            }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    $this->db = null;
    }
        
    
    
    
    
    
    public function insertNewContact($newName, $newPhone, $newObs){
        
           try
       {

           $sql = "INSERT INTO cont_listas(nome,telefone,obs, id_user, data ) VALUES('".$newName."','".$newPhone."', '".$newObs."', ".$_SESSION['user_session'].", '" . date("d/m/Y") ."' )";
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
       }    
             $this->db = null;
        
        
        
        
    }
    
    
    
    
    
    
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 

    
    public function showUsers($users_ids)
    {
       try
       {    
           $n=0;
           $query = "SELECT *  FROM usuarios where id !=".$users_ids[$n];
           $n++;
           //echo count($users_ids) ;
           if(count($users_ids)>$n){
           while ($n<=count($users_ids)){
               $query.= ' and id = '.$users_ids[$n];
                    $n++;
               
           }
               }
      
           
           
           
            
           $sql = $this->db->prepare($query);
           $sql->execute();
           $resrow = $sql->fetchAll();
           $result = $this->db->query($query);
           if ($result->rowCount()>0){
               $i = 1;

               
               $return_json= '[{';
               foreach($resrow as $row) { 
                   $return_json.= '"id_user""'.$row['id'].'","id_utils":{';
                   $return_json.= '"user_nome":"'.$row['nome'].'",';
                   $return_json.= '"user_email":"'.$row['email'].'"}}]';
                   
                   
                    $i++;
                }
                return $return_json;
            
            }

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
            $this->db = null;
    }
     
    
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    public function admValueToWord($value)
    {
        switch ($value) {
            case 1:
                return 'Administrador';
                break;
            case 0:
                return 'Usuario';
                break;
        
            }
    }
 
    
    
       
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 
 
    
    public function showPegueiResultsIndvidual($id){
        
        try{
            $query = "SELECT * FROM cont_listas where id =".$id." and id_user= ".$_SESSION['user_session']."";
 
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $jsonData = array();
            $result = $this->db->query($query);
            if ($result->rowCount()>0){
                
                $json=json_encode($resrow);
                echo $json;


       }
        
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
            $this->db = null;
    
      }
    
    
    
    
    
    
    public function removePeguei($id){
        
        try{
            
            
            
            foreach ($id as $nid) {
                
                
                
                
                
                

            $query = "DELETE  FROM cont_listas where id =".$nid." and id_user= ".$_SESSION['user_session']."";
 
            $sql = $this->db->prepare($query);
                if($sql->execute()){
                    return "success";
                }
                else{
                    $erro = "não é proprietario deste objeto";
                    
                    return $erro;
                }
  

                            }
        
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
            $this->db = null;
    
      }
    
    
    
    
    
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    
    public function changeAdm($user,$profile){
        try {
            $query = "UPDATE usuarios set adm = ".$profile." where id = ".$user."";
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if ($result->rowCount()>0){
                
                
                return true;
           
            }    
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
         $this->db = null;       
    }
    
      
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    public function editContact($id,$name,$phone, $obs, $faceid){
        try {

              $query = "UPDATE cont_listas set nome = '".$name."', telefone = '".$phone."', obs = '".$obs."', id_facebook = '".$faceid."' where id = ".$id." and id_user = ".$_SESSION['user_session'];

            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            return true;
   
        } 
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
         $this->db = null;       
    }  
    
    
    //===============================================================================================================================
    //=================================              encontrar numa string              =============================================
    //=============================================================================================================================== 


    
    public function findidface($face){
        try {
                        
            $pos = strpos($face, 'id=');
            
            $pos2 = strpos($face, '&');
   
            $rtr = substr($face, $pos+3, 15);
            
            return $rtr;
            
            
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
      
    }
    
    
        //===============================================================================================================================
    //=================================              salvar id do facebook numa string              =============================================
    //=============================================================================================================================== 


    
    public function findidfaceSave($face){
        try {
            if ($face != ""){
            if(strpos($face, 'id=')){
                $pos = strpos($face, 'id=');
                $pos2 = strpos($face, '&');
                $rtr = substr($face, $pos+3, 15);
                    
                
            }
                if (filter_var($face, FILTER_VALIDATE_URL)) {
                
                $ch = curl_init($face);
                curl_setopt( $ch, CURLOPT_POST, false );
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
                curl_setopt( $ch, CURLOPT_HEADER, false );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                $data = curl_exec( $ch );
                curl_close($ch);
                if(strpos($data, 'profile_id=')){
                    $pos = strpos($data, 'profile_id=');
                    $rtr = substr($data, $pos+11, 15);

                }else{
                    if(strpos($data, 'entity_id')){
                    $pos = strpos($data, 'entity_id":"');
                    $rtr = substr($data, $pos+12, 15);
                    }
                    
                }
   
                
            }
                
                
             if (is_numeric($face)){
                $rtr = $face;
                                      
            } 
                
                
                
                
            if (is_numeric($rtr)){
                return $rtr;
                                      
            }else{
                return "";
            }
                
            
            }
            

            
            
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
       
    }
    
    
    
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 

public function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}

     
    
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 

public function emptyfaceimg($Faceid){
    
    if(!empty($Faceid)){
        return '<img class="faceuserimglist" src="//graph.facebook.com/'.$Faceid.'/picture?type=square">';
    }

    return $Faceid;

}       
    
    
    
    
    

    
    
    
     
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    
        
    
    public function GetCompanyData($companyId){
        try {
            
            $query = "SELECT *  FROM empresas where id =".$companyId; 
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if ($result->rowCount()>0){

               foreach($resrow as $row) {
                   
                   $e_return['empresa_id'] = $row['id'];
                   $e_return['empresa_nome'] = $row['nome_fantasia'];
                   $e_return['empresa_rzs'] = $row['razao_social'];
                   $e_return['empresa_cnpj'] = $row['cnpj'];
                   $e_return['empresa_cdate'] = $row['create_date'];
                 }
                return $e_return;

           }else{
            }
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
         $this->db = null;       
    }
    
    
    
    
    
    
     
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    
        
    
    public function GetCompanyUsers($companyId){
        try {
            
            $query = "SELECT *  FROM empresaxusuarios where id_empresa =".$companyId; 
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if ($result->rowCount()>0){
$i =0;
               foreach($resrow as $row) {
                   
                   $e_return[$i] = $row['id_usuario'];

                  $i++;
                 }
                return $e_return;

           }else{
            }
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
         $this->db = null;       
    }
    
    
    
        
     
    //===============================================================================================================================
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    
    
    public function check_empresa_user($user_id,$empresa_id)
    {
       try
       {
            
           
           $query = "SELECT * FROM empresaxusuarios WHERE id_empresa= '".$empresa_id."' and id_usuario= '".$user_id."'LIMIT 1";
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
    //================================= showListas mostra as listas existentes no db=============================================
    //=============================================================================================================================== 


    
    
        
    
    public function showUserpesquisa($receive, $numero){
        try {
 
            $query = "SELECT *  FROM cont_listas where id_user =".$_SESSION['user_session']." and nome like '%".$receive."%' and telefone like '%".$numero."%'"; 
      
            $sql = $this->db->prepare($query);
            $sql->execute();
            $resrow = $sql->fetchAll();
            $result = $this->db->query($query);
            if (1==1){
 $i = 1;
               echo '<table class="content-table table-hover table table-striped">
               <thead>
               <tr>
               <th>#</th>
               <th>Nome</th>
               <th>telefone</th> 
               <th>Observação</th>
               <th></th>
               </tr>
               </thead>
               <tbody>';
               foreach($resrow as $row) {
                echo "<tr class='line' id='peguei_".$row['id']."'>";
                echo '<td style="width:25%;" >'.$this->emptyfaceimg($row['id_facebook']).'</td>';   
                echo '<td style="width:25%;" ><a href="#" class="btn_edit_peguei" data-toggle="modal" data-target="#sedit_peguei" data-id="'.$row['id'].'" >'.$row['nome'].'</td>';
                echo '<td style="width:25%;" ><a href="tel:'.$row['telefone'].'">'. $this->Mask('(##)####-####',$row['telefone']).'</a></td>';
                echo '<td style="width:25%;" >'.substr($row['obs'], 0, 20).'...</td>';
                echo '<td style="width:15%;" ><input class="selection" ng-checked="toRemove('.$row['id'].')" value="'.$row['id'].'" type="checkbox" > </td>';
                echo '</tr>';
                    $i++;
                }
                               echo ' <tr class="newuserline" style="height:51px; display:none;" >
                               <td class="newuserdata"  style=" display:none;" > <br /></td>
                <td class="newuserdata"  style="width:25%; display:none;" ><input class="inputsmalllist form-control" type="text" id="newName" ></td>
                <td class="newuserdata"  style="width:25%;  display:none;" ><input class="inputsmalllist form-control" type="tel" id="newPhone" ></td>
                <td class="newuserdata"  style="width:25%;  display:none;" ><input class="form-control inputsmalllist" type="text"  id="newObs" ></td>
                <td class="newuserdata"  style=" display:none;" ><button id="salva_novo_peguei" class="btn btn-default btn-lg" >Salvar</button></td> 
                </tr>
               ';
                echo '</tbody></table>'; 
           }               else{
                echo '<table class="content-table table-hover table table-striped">
               <thead>
               <tr>
               <th>#</th> 
               <th>Nome</th>
               <th>telefone</th>
               <th>Observação</th>
               <th></th>
               </tr>
               </thead>
               <tbody>';
                
                
                echo ' <tr class="newuserline" style="height:51px; display:none;" >
                               <td class="newuserdata"  style=" display:none;" > <br /></td>
                <td class="newuserdata"  style="width:25%;  " ><input class="inputsmalllist form-control" type="text" id="newName" ></td>
                <td class="newuserdata"  style="width:25%;   " ><input class="inputsmalllist form-control" type="tel" id="newPhone" ></td>
                <td class="newuserdata"  style="width:25%;  " ><input class="form-control inputsmalllist" type="text" id="newObs" ></td> 
                <td class="newuserdata"    ><button  id="salva_novo_peguei" class="btn btn-default btn-lg" >Salvar</button></td>
                </tr>
               ';
                echo '</tbody></table>';
            }
        }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
         $this->db = null;       
    }
    
}