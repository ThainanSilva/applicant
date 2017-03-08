<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AcessoCloud - 5FCloud</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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


 <script src="js/jquery-3.1.0.min.js"></script>
 <script src="js/login.js"></script>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
</head>
  <div id='UniversalNotification' style="display:none;">
    <i id="UNicon" class="UNicon"></i>
    <h4 id="UNheader" >Sem Internet!</h4>
    <p  id="UNmessage" >Verificar.</p>
    <span  class="close-btn" >Fechar</span>
  </div>
<div class="header-black">
<a href="#" ><img  class="cflogo" src="images/5fcloudlogosmall.png" / ></a>


</div>
<div class="float-left">
    <img src="images/acessoCloud.png" / >
</div>

<div id="loginform">
<form>
  <div id="login_fgroup" class="form-group">
    <label id="login-name-pro" for="exampleInputEmail1">Email </label>
    <input type="login" title="Exemplo@5fcloud.com" data-toggle="tooltipemailincorrect"  class="form-control" id="login" placeholder="Email">

  </div>
  <div id="password_fgroup" class="form-group">
    <label id="password-name-pro" for="exampleInputPassword1">Senha</label>
    <input type="password" class="form-control" id="password" placeholder="Senha">
  </div>

  <div class="checkbox">
    <label>
      <input type="checkbox"> Continuar conectado
    </label>
  </div>
    </form>
  <button style="display:inline;" type="submit" id="login_execute" class="btn btn-default loginbtn">Entrar</button>
</div>

<div id="footer">
    Copyright © 2016 5F Cloud. Todos os direitos Reservados.
</div>
