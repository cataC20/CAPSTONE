<?php
class Prevencion extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Area de Prevencion de Riesgos'; 
        $this->views->getView('servicios', 'prevencion', $data);
    }
}