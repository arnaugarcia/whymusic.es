<?php

class AdminController
{
    public $layout = "layouts/adminlayout";
    public function admin()
    {
    	$meta = array
            (
            'title' => 'WhyMusic · Admin',
            'description' => 'Es la descripción del panel de administador',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
            $login = new ModelLogin();
        if ($login->isUserLoggedIn()==true && $login->getTypeOfUser()=="administrador") {
            return ROUTER::show_view("admin/admin", array('meta' => $meta));
        }else{
            echo "No tienes permisos para estar aquí, solamente administradores.";
            return ROUTER::show_view("account/login", array('meta' => $meta));
        }
    }
    public function edit()
    {
        $meta = array
            (
            'title' => 'WhyMusic · Admin',
            'description' => 'Es la descripción del panel de administador',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
            $login = new ModelLogin();
        if ($login->isUserLoggedIn()==true && $login->getTypeOfUser()=="administrador") {
            return ROUTER::show_view("admin/edit", array('meta' => $meta));
        }else{
            echo "No tienes permisos para estar aquí, solamente administradores";
            return ROUTER::show_view("account/login", array('meta' => $meta));
        }
    }
}

