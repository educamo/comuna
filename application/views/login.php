<?php
defined('BASEPATH') or exit('No direct script access allowed');
$bg_color = '#aaaaaa';
$favicon = 'favicon.png';
$imagen = 'imagen.jpg';
$logo = 'logo.png';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Comuna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/' . $favicon) ?>" />
</head>

<body style="background-color: <?= $bg_color ?>;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                        <img src="<?= base_url('assets/img/' . $logo) ?>" class="img-fluid img-thumbnail" alt="Logo" width="50" height="50"> <!-- Añade tu logo aquí -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?php echo form_open('login/loginchk'); ?>
                                <div class="form-group">
                                    <label for="txt_username">Correo electrónico</label>
                                    <input type="email" class="form-control" id="txt_username" name="txt_username" placeholder="Usuario" value="<?php echo set_value('txt_username'); ?>">
                                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="txt_password">Contraseña</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Contraseña" value="<?php echo set_value('txt_password'); ?>" aria-label="txt_password" aria-describedby="togglePassword">
                                        <div class="input-group-append">
                                            <i id="togglePassword" class="fa fa-eye input-group-text"></i>
                                        </div>
                                    </div>
                                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="btn_login" value="Login">Iniciar sesión</button>
                                    <button type="reset" class="btn btn-secondary" name="btn_cancel" value="Cancel">Cancelar</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/img/' . $imagen) ?>" alt="Imagen" class="img-fluid img-thumbnail" width="95%" height="75%"> <!-- Añade tu imagen aquí -->
                            </div>
                        </div>
                    </div>
                    <div class="login">
                        <?= $this->session->flashdata('msg') ?>
                        <div class="card-footer text-center">
                            <div class="row">
                                <!-- <div class="col-md-12"><a href="#" class="">¿Olvidaste tu contraseña?</a> </div>Añade tu enlace aquí -->
                                <div class="col-md-12"><a href="<?= base_url('login/registroUsuario') ?>" class="">¿No tienes cuenta? Regístrate</a></div><!-- Añade tu enlace aquí -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</body>

<script src="<?= base_url('assets/js/login.js') ?>"></script>

</html>