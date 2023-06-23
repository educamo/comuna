<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Login - Comuna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                        <img src="logo.png" alt="Logo" width="100" height="100"> <!-- Añade tu logo aquí -->
                    </div>
                    <div class="card-body">
                        <?php echo form_open('login/loginchk'); ?>
                        <div class="form-group">
                            <label for="txt_username">Usuario</label>
                            <input type="text" class="form-control" id="txt_username" name="txt_username" placeholder="Usuario" value="<?php echo set_value('txt_username'); ?>">
                            <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Contraseña</label>
                            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña" value="<?php echo set_value('txt_password'); ?>">
                            <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btn_login" value="Login">Iniciar sesión</button>
                            <button type="reset" class="btn btn-secondary" name="btn_cancel" value="Cancel">Cancelar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="">¿Olvidaste tu contraseña?</a> <!-- Añade tu enlace aquí -->
                        <a href="#" class="">¿No tienes cuenta? Regístrate</a> <!-- Añade tu enlace aquí -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="imagen.jpg" alt="Imagen" width="500" height="500"> <!-- Añade tu imagen aquí -->
            </div>
        </div>

    </div>

</body>

</html>