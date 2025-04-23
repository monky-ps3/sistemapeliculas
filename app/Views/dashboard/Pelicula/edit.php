<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Editar Pelicula
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Pelicula/update/') . $pelicula['id'] ?>" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo  old('titulo',$pelicula['titulo'])   ?>">
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion">
         <?php echo old('descripcion',$pelicula['descripcion'] ) ?>
         </textarea>

        <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>