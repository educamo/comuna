<?Php
   $bg_color = '#aaaaaa';
   $favicon = 'favicon.png';
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comuna - Registro Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/' . $favicon) ?>" />
</head>
<body style="background-color: <?= $bg_color ?>;">
<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <?php if ($this->session->flashdata('status')) : ?>
          <div class="alert alert-success">
            <?= $this->session->flashdata('status'); ?>
          </div>
        <?php endif; ?>
        <div class="card shadow">
          <div class="card-header">
            <h5>Registro de Usuario</h5>
          </div>
          <div class="card-body">
            <?= form_open('login/register'); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nombre</label>
                    <?= form_input(['name' => 'first_name', 'value' => set_value('first_name'), 'class' => 'form-control']); ?>
                    <small><?= form_error('first_name'); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Apellido</label>
                    <?= form_input(['name' => 'last_name', 'value' => set_value('last_name'), 'class' => 'form-control']); ?>
                    <small><?= form_error('last_name'); ?></small>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Correo electrónico</label>
                    <?= form_input(['name' => 'email', 'value' => set_value('email'), 'class' => 'form-control']); ?>
                    <small><?= form_error('email'); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Contraseña</label>
                    <?= form_password(['name' => 'password', 'class' => 'form-control']); ?>
                    <small><?= form_error('password'); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Confirmar contraseña</label>
                    <?= form_password(['name' => 'cpassword', 'class' => 'form-control']); ?>
                    <small><?= form_error('cpassword'); ?></small>
                  </div>
                </div>
                <div class="col-md-12">
                  <?= form_submit(['value' => 'Registrarse', 'class' => 'btn btn-primary px-5']); ?>
                  <button type="button" class="btn btn-secondary" name="btn_cancel" value="Cancel" onclick="window.location.href = '<?= base_url() ?>';">Cancelar</button>
                </div>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>