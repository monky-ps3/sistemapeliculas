<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header')?>
  Registrar Nueva Categoria
  
 <?php echo $this->endSection()?>
<?php echo $this->section('contenido')?>
<form action="<?= base_url('dashboard/Categoria/create') ?>" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" placeholder="titulo">


    <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>