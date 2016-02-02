<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $meta["title"] ?></title>
        <meta name="description" content="<?php echo $meta["description"] ?>">
        <meta name="keywords" content="<?php echo $meta["keywords"] ?>">
        <meta name="robots" content="<?php echo $meta["robots"] ?>">
    </head>
    <body>
    <a href="<?php echo ROUTER::create_action_url('demo/index'); ?>"><?php echo MENU_HOME; ?></a>
    <a href="<?php echo ROUTER::create_action_url('account/login'); ?>"><?php echo MENU_LOGIN ?></a>
    <a href="<?php echo ROUTER::create_action_url('account/register'); ?>"><?php echo MENU_REGISTER ?></a>
    <a href="http://whymusic.es/FoSa/index.php">Projecte FoSa</a>
        <?php include $content; ?>
    </body>
</html>
