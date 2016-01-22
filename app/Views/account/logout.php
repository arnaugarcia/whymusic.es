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
?>