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
                                <?php if (isset($data['archivos']) && is_array($data['archivos'])) { ?>
                                    <?php foreach ($data['archivos'] as $archivo) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($archivo['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($archivo['tipo']); ?></td>
                                            <td><?php echo htmlspecialchars($archivo['id_carpeta']); ?></td>
                                            <td><?php echo !empty($archivo['fecha_create']) ? date('d/m/Y H:i', strtotime($archivo['fecha_create'])) : 'Sin fecha'; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editarArchivo(<?php echo $archivo['id']; ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminarArchivo(<?php echo $archivo['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5">No hay archivos para mostrar.</td>
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