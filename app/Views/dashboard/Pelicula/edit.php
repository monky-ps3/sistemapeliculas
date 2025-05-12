<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Editar Pelicula
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<form action="<?= base_url('dashboard/Pelicula/update/') . $pelicula->id ?>" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo  old('titulo', $pelicula->titulo)   ?>">

        <label for="categoria_id">Categoria</label>

        <select name="categoria_id" id="categoria_id">
                <option value=""></option>
                <?php foreach ($categorias as $c) {
                ?>
                        <option <?php echo $c->id !== old('categoria_id', $pelicula->categoria_id)?: 'selected' ?> value="<?php echo $c->id ?>"><?php echo $c->titulo ?></option>


                <?php } ?>

        </select>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion">
         <?php echo old('descripcion', $pelicula->descripcion) ?>
         </textarea>

        <button type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>