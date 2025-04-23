<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Registrar Nueva Pelicula
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Pelicula/create') ?>" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" placeholder="titulo">
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" id="descripcion"></textarea>

    <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>