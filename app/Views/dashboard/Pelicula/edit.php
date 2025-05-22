<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
Editar Pelicula
<?php echo view('partials/_form-error') ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<form enctype="multipart/form-data" action="<?= base_url('dashboard/Pelicula/update/') . $pelicula->id ?>" method="post">
        <div class="mb-3">
                <label class="form-label" for="titulo">Titulo</label>
                <input class="form-control" type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo  old('titulo', $pelicula->titulo)   ?>">
        </div>
        <div class="mb-3">
                <label class="form-label" for="categoria_id">Categoria</label>


                <select class="form-control" name="categoria_id" id="categoria_id">
                        <option value=""></option>
                        <?php foreach ($categorias as $c) {
                        ?>
                                <option <?php echo $c->id !== old('categoria_id', $pelicula->categoria_id) ?: 'selected' ?> value="<?php echo $c->id ?>"><?php echo $c->titulo ?></option>


                        <?php } ?>

                </select>

        </div>
         <div class="mb-3">
        <label  class="form-label"  for="descripcion">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion">
         <?php echo old('descripcion', $pelicula->descripcion) ?>
         </textarea>

          </div>


 <div class="mb-3">
        <?php if ($pelicula->id) : ?>
                <label  class="form-label"  for="imagen">Imagen</label>
                <input class="form-control"  type="file" name="imagen" id="imagen">
        <?php endif ?>
         </div>
        <button   class="btn btn-primary" type="submit">Enviar</button>
</form>
<?php echo $this->endSection() ?>