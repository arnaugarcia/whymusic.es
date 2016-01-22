<h1>Página de logout</h1>
<?php
$login = new ModelLogin();
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo WORDING_YOU_ARE_LOGGED_IN_AS . htmlspecialchars($_SESSION['user_name']) . "<br />";
//echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
echo "Foto de perfil: " . '<br/>' . $login->user_gravatar_image_tag;
?>

<div>
    <a href="<?php echo ROUTER::create_action_url('account/logout&logout')?>"><?php echo WORDING_LOGOUT; ?></a>
    <a href="edit.php"><?php echo WORDING_EDIT_USER_DATA; ?></a>
</div>
?>