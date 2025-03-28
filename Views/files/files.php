<?php include_once 'Views/templates/header.php'; ?>

<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h1 class="h2"><?php echo $data['title']; ?></h1>
                <div class="d-flex align-items-center">
                    <span class="user-info me-3"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuario'; ?><span class="user-state"></span></span>
                    <button class="btn btn-primary" type="button" id="btnNuevo">
                        <i class="fas fa-plus"></i> Nuevo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row">
        <!-- Lista de Carpetas -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Carpetas</h5>
                </div>
                <?php foreach ($data['carpetas'] as $carpeta) { ?>
                    <div class="card-body">
                        <div class="file-manager">
                            <i class="fa-solid fa-folder" style="color: #<?php echo $carpeta['color']; ?>;"></i>
                            <a href="#" data-id="<?php echo $carpeta['id']; ?>" class="carpetas"><?php echo $carpeta['nombre']; ?></a>
                            <span class="carpeta-about"><?php echo $carpeta['fecha_create']; ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Lista de Archivos -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Archivos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tblUsuarios">
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

    <!-- Modal de Opciones -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Nuevo Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2">
                        <button type="button" id="btnNuevaCarpeta" class="btn btn-outline-primary">
                            <i class="fas fa-folder-plus"></i> Nueva Carpeta
                        </button>

                        <button type="button" id="btnNuevoArchivo" class="btn btn-outline-success">
                            <i class="fas fa-file-upload"></i> Nuevo Archivo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Nueva Carpeta -->
    <div class="modal fade" id="modalCarpeta" tabindex="-1" role="dialog" aria-labelledby="modalCarpetaLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCarpetaLabel">
                        <i class="fas fa-folder"></i> Nueva Carpeta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="frmCarpeta" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-label">Nombre de la Carpeta</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-folder-open"></i>
                                </span>
                                <input type="text"
                                    class="form-control"
                                    name="nombre"
                                    minlength="3"
                                    maxlength="50"
                                    id="nombre">

                            </div>
                            <div class="form-text">El nombre debe tener entre 3 y 50 caracteres</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Carpeta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCompartir" tabindex="-1" role="dialog" aria-labelledby="modalCarpetaLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-compartir">
                        <i class="fas fa-folder"></i> Nueva Carpeta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_carpeta">
                    <div class="form-label">
                        <a href="#" id="btnVer" class="btn btn-outline-info"> <i class="fa-solid fa-eye"></i> Ver archivos</a>
                        <hr>
                        <button type="button" id="btnSubir" class="btn btn-outline-primary"> <i class="fas fa-file-upload"></i> Subir archivo</button>
                        <hr>
                        <button type="button" id="btnCompartir" class="btn btn-outline-success"><i class="fa-solid fa-share-nodes"></i>Compartir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Nuevo Archivo -->
    <div class="modal fade" id="modalArchivo" tabindex="-1" aria-labelledby="modalArchivoLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArchivoLabel">
                        <i class="fas fa-file"></i> Nuevo Archivo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="frmArchivo" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombreArchivo" class="form-label">Nombre del Archivo</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                <input type="text"
                                    class="form-control"
                                    id="nombreArchivo"
                                    name="nombre"
                                    required
                                    minlength="3"
                                    maxlength="100">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tipoArchivo" class="form-label">Tipo de Archivo</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-file-code"></i>
                                </span>
                                <select class="form-select" id="tipoArchivo" name="tipo" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="documento">Documento</option>
                                    <option value="imagen">Imagen</option>
                                    <option value="pdf">PDF</option>
                                    <option value="hoja_calculo">Hoja de Cálculo</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Seleccionar Archivo</label>
                            <input type="file"
                                class="form-control"
                                id="archivo"
                                name="archivo"
                                required
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                            <div class="form-text">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG</div>
                        </div>
                        <input type="hidden" name="id_carpeta" id="id_carpeta">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCarpetaLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-usuarios">
                        <i class="fas fa-folder"></i> Nueva Carpeta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_archivo">
                    <select class="js-states from-control" tabindex="-1" style="display: flex;">
                        <optgroup label="">
                            <option value=""></option>
                        </optgroup>
                        <optgroup></optgroup>

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'Views/templates/footer.php'; ?>