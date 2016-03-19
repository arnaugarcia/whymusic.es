<?php
class EventController extends Config{
    public $layout = "layouts/loginlayout";
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
    public function local(){
        $meta = array
            (
            'title' => 'WhyMusic · Eventos - Index',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('event/local', array('meta' => $meta));
    }
    public function band(){
        $meta = array
            (
            'title' => 'WhyMusic · Eventos - Index',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('event/band', array('meta' => $meta));
    }
    public function concert(){
        $meta = array
            (
            'title' => 'WhyMusic · Eventos - Index',
            'description' => 'Es la descripción de la página de inicio',
            'keywords' => 'php, framework, mvc',
            'robots' => 'All',
            );
        return ROUTER::show_view('event/concert', array('meta' => $meta));
    }
}

