<!DOCTYPE html>
<html>
<head>
    <title><?php echo $data['title']; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo BASE_URL . 'Assets/css/index.css'; ?>">
    <link href="<?php echo BASE_URL . 'Assets/css/fonts.googleapis.css'; ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'Assets/css/bootstrap.min.css'; ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL . 'Assets/img/favicon.ico'; ?>">
    
    <!-- Scripts -->
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
</head>

<body>
    <img class="wave" src="<?php echo BASE_URL; ?>Assets/img/wav3.png">
    <div class="container">
        <div class="img">
        </div>
        <div class="login-content">
            <form id="formulario" method="POST" autocomplete="off">
                <img src="<?php echo BASE_URL; ?>Assets/img/perfil1.jpg">
                <h2 class="title">Bienvenido!</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username<span class="text-danger"></span></h5>
                        <input id="username" name="username" type="text" autocomplete="additional-name" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password<span class="text-danger"></span></h5>
                        <input id="password" name="password" type="password" autocomplete="current-password" class="input" required>
                    </div>
                </div>
                
                <div class="auth-submit">
                    <button type="submit" id="btn" name="btn" class="btn">Acceso</button>
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->

    
    <script src="<?php echo BASE_URL . 'Assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/sweetalert2@11.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/pages/login.js'; ?>"></script>
    <script src="<?php echo BASE_URL . 'Assets/js/custom.js'; ?>"></script>

    
</body>
</html>