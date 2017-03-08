<?php
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');

   if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){

   }
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AcessoCloud - 5FCloud</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->


   <script src="../js/jquery-3.1.0.min.js"></script>
   <script src="../js/bootstrap-datetimepicker.min.js"></script>
   <script src="../js/jquery.maskedinput.min.js"></script>   

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/bootstrap-datetimepicker.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="style/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> 

<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16">  
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="../safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

   <script src="js/app.js"></script>

</head>






	<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a id="navbarbrand" class="navbar-brand" href="#"><img class="navbar-brand" src="../images/android-chrome-192x192.png" / ></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i> <?php echo $_SESSION['company_identifier']?> <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="chooseCompany.php"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Mudar Empresa</a></li>
            <?php if($priv->GetUsersInfo('config', $userProfile) > 0){  ?>   <li role="separator" class="divider"></li>
            <li><a id="usersConfigs" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuários</a></li><?php }?>
            <?php if($priv->GetUsersInfo('config', $userProfile) > 0){  ?><li role="separator" class="divider"></li>
             <li><a id="companyConfigs"href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações</a></li>        <?php }   ?>
          </ul>
        </li>

				<li class="active"><a id="dashboard" href="#"><i class="fa fa-tachometer" aria-hidden="true"></i> Painel <span class="sr-only">(current)</span></a></li>

      	<?php if($priv->GetUsersInfo('visitors', $userProfile) > 0){  ?>
          <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="dropdown" aria-haspopup="true" aria-expanded="false" id="visitors" href="#"><i class="fa fa-users" aria-hidden="true"></i> Visitantes <span class="caret"></span></a>
             <ul class="dropdown-menu">

               <li><a id="visitorsType" href="#"><i class="fa fa-user" aria-hidden="true"></i> Tipos de visitantes</a></li>
               <li><a href=""><i class="fa fa-universal-access" aria-hidden="true"></i>
Perfis de Acesso</a> </li>
             </ul>
           </li>


           <?php }?>

        <?php if($priv->GetUsersInfo('devices', $userProfile) > 0){  ?>   <li><a id="devices" href="#"><i class="fa fa-microchip" aria-hidden="true"></i> Dispositivos</a></li><?php }?>
        <?php if($priv->GetUsersInfo('schedules', $userProfile) > 9){  ?>   <li><a id="schedules  " href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> Horarios</a></li><?php }?>
        <?php if($priv->GetUsersInfo('reports', $userProfile) > 0){  ?>   
        <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> Relatorios</a>
        <ul class="dropdown-menu">
 
             <li><a id="access" href="#"> Acessos por periodo</a></li>           
             <li><a href="#"> Visitantes Ativos</a></li> 
             <li><a href="#"> Tipos de Visitantes</a></li>
             <li><a href="#"> Usuários</a></li>  
           </ul>
        
        
        
        </li><?php }?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['user_name']?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Mudar minha senha</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logOut.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


  <div id="contentmanager" class="content">

    <div class="window-spacer"><h3>Bem vindo <?php echo $_SESSION['user_name']?></h3>
</div>


  </div>
    <script>
        $(document).ready(function(){
    
            $('.dropdown-toggle').prop('disabled', true);

        })
        
    </script>