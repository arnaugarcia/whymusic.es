<?php
class AdminController extends Controllers{
	public $layout = "layouts/adminlayout";
    public function admin(){
    	$meta = array(
		'title' => 'WhyMusic · AdminPanel',
		'description' => 'Panel de Administrador de WhyMusic',
		'keywords' => '',
		'robots' => 'NOINDEX,NOFOLLOW',
		);
        return ROUTER::show_view('admin/admin', array("meta" => $meta));
    }
}

