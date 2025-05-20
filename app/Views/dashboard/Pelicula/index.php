<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('header') ?>
Listado de Peliculas

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<a href="Pelicula/new/">Nuevo</a>
<table>
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
            <td><a href=" Pelicula/show/<?php echo $pelicula->id ?>">Show</a>
                <a href="Pelicula/edit/<?php echo $pelicula->id ?>">Edit</a>
                <a href="Pelicula/etiquetas/<?php echo $pelicula->id; ?>">Tags</a>
                <form action="<?= base_url('dashboard/Pelicula/delete/') . $pelicula->id?>" method="post">
                    <button type="submit">Elimiar</button>
                </form>

            </td>
        <?php } ?>
        </tr>
</table>
<?php echo $pager->links()?>

<?php echo $this->endSection() ?>