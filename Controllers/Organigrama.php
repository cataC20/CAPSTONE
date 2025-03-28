<?php
class Organigrama extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() { //cambiar metodo
        $data['title'] = 'Organigrama de la empresa';
        $this->views->getView('organigrama', 'organigrama', $data);
    }
}