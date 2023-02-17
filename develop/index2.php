<?php


$msg = '<link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<center>
 
<div align="center" style="border: 1px solid #e8e8e8;border-radius: 5px;width: 93%;box-shadow: 0 0 10px -5px #a5a5a5;">
    <div>
        <img style="width: 187px;float: left;margin: 21px 0 0 15px;" src="http://nextecbrasil.com.br/wp-content/uploads/2019/11/lOGO-NEXTEC.fw_.png">
    </div> 
    <a style="    float: right;margin: 25px;    text-decoration: none;    color: #0095ff;" href="#"> Acessar o Site</a> 
    <div>
        <div style="border-bottom: 1px solid #efefef;margin-top: 76px;"></div>
            
        <img style="    clear: both;    display: block;" src="http://nextecbrasil.com.br/wp-content/uploads/2019/11/23.gif">
    </div>
    <div>
        <h2 style=" color: #4a4a4a;" >        Bem Vindo a Nextec        </h2>
        <div style="text-align: center;">
            
            <h3 style="margin: 10px;color: #616161;"> Olá, tudo bem?<br/></h3>

            <h3 style="margin: 10px;color: #616161;" > Você recebeu um convite para acessar a empresa: <b>'.$company.',</b> <h3>
                <h4 style="margin: 10px;color: #616161;" > Para ativar sua conta e cadastrar uma senha clique <a href="http://acessocloud.nextecbrasil.com.br/api/newUserFirstAuth.php?token='.$token.'" >aqui</a></h4><br/><br/>
                
  ';
 
require_once '../api/phpmailer/class.phpmailer.php';


$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->SMTPDebug = 1;
$mailer->Port = 587; //Indica a porta de conexão 
$mailer->Host = 'smtp.weblink.com.br';//Endereço do Host do SMTP 
$mailer->SMTPAuth = true; //define se haverá ou não autenticação 
$mailer->Username = 'noreply@nextecbrasil.com.br'; //Login de autenticação do SMTP
$mailer->Password = '020406tai@JA'; //Senha de autenticação do SMTP
$mailer->FromName = 'Nextec'; //Nome que será exibido
$mailer->From = 'noreply@nextecbrasil.com.br'; //Obrigatório ser a mesma caixa postal configurada no remetente do SMTP
$mailer->AddAddress('thainan.nunes@nextecbrasil.com.br','');
//Destinatários
$mailer->isHTML(true);
$mailer->Subject = 'Nextec - sistemas';
$mailer->Body = $msg; 
if(!$mailer->Send())
{
echo "Message was not sent";
echo "Mailer Error: " . $mailer->ErrorInfo; exit; }
print "E-mail enviado!"
?>
</body>
</html>

 