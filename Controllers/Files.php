<?php
class Files extends Controller
{
    private $usuario_id;

    public function __construct()
    {
        parent::__construct();
        session_start();
        if (isset($_SESSION['id'])) {         //modificar la verificacion de id de la sesion
            $this->usuario_id = $_SESSION['id'];
        } else {

            header("Location: index.php");
            exit;
        }
    }


    public function index()
    {
        $data['title'] = 'Administración de Archivos';
        $data['script'] = 'files.js';
        $data['active'] = 'recent';
        $carpetas = $this->model->getCarpetas($this->usuario_id);
        $data['archivos'] = $this->model->getArchivosRecientes($this->usuario_id);
        for ($i = 0; $i < count($carpetas); $i++) {
            $carpetas[$i]['color'] = substr(md5($carpetas[$i]['id']), 0, 6);
            $carpetas[$i]['fecha'] = time_ago(strtotime($carpetas[$i]['fecha_create']));
        }
        $data['carpetas'] = $carpetas;
        $this->views->getView('files', 'files', $data);
    }

    public function crearcarpeta()
    {
        $nombre = $_POST['nombre'];
        if (empty($nombre)) {
            $res = array('tipo' => 'warning', 'mensaje' => 'El nombre es obligatorio');
        } else {
            // Comprobar Nombre
            $verificarNom = $this->model->getVerificar('nombre', $nombre, 0, 0);
            if (empty($verificarNom)) {
                $data = $this->model->crearcarpeta($nombre, $this->usuario_id);
                if ($data > 0) {
                    $res = array('tipo' => 'success', 'mensaje' => 'Carpeta creada con éxito');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'Error al crear carpeta');
                }
            } else {
                $res = array('tipo' => 'warning', 'mensaje' => 'la carpeta ya existe');
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function subirarchivo()
    {

        $id_carpeta = (empty($_POST['id_carpeta'])) ? 1 : $_POST['id_carpeta'];
        $archivo = $_FILES['archivo'];
        $name = $archivo['name'];
        $tmp = $archivo['tmp_name'];
        $tipo = $archivo['type'];
        $data = $this->model->subirarchivo($name, $tipo, $id_carpeta);
        if ($data > 0) {
            $destino = 'Assets/archivos';
            if (!file_exists($destino)) {
                mkdir($destino);
            }
            $carpetas = $destino . '/' . $id_carpeta;
            if (!file_exists($carpetas)) {
                mkdir($carpetas);
            }
            move_uploaded_file($tmp, $carpetas . '/' . $name);
            $res = array('tipo' => 'success', 'mensaje' => 'Archivo subido con éxito');
        } else {
            if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] != UPLOAD_ERR_OK) {
                $res = ['tipo' => 'error', 'mensaje' => 'Error al subir archivo'];
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {  
            $res = ['tipo' => 'error', 'mensaje' => 'Método no permitido'];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            exit;
        }


        $data = $this->model->eliminar($id);
        if ($data) {
            $res = ['tipo' => 'success', 'mensaje' => 'Archivo eliminado con éxito'];
        } else {
            $res = ['tipo' => 'error', 'mensaje' => 'Error al eliminar'];
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function editar($id)
    {
        $data = $this->model->getFile($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function ver($id_carpeta)
    {
        $data['title'] = 'Listado de archivos';
        $data['script'] = 'files.js';
        $data['archivos'] = $this->model->getArchivos($id_carpeta, $this->usuario_id);
        $this->views->getView('files', 'archivos', $data);
    }

    // Formato de fecha 
   
}
