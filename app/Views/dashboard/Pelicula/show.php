<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
<h1><?php echo $pelicula['titulo'] ?></h1>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<p><?php echo $pelicula['descripcion'] ?></p>
<?php echo $this->endSection() ?>