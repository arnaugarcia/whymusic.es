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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <?php
        $login = new ModelLogin();
        if ($_GET["ruta"]=="account/admin" || $_GET["ruta"]=="account/edit" || $_GET["ruta"]=="admin/edit"): ?>
        <style>
        #myMap {
            height: 350px;
            width: 680px;
        }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <?php endif ?>
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
                <a class="navbar-brand" href="<?php echo ROUTER::create_action_url('demo/index')?>">WhyMusic</a>
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
                    <li  <?php if ($_GET["ruta"] == RUTA_EVENTOS){ echo 'class="active"'; } ?>>
                        <a href="<?php echo ROUTER::create_action_url(RUTA_EVENTOS); ?>"><?php echo MENU_EVENTOS;?></a>
                    </li>
                </ul>
                <ul class="nav navbar-right top-nav">
                    <?php 
                    $notifications = new Notifications();
                    $login = new ModelLogin();
                     ?> 
                    <?php if ($login->isUserLoggedIn()): ?>
                        <li class="dropdown">
                        <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="label"></span>
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <span class="small-screen-text">Notificaciones</span>
                        </a>
                        <ul class="dropdown-menu" style="width: 400px;">
                        <?php foreach ($notifications->checkNotification($login->getUserId()) as $row): ?>
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/user')?>"><i class="fa fa-fw fa-user"></i><?php echo $row['notificacion_titulo'] ?> 
                            <div class=""><?php echo $row['notificacion_contenido']; ?></div>
                            <div class=""><i><?php echo $row['notificacion_fecha']; ?></i></div></a>
                        </li>
                    <?php endforeach ?>
                        </ul>
                    </li>
                    <?php endif ?>
                <ul class="nav navbar-right top-nav">
                <?php $login=new ModelLogin(); if($login->isUserLoggedIn() == true): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario_nombre_usuario'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/user')?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensajes</a>
                        </li>
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/edit')?>"><i class="fa fa-fw fa-gear"></i><?php echo WORDING_EDIT_USER_DATA; ?></a>
                        </li>
                        <?php if ($login->getTypeOfUser()=="administrador") {
                            echo "<li>";
                            echo HTML::a(ROUTER::create_action_url('admin/admin'),"Panel de administrador");
                            echo "</li>";
                        } ?>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo ROUTER::create_action_url('account/logout&logout')?>"><i class="fa fa-fw fa-power-off"></i><?php echo WORDING_LOGOUT; ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif ?>
                <?php $login=new ModelLogin(); if($login->isUserLoggedIn() == false): ?>
                <li class="dropdown">
                        <a href="<?php ROUTER::create_action_url('account/register') ?>" class="dropdown-toggle" data-toggle="dropdown">Registro <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated flipInX" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Registro</b></h3></div>
                                <?php
                                echo HTML::open_form( ROUTER::create_action_url('account/register'), "POST","registerform",array("autocomplete" => "off", "role" => "form"));
                                echo HTML::label("fan","Fan");
                                echo HTML::input("radio","usuario_tipo", "fan", array("checked" => "checked"));

                                echo HTML::label("musico","Musico");
                                echo HTML::input("radio","usuario_tipo", "musico");

                                echo HTML::label("local","Local");
                                echo HTML::input("radio","usuario_tipo", "local");

                                echo HTML::open_div(array("class" => "form-group"));
                                echo HTML::input("text","usuario_nombre_usuario", null, array("class" => "form-control", "placeholder" => "Nombre de usuario"));
                                echo HTML::close_div();

                                echo HTML::open_div(array("class" => "form-group"));
                                echo HTML::input("email","usuario_email", null, array("class" => "form-control", "placeholder" => "xxxxxx@dominio.com"));
                                echo HTML::close_div();

                                echo HTML::open_div(array("class" => "form-group"));
                                echo HTML::input("password","usuario_contrasena", null, array("class" => "form-control", "placeholder" => "········"));
                                echo HTML::close_div();

                                echo HTML::open_div(array("class" => "form-group"));
                                echo HTML::input("password","usuario_contrasena_repeat", null, array("class" => "form-control", "placeholder" => "········"));
                                echo HTML::close_div();

                                echo HTML::open_div(array("class" => "form-group"));
                                echo HTML::open_div(array("class" => "row"));
                                echo HTML::open_div(array("class" => "col-xs-6 col-xs-offset-3"));
                                echo HTML::button_HTML5("submit","Registrarme!","register",array("class" => "form-control btn btn-info"));
                                echo HTML::close_div();
                                echo HTML::close_div();
                                echo HTML::close_div();

                                echo HTML::close_form();
                                 ?>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Entrar <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Entrar</b></h3></div>
                                <form id="ajax-login-form" action="http://www.whymusic.es/public/index.php?ruta=account/login" method="POST" role="form" autocomplete="off">
                                    <div class="form-group">
                                        <label for="usuario_nombre_usuario">Nombre de usuario:</label>
                                        <input type="text" name="usuario_nombre_usuario" id="usuario_nombre_usuario" tabindex="1" class="form-control" placeholder="Nombre de usuario" value="" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label for="usuario_contrasena">Contraseña:</label>
                                        <input type="password" name="usuario_contrasena" id="usuario_contrasena" tabindex="2" class="form-control" placeholder="Contraseña" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="checkbox" tabindex="3" name="usuario_recuerdame" id="usuario_recuerdame">
                                                <label for="usuario_recuerdame"> Recordarme</label>
                                            </div>
                                            <div class="col-xs-5 pull-right">
                                                <input type="submit" name="login" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Entrar!">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                   <a href="<?php echo ROUTER::create_action_url("account/recover") ?>" tabindex="5" class="forgot-password">Contraseña olvidada?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <footer>
            <div class="row" style="text-align: center;">
                <div class="col-lg-12">
                    <p>Copyright &copy; WhyMusic 2016</p>
                </div>
            </div>
        </footer>
    </body>
    <script type="text/javascript">
        var map;
        var marker;
        var latitude;
        var longitude = document.getElementById("longitude").value;
        var latitude = document.getElementById("latitude").value;
        if (longitude=="" || latitude=="") {
            var myLatlng = new google.maps.LatLng(41.39591685804173,2.190355086180034);
        }else{
            var myLatlng = new google.maps.LatLng(latitude,longitude);
        }
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        function initialize(){
            var mapOptions = {
            zoom: 18,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });

        geocoder.geocode({'latLng': myLatlng }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                $('#latitude,#longitude').show();
                $('#address').val(results[0].formatted_address);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
        }
        });

        google.maps.event.addListener(marker, 'dragend', function() {

            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#address').val(results[0].formatted_address);
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</html>