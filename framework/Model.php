<?php
require "Model/ModelRouter.php";
require "Model/ModelUrl.php";
require "Model/ModelHtml.php";
require "Model/ModelLogin.php";
require 'Model/ModelRegistration.php';
require "../app/Config/Config.php";
require '../app/translations/ca.php';
require '../app/libraries/PHPMailer.php';
/* IF encargado del idioma
if(IDIOMA::getUserLanguage()=="es" || IDIOMA::getUserLanguage()=="ca" || IDIOMA::getUserLanguage()=="en"){
    require "../app/langs/".IDIOMA::getUserLanguage().".php";
}else{
    require "../app/langs/es.php";
}*/

/* Método para los errores */
$config = new Config();
$login = new ModelLogin();
if ($login->isUserLoggedIn() == true) {
            echo "Login status: Loggeado <br>";
        }else{
            echo "Loggin status: No Logged <br>";
    }
if ($config->debug){
    require "Model/ModelError.php";
}else{
    error_reporting("E_ALL");
}
if (isset($_GET["ruta"])){
    $route = $_GET["ruta"];
    $route = explode("/", $route);
    $controller = $route[0];
    $action = $route[1];
    $class_controller = ucfirst($controller)."Controller";
    echo "Contrloador: " . $class_controller . "<br>";
    if (!file_exists("../app/Controllers/$class_controller.php")) {
       echo "El Contrloador $class_controller, no existe";
    }else{
        require "../app/Controllers/$class_controller.php";
        echo "Accion: " . $action . "<br>";
        if (!class_exists($action)) {
            $obj = new $class_controller;
            call_user_func(array($obj, $action));
        }else{
            echo "Error, la clase del controlador no existe";
        }
    }
}
