<?php

class AdminController
{
	public $layout = "layouts/indexlayout";
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
            return ROUTER::show_view("account/user");
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
            return ROUTER::show_view("account/user");
        }
    }
}

