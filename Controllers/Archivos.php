<?php
class Archivos extends Controller
{
    private $usuario_id;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->usuario_id = $_SESSION['id'];
        
    }
    public function index()
    {
        $data['title'] = 'Archivos';
        $data['active'] = 'todos';
        $data['archivos'] = $this->model->getArchivos($this->usuario_id);
        $carpetas = $this->model->getCarpetas($this->usuario_id);
        for ($i = 0; $i < count($carpetas); $i++) {
            $carpetas[$i]['color'] = substr(md5($carpetas[$i]['id']), 0, 6);
            $carpetas[$i]['fecha'] = time_ago(strtotime($carpetas[$i]['fecha_create']));
        }
        $data['carpetas'] = $carpetas;
        $this->views->getView('files', 'index', $data);
    }
}
