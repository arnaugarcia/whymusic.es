<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $meta["title"] ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $meta["description"] ?>">
        <meta name="keywords" content="<?php echo $meta["keywords"] ?>">
        <meta name="robots" content="<?php echo $meta["robots"] ?>">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">WhyMusic</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if ($_GET["ruta"] == RUTA_INDEX){ echo 'class="active"'; } ?>>
                        <a href="<?php echo ROUTER::create_action_url(RUTA_INDEX); ?>"><?php echo MENU_HOME;?></a>
                    </li>
                    <li <?php if ($_GET["ruta"] == RUTA_LOCALES){ echo 'class="active"'; } ?>>
                        <a href="<?php echo ROUTER::create_action_url(RUTA_LOCALES); ?>"><?php echo MENU_LOCALES;?></a>
                    </li>
                    <li  <?php if ($_GET["ruta"] == RUTA_MUSICOS){ echo 'class="active"'; } ?>>
                        <a href="<?php echo ROUTER::create_action_url(RUTA_MUSICOS); ?>"><?php echo MENU_MUSICOS;?></a>
                    </li>
                </ul>
                <ul class="nav navbar-right top-nav">
                <?php $login=new ModelLogin(); if($login->isUserLoggedIn() == true): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario_nombre_usuario'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensajes</a>
                        </li>
                        <?php if ($login->getTypeOfUser()=="administrador") {
                            echo "<li>";
                            echo HTML::a(ROUTER::create_action_url('admin/admin'),"Panel de administrador");
                            echo "</li>";
                        } ?>
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/edit')?>"><i class="fa fa-fw fa-gear"></i><?php echo WORDING_EDIT_USER_DATA; ?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/logout&logout')?>"><i class="fa fa-fw fa-power-off"></i><?php echo WORDING_LOGOUT; ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
            </div>
        </div>

    </nav>
    <div class="container" style="margin-top: 5%;">
        <?php include $content; ?>
    </div>
    </body>
</html>
