<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Registrar Nueva Pelicula
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Pelicula/create') ?>" method="post">
    <div class="mb-3">
        <label class="form-label" for="titulo">Titulo</label>
        <input class="form-control" type="text" name="titulo" id="titulo" placeholder="titulo">
    </div>
    <div class="mb-3">
        <label class="form-label" for="categoria_id">Categoria</label>

        <select class="form-control" name="categoria_id" id="categoria_id">
            <option value=""></option>
            <?php foreach ($categorias as $c) {
            ?>
                <option value="<?php echo $c->id ?>"><?php echo $c->titulo ?></option>


            <?php } ?>

        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="descripcion">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>