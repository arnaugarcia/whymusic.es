<?php
class AccountController extends Config{
    public $layout = "layouts/loginlayout";
    public function login(){
        $meta = array
            (
            'title' => 'WhyMusic · Login',
            'description' => 'Login de WhyMusic.es',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('account/login', array('meta' => $meta));
    }
}

