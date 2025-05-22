<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header')?>
  Registrar Nueva Categoria
  <?php echo view('partials/_form-error') ?>
 <?php echo $this->endSection()?>
<?php echo $this->section('contenido')?>
<form action="<?= base_url('dashboard/Categoria/create') ?>" method="post">
  <div class="mb-3">
   <label  class="form-label"  for="titulo">Titulo</label>
    <input  class="form-control" type="text" name="titulo" id="titulo" placeholder="titulo">


  </div>
 
    <button class="btn btn-primary" type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>