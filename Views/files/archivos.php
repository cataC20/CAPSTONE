<?php include_once 'Views/templates/header.php'; ?>

<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/css/menu.css'; ?>" />
<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h1 class="h2"><?php echo $data['title']; ?></h1>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row">
        <!-- Menú de Contenido -->
        <?php include_once 'Views/templates/menu.php'; ?>
        <!-- Lista de Archivos -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Archivos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Carpeta</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['archivos'] as $archivo) { ?>
                                    <tr>
                                        <td><?php echo $archivo['nombre']; ?></td>
                                        <td><?php echo $archivo['tipo']; ?></td>
                                        <td><?php echo $archivo['id_carpeta']; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($archivo['fecha_create'])); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" onclick="descargarArchivo(<?php echo $archivo['id']; ?>)">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" onclick="editarArchivo(<?php echo $archivo['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="eliminarArchivo(<?php echo $archivo['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary Compartir" id="<?php echo $archivo['id']; ?>">
                                                <i class="fa-solid fa-share-from-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include_once 'Views/templates/footer.php'; ?>