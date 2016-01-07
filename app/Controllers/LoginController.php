<?php
class LoginController extends Controllers
{
    public $layout = "layouts/layoutlogin";
    public function login(){
		$meta = array(
		'title' => 'WhyMusic · Log-In',
		'description' => 'Login de whymusic.es',
		'keywords' => '',
		'robots' => 'NOINDEX,NOFOLLOW',
		);
        return ROUTER::show_view('login/login', array("meta" => $meta));
    }
    public function register(){
        $meta = array(
        'title' => 'WhyMusic · Registro',
        'description' => 'Login de whymusic.es',
        'keywords' => 'Registro, WhyMuisc',
        'robots' => 'NOINDEX,NOFOLLOW',
        );
        return ROUTER::show_view('login/register', array("meta" => $meta));
    }
}

