<?php
class AccountController extends Config{
    public $layout = "layouts/indexlayout";
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
            'description' => 'Login de WhyMusic.es',
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
            'title' => 'WhyMusic · Logout',
            'description' => 'Logout de WhyMusic.es',
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
}

