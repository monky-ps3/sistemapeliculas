<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Mostrar <h3><?php echo $categoria['titulo'] ?></h3>

<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<h1><?php echo $categoria['titulo'] ?></h1>
<?php echo $this->endSection() ?>