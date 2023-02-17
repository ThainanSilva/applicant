<?php
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');

?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AcessoCloud - Nextec</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->


   <script src="../js/jquery-3.1.0.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="style/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="../safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

   <script src="js/app.js"></script>
</head>
  <div id='UniversalNotification' style="display:none;">

    <h4 id="UNheader" > </h4>
    <p  id="UNmessage" > </p>
  </div>
<div class="header-black">
<a href="#" ><img  class="cflogo" src="../images/5fcloudlogosmall.png"></a>
<div id="profile-Options">
<a href="logOut.php">Sair</a>
</div>
</div>

  <div id="chooser-window" class="window">

    <div class="window-spacer">
      <h3>Escolha uma empresa para continuar</h3>
      <table class="table table-hover">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Empresa</th>
      <th>Perfil</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $result = $user->viewCompanysByUser($_SESSION['user_id']);
    foreach($result as $row){
        echo '<tr class="company-chooser-click" value="'.$row['id'].'" ><a href="#">';

        echo "<th scope='row'>".$row['id']."</th>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['perfil']."</td>";
        echo "<td> </td>";
        echo '</a></tr>';

    }

    ?>
  </tbody>
</table>
</div>


  </div>

<div id="footer">
    Copyright © 2016 Nextec. Todos os direitos Reservados.
</div>
