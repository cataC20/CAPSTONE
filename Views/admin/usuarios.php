<?php include_once 'Views/templates/header.php'; ?>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'Assets/css/files.css' ?>" />
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
    <div class="row">
        <!-- Lista de Usuarios -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Usuarios</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover display nowrap" id="tblUsuarios">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Perfil</th>
                                    <th>F. registo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos se cargarán dinámicamente con JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear/editar usuarios -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUsuarioLabel">
                        <i class="fas fa-user"></i> Nuevo Usuario
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frmUsuarios" autocomplete="off">
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-list-ul"></i></span>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido">Apellido</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-list-ul"></i></span>
                                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Correo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user-plus"></i></span>
                                    <input type="email" class="form-control" name="username" id="username" placeholder="Correo" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono">Telefono</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-mobile"></i></span>
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rol">Rol de Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                    <select name="rol" id="rol" class="form-control" required>
                                        <option value="1">Administrador</option>
                                        <option value="2">Usuario</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include_once 'Views/templates/footer.php'; ?>