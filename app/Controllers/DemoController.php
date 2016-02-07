<?php
class DemoController extends Config{
    public $layout = "layouts/indexlayout";
    public function index(){
        $meta = array
            (
            'title' => 'WhyMusic · Inicio',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('demo/index', array('meta' => $meta));
    }
}

