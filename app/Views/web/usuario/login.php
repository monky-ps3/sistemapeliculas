
<?php echo $this->extend('Layouts/dashboard') ?>
 
 <?php echo $this->section('contenido') ?>
 <?php echo view('partials/_form-error')?>
 <form action="<?php echo base_url('login_post') ?> " method="post">
    <label for="email">Usuario/Email</label>
<input type="text" name="email" id="email">
<label for="contrasena">Contrasena</label>
<input type="password" name="contrasena" id="contrasena">

<input type="submit" value="Enviar">
 </form>
    <?php echo $this->endSection() ?>