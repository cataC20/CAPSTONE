<?php
class ITS extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Area TI / ITS'; 
        $this->views->getView('servicios', 'its', $data);
    }
}