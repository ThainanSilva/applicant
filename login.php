<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Applicant - Nextec</title>
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
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
</head>
  <div id='UniversalNotification' style="display:none;">
    <i id="UNicon" class="UNicon"></i>
    <h4 id="UNheader" >Sem Internet!</h4>
    <p  id="UNmessage" >Verificar.</p>
    <span  class="close-btn" >Fechar</span>
  </div>
<div class="header-black">
<a href="http://Nextecbrasil.com.br/" ><img class="cflogo" src="images/logowhiteNextec.fw.png" style="
    margin-top: 0.15%;
    height: 91%;
"> </a>


</div>
<div class="float-left">
    <img src="images/acessoCloud.png" />
</div>

<div id="loginform">
<form>
  <div id="login_fgroup" class="form-group">
    <label id="login-name-pro" for="exampleInputEmail1">Email </label>
    <input type="login" title="Exemplo@Nextecbrasil.com.br" data-toggle="tooltipemailincorrect"  class="form-control" id="login" placeholder="Email">

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
    Copyright © 2016 - 2017 Nextec Solutions. Todos os direitos Reservados. v0.11 - loki.
</div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha256-yNbKY1y6h2rbVcQtf0b8lq4a+xpktyFc3pSYoGAY1qQ=" crossorigin="anonymous"></script>
    <script>
        toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"}
        </script>