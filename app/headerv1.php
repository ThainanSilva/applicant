<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/app/initializer.php';

if ($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])) {
    ?> 
    
    <head>
    <link rel="stylesheet" type="text/css" href="https://huggingface.co/front/build/style.c01be9164.css">


<!-- Option 1: Include in HTML -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/../favicon-16x16.png">
    <link rel="manifest" href="/../site.webmanifest">
    <link rel="mask-icon" href="/../safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
    <title>Nextec - Aldeia</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->


    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="../js/jquery.maskedinput.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/locale/bootstrap-table.min.js"></script>

    <script src="../bootstrap\js\bootstrap.min.js"></script>
    <script src="js/notifications.js"></script>
    <script src="js/app.js"></script>
    <script src="../js/bootstrap-confirmation.min.js"></script>

    <!-- put your locale files after bootstrap-table.js -->

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- materializer -->
    <script type="text/javascript" src='js/webcam.js'>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha256-yNbKY1y6h2rbVcQtf0b8lq4a+xpktyFc3pSYoGAY1qQ=" crossorigin="anonymous"></script>

    <!-- materializer -->

    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
 
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
 
</head>

<body>

    <nav class="border-b border-gray-100">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="" class="navbar-brand" href="#"><img style="" class="navbar-brand" src="../images/lOGO NEXTEC.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i> <?php echo $_SESSION['company_identifier'] ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="chooseCompany.php"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>{{Change Company}}</a></li>
                            <?php if ($priv->GetUsersInfo('config', $userProfile) > 0) { ?> <?php } ?>
                            <?php if ($priv->GetUsersInfo('config', $userProfile) > 0) { ?><li role="separator" class="divider"></li>
                                <li><a id="companyConfigs" href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações</a></li> <?php } ?>
                        </ul>
                    </li>

                    <li class="active"><a id="dashboard" href="#"><i class="icon ion-speedometer" aria-hidden="true"></i> Painel <span class="sr-only">(current)</span></a></li>
                    <?php if ($priv->GetUsersInfo('job_opening', $userProfile) > 0) { ?> <li><a id="jobOpenning" href="#"><i class="glyphicon glyphicon-leaf" ></i> Vagas</a></li><?php } ?>
                    
                    <?php if ($priv->GetUsersInfo('visitors', $userProfile) > 0) { ?>


                        <li class="dropdown">
                            <a href="#" id="visitors" href="#"><i class="icon ion-person-stalker"></i> Visitantes</a>

                            <ul class="dropdown-menu">

                                <li><a id="visitorsType" href="#"><i class="fa fa-user" aria-hidden="true"></i> Tipos de visitantes</a></li>

                            </ul>

                        </li>




                    <?php } ?>

                    <?php if ($priv->GetUsersInfo('devices', $userProfile) > 0) { ?> <li><a id="devices" href="#"><i class="ion-outlet" aria-hidden="true"></i> Dispositivos</a></li><?php } ?>
                    <?php if ($priv->GetUsersInfo('schedules', $userProfile) > 0) { ?> <li><a id="schedules  " href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> Horarios</a></li><?php } ?>
                    <?php if ($priv->GetUsersInfo('reports', $userProfile) > 0) { ?>
                        <li class="dropdown">
                            <a href="#" href="#"><i class="ion-stats-bars" aria-hidden="true"></i> Relatorios</a>

                            <ul class="dropdown-menu">

                                <li><a id="access" href="#"> Acessos por periodo</a></li>
                                <li><a href="#"> Visitantes Ativos</a></li>
                                <li><a href="#"> Tipos de Visitantes</a></li>
                                <li><a href="#"> Usuários</a></li>
                            </ul>

                        </li>


                    <?php } ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['user_name'] ?> <span class="caret"></span></a>
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

        <div class="window-spacer">
            <h3>Bem vindo <?php echo $_SESSION['user_name']; ?></h3>

        </div>


    </div>
    <script>
        $(document).ready(function() {

            $('.dropdown-toggle').prop('disabled', true);

        })
    </script>
    
    <?php

} else {
    
}
?>

