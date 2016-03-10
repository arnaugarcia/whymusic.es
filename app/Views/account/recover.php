<?php
$login = new ModelLogin();
if(isset($login)) {
    if($login->errors) {
        foreach ($login->errors as $error) {
            echo HTML::open_div(array("class" => "form-group has-error"));
            echo HTML::label("usuario_nombre_usuario",$error, array("class" => "control-label"));
            echo HTML::close_div();
        }
    }
    if($login->messages) {
        foreach ($login->messages as $message) {
            echo HTML::open_div(array("class" => "form-group has-success", "style" => "text-align: center"));
            echo HTML::label("inputSuccess1", $message, array("class" => "control-label"));
            echo HTML::close_div();
        }
    }
}
if ($login->passwordResetLinkIsValid() == true) { ?>

<form method="post" action="<?php echo ROUTER::create_action_url('account/recover') ?>" name="new_password_form">
    <input type='hidden' name='usuario_nombre_usuario' value='<?php echo htmlspecialchars($_GET['usuario_nombre_usuario']); ?>' />
    <input type='hidden' name='usuario_contrasena_reset_hash' value='<?php echo htmlspecialchars($_GET['verification_code']); ?>' />

    <label for="usuario_contrasena_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="usuario_contrasena_new" type="password" name="usuario_contrasena_new" pattern=".{6,}" required autocomplete="off" />

    <label for="usuario_contrasena_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="usuario_contrasena_repeat" type="password" name="usuario_contrasena_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" />
</form>
<!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
<?php } else { ?>
<form method="POST" action="<?php echo ROUTER::create_action_url('account/recover') ?>" name="password_reset_form">
    <label for="usuario_nombre_usuario"><?php echo WORDING_REQUEST_PASSWORD_RESET; ?></label>
    <input id="usuario_nombre_usuario" type="text" name="usuario_nombre_usuario" required />
    <input type="submit" name="request_password_reset" value="<?php echo WORDING_RESET_PASSWORD; ?>" />
</form>
<?php } ?>