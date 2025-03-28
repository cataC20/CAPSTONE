<?php
class Admin extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Panel de control';
        $this->views->getView('admin', 'home', $data);
    }
}