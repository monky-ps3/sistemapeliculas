<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
EditarCategoria
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Categoria/update/') . $categoria->id ?>" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo $categoria->titulo ?>">


    <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>