<?php
class AccountController extends Config{
    public $layout = "layouts/accountlayout";
    public function login(){
        $meta = array(
            'title' => 'WhyMusic · Login',
            'description' => 'Login de WhyMusic.es',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
            return ROUTER::show_view('account/login', array('meta' => $meta));
    }
    public function register(){
        $meta = array(
            'title' => 'WhyMusic · Register',
            'description' => 'Regsitro de WhyMusic.es',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        $login = new ModelLogin();
        if ($login->isUserLoggedIn() == true) {
            AccountController::user();
        }else{
            return ROUTER::show_view('account/register', array('meta' => $meta));
        }
    }
    public function logout(){
        $meta = array(
            'title' => 'WhyMusic · Logout',
            'description' => 'Logout de WhyMusic.es',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        $login = new ModelLogin();
        if ($login->isUserLoggedIn() == true) {
            AccountController::login();
        }else{
            return ROUTER::show_view('account/logout', array('meta' => $meta));
        }
    }
        public function user(){
        $meta = array(
            'title' => 'WhyMusic · Panel de usuario',
            'description' => 'Panel de usuario de WhyMusic.es',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        $login = new ModelLogin();
        if ($login->isUserLoggedIn() == true) {
            return ROUTER::show_view('account/user', array('meta' => $meta));
        }else{
            return ROUTER::show_view('account/login', array('meta' => $meta));
        }
    }
    public function edit(){
        $meta = array(
            'title' => 'WhyMusic · Edición',
            'description' => 'Panel de edición de cuenta',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        $error = null;
        $login = new ModelLogin();
        if ($login->isUserLoggedIn() == true) {
            return ROUTER::show_view('account/edit', array('meta' => $meta, 'error' => $error));
        }else{
            return ROUTER::show_view('account/login', array('meta' => $meta));
        }
    }
    public function recover(){
        $meta = array(
            'title' => 'WhyMusic · Recuperación de la contraseña',
            'description' => 'Recuperación de la contraseña',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('account/recover', array('meta' => $meta));
    }
    public function delete()
    {
        $meta = array(
            'title' => 'WhyMusic · Eliminación de la cuenta',
            'description' => 'Eliminación de la cuenta',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        $login = new ModelLogin();
        if ($login->isUserLoggedIn() == true) {
            return ROUTER::show_view('account/delete', array('meta' => $meta));
        }else{
            return ROUTER::show_view('account/login', array('meta' => $meta));
        }
    }
}

