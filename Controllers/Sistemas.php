<?php
class Sistemas extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Sistemas y TI';
        $this->views->getView('servicios', 'sistemas', $data);
    }
}