<?php
class ROUTER{
    static function show_view($view, $model=null){
        if (is_array($model)){
            extract($model);
        }
        $route = explode("/", $_GET["ruta"]);
        $controller = $route[0];
        $controller = ucfirst($controller)."Controller";
        $obj = new $controller;
        $layout = $obj->layout;
        $content = "../app/Views/$view.php";
        echo "Vista: $view <br>";
        echo "Layout: $layout";
        if (!file_exists("../app/Views/$layout.php")) {
           echo "La vista $layout no existe.";
        }else{
            include "../app/Views/$layout.php";
        }
    }
    static function create_action_url($r, $parameters=null){
        $p = null;
        if (is_array($parameters)){
            foreach($parameters as $param => $value){
                $p .= "&$param=$value";
            }
        }

        return URL::base_url()."index.php?ruta=".$r."".$p."";
    }
    static function redirect_to_action($r, $time=0, $parameters=null){
        $p = null;
        if (is_array($parameters)){
            foreach($parameters as $param => $value){
                $p .= "&$param=$value";
            }
        }
        echo "<meta http-equiv='Refresh' content='$time; url=index.php?ruta=". $r."".$p."'/>";
        //header("location: index.php?ruta=".$r."".$p."");
    }
    static function load_view($v){
        include "../app/Views/$v.php";
    }
}

