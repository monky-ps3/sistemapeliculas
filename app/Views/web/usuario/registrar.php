<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('contenido') ?>
<?php echo view('partials/_form-error') ?>
<form action="<?php echo base_url('register_post') ?> " method="post">
   <label for="usuario">Usario</label>
   <input type="text" name="usuario" id="usuario">
   <label for="email">Email</label>
   <input type="text" name="email" id="email">
   <label for="contrasena">Contrasena</label>
   <input type="password" name="contrasena" id="contrasena">

   <input type="submit" value="Enviar">
</form>
<?php echo $this->endSection() ?>