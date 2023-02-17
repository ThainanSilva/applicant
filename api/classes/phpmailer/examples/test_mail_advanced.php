<html>
<head>
<title>PHPMailer - Mail() advanced test</title>
</head>
<body>

<?php
require_once '../class.phpmailer.php';


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
$mailer->Subject = 'Teste enviado através do PHP Mailer SMTPLW';
$mailer->Body = 'Este é um teste realizado com o PHP Mailer SMTPLW';
if(!$mailer->Send())
{
echo "Message was not sent";
echo "Mailer Error: " . $mailer->ErrorInfo; exit; }
print "E-mail enviado!"
?>
</body>
</html>
