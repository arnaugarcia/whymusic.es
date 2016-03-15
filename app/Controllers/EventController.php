<?php
class EventController extends Config{
    public $layout = "layouts/indexlayout";
    public function index(){
        $meta = array
            (
            'title' => 'WhyMusic · Eventos - Index',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('event/index', array('meta' => $meta));
    }
    public function locales(){
        $meta = array
            (
            'title' => 'WhyMusic · Eventos - Index',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('event/local', array('meta' => $meta));
    }
}

