<?php
class Calidad extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Area de Calidad'; 
        $this->views->getView('servicios', 'calidad', $data);
    }
}