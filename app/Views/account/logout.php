<h1>Página de logout</h1>
<?php
$login = new ModelLogin();
if(isset($login)) {
    if($login->errors) {
        foreach ($login->errors as $error) {
            echo "Error: " . $error;
        }
    }
    if($login->messages) {
        foreach ($login->messages as $message) {
            echo "Mensaje: " . $message;
        }
    }
}
$login->doLogout();
echo HTML::br(2);
echo "Serás redireccionado en 2 segundos";
ROUTER::redirect_to_action("demo/index",2);
?>