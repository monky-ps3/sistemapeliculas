<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('header') ?>
Listado de categorias

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<a type="button" class="btn btn-primary" href="Categoria/new/">Nuevo</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>

        <th>Opciones</th>
    </tr>
    <?php foreach ($categoria as $categoria) {

    ?>
        <tr>
            <td><?php echo $categoria->id; ?></td>
            <td><?php echo $categoria->titulo; ?></td>

            <td><a type="button" class="btn btn-info" href="Categoria/show/<?php echo $categoria->id; ?>">Show</a>
                <a type="button" class="btn btn-success" href="Categoria/edit/<?php echo $categoria->id; ?>">Editar</a>
                <form action="<?= base_url('dashboard/Categoria/delete/') . $categoria->id ?>" method="post">
                    <button type="button" class="btn btn-danger" type="submit">Elimiar</button>
                </form>

            </td>
        <?php } ?>
        </tr>
</table>
<?php echo $pager->links() ?>
<?php echo $this->endSection() ?>