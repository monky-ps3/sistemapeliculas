<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('header') ?>
Listado de Peliculas

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<a type="button" class="btn btn-primary" href="Pelicula/new/">Nuevo</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>Categoria</th>
        <th>Descripcion</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($peliculas as $pelicula) {

    ?>
        <tr>
            <td><?php echo $pelicula->id ?></td>
            <td><?php echo $pelicula->titulo ?></td>
            <td><?php echo $pelicula->categoria ?></td>
            <td><?php echo $pelicula->descripcion ?></td>
            <td><a type="button" class="btn btn-info" href=" Pelicula/show/<?php echo $pelicula->id ?>">Show</a>
                <a  type="button" class="btn btn-success" href="Pelicula/edit/<?php echo $pelicula->id ?>">Editar</a>
                <a  type="button" class="btn btn-warning" href="Pelicula/etiquetas/<?php echo $pelicula->id; ?>">Tags</a>
                <form action="<?= base_url('dashboard/Pelicula/delete/') . $pelicula->id?>" method="post">
                    <button type="button" class="btn btn-danger"  type="submit">Elimiar</button>
                </form>

            </td>
        <?php } ?>
        </tr>
</table>
<?php echo $pager->links()?>

<?php echo $this->endSection() ?>