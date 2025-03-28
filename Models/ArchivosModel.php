<?php
class ArchivosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // ARCHIVOS
    public function getArchivos($id_carpeta, $usuario_id){
        $sql = "SELECT a.* FROM archivos a INNER JOIN carpetas c ON a.id_carpeta = c.id WHERE  c.usuario_id  = $usuario_id  ORDER BY a.id DESC";
        return $this->selectAll($sql);
    }
 
    public function getCarpetas($usuario_id)
    {
        $sql = "SELECT * FROM carpetas WHERE usuario_id = $usuario_id AND estado = 1 ORDER BY id DESC ";
        return $this->selectAll($sql);
    }
    
}
