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
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($_GET["r"] == "demo/index"){ echo 'class="active"'; } ?>><a href="<?php echo ROUTER::create_action_url("demo/index") ?>"><?php echo INICIO ?></a></li>
            <li <?php if ($_GET["r"] == "login/login"){ echo 'class="active"'; } ?>><a href="<?php echo ROUTER::create_action_url("login/login") ?>"><?php echo LOGIN_ENTRAR ?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>