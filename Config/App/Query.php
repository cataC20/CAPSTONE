<?php
class Query extends Conexion {
    protected $con;
    protected $sql;
    protected $datos;
    
    public function __construct() {
        parent::__construct();
        $this->con = $this->conect();
    }
    
    public function select(string $sql, array $params = [])
    {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($params);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log("Error en select: " . $e->getMessage());
            return null;
        }
    }
    
    public function selectAll(string $sql, array $params = [])
    {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            error_log("Error en selectAll: " . $e->getMessage());
            return null;
        }
    }
    
    public function save(string $sql, array $datos)
    {
        try {
            $stmt = $this->con->prepare($sql);
            $data = $stmt->execute($datos);
            return $data ? 1 : 0;
        } catch (PDOException $e) {
            error_log("Error en save: " . $e->getMessage());
            return 0;
        }
    }
    
    public function insertar(string $sql, array $datos)
    {
        try {
            $stmt = $this->con->prepare($sql);
            $data = $stmt->execute($datos);
            return $data ? $this->con->lastInsertId() : 0;
        } catch (PDOException $e) {
            error_log("Error en insertar: " . $e->getMessage());
            return 0;
        }
    }
}
?>