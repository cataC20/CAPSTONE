<?php
date_default_timezone_set('America/Argentina/Mendoza');
require_once 'Config/Config.php';
require_once 'Config/Function.php';
$ruta = !empty($_GET['url']) ? $_GET['url'] : "home/index";

$array = explode("/", $ruta);
$controller = ucfirst($array[0]);
$metodo = "index";
$parametro = "";
if (!empty($array[1])) {
    if ($array[1] != "") {
        $metodo = $array[1];
    }
}
if (!empty($array[2])) {
    if ($array[2] != "") {
        for ($i = 2; $i < count($array); $i++) {
            $parametro .= $array[$i] . ",";
        }
        $parametro = trim($parametro, ",");
    }
}
require_once 'Config/App/Autoload.php';
$dirControllers = "Controllers/" . $controller . ".php";
if (file_exists($dirControllers)) {
    require_once $dirControllers;
    $controller = new $controller();
    if (method_exists($controller, $metodo)) {
        $controller->$metodo($parametro);
    } else {
        echo 'No existe el metodo';
    }
} else {
    echo 'No existe el controlador';
}
spl_autoload_register(function ($class) {
    $path = "Models/" . $class . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});
?>