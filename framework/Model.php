<?php
require "Model/ModelRouter.php";
require "Model/ModelHtml.php";
require "../app/Config/Config.php";
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
