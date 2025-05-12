<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Registrar Nueva Etiqueta
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Etiqueta/create') ?>" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" placeholder="titulo">

    <label for="categoria_id">Categoria</label>
   
    <select name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach ($categorias as $c) {
        ?>
            <option value="<?php echo $c->id ?>"><?php echo $c->titulo ?></option>


        <?php } ?>

    </select>

    

    <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>