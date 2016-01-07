<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $app->appName ?> · Login</title>
        <meta name="description" content="<?php echo $meta["description"] ?>">
        <meta name="keywords" content="<?php echo $meta["keywords"] ?>">
        <meta name="robots" content="<?php echo $meta["robots"] ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base_url()."/bootstrap/css/reset.css" ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base_url()."/bootstrap/css/bootstrap.min.css" ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base_url()."/bootstrap/css/estilos.css" ?>">
        <link href="<?php echo URL::base_url()."/bootstrap/admin/sb-admin.css" ?>" rel="stylesheet">
        <link href="<?php echo URL::base_url()."/bootstrap/admin/plugins/morris.css" ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo URL::base_url()."/bootstrap/js/jquery.js" ?>"></script>
        <script type="text/javascript" src="<?php echo URL::base_url()."/bootstrap/js/bootstrap.min.js" ?>"></script>
        <script src="<?php echo URL::base_url()."/bootstrap/js/jquery.backgroundvideo.min.js" ?>"></script>
        <script>
        $(document).ready(function() {
          var videobackground = new $.backgroundVideo($('body'), {
            "align": "centerXY",
            "width": 1366,
            "height": 768,
            "path": "<?php echo URL::base_url().'/bootstrap/media/' ?>",
            "filename": "PinkFloyd",
            "types": ["mp4"]
          });
        });
        </script>
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ROUTER::create_action_url('demo/index');?>"><?php echo $app->appName ?></a>
        </div>
        <?php
        if(!empty($_SESSION['user_name'])){
            include 'perfil.php';
            } ?>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($_GET["r"] == "demo/index"){ echo 'class="active"'; } ?>><a href="<?php echo ROUTER::create_action_url("demo/index") ?>"><?php echo INICIO ?></a></li>
            <li <?php if ($_GET["r"] == "login/login"){ echo 'class="active"'; } ?>><a href="<?php echo ROUTER::create_action_url("login/login") ?>"><?php echo LOGIN_ENTRAR ?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
        <?php include_once $content; ?>
    </div>
    </body>
</html>