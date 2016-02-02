<h1>Panel de usuario</h1>
<?php
$login = new ModelLogin();
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo WORDING_YOU_ARE_LOGGED_IN_AS . htmlspecialchars($_SESSION['usuario_nombre_usuario']) . "<br />";
//echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
echo "Foto de perfil: " . '<br/>' . $login->user_gravatar_image_tag;
echo "Usuario id:=" . $_SESSION['usuario_id'];
echo HTML::br(2);
?>

<div>
    <a href="<?php echo ROUTER::create_action_url('account/logout&logout')?>"><?php echo WORDING_LOGOUT; ?></a>
    <a href="<?php echo ROUTER::create_action_url('account/edit')?>"><?php echo WORDING_EDIT_USER_DATA; ?></a>
</div>
?>