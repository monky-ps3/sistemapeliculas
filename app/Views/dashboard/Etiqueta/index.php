<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('header') ?>
Listado de Etiquetas

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<a type="button" class="btn btn-primary" href="Etiqueta/new/">Nuevo</a>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>Categoria</th>
       
        <th>Opciones</th>
    </tr>
    <?php foreach ($etiquetas as $etiqueta) {

    ?>
        <tr>
            <td><?php echo $etiqueta->id ?></td>
            <td><?php echo $etiqueta->titulo ?></td>
            <td><?php echo $etiqueta->categoria ?></td>
      
            <td><a  type="button" class="btn btn-info" href=" Etiqueta/show/<?php echo $etiqueta->id ?>">Show</a>
                <a  type="button" class="btn btn-success" href="Etiqueta/edit/<?php echo $etiqueta->id ?>">Editar</a>
           
                <form action="<?= base_url('dashboard/Etiqueta/delete/') . $etiqueta->id?>" method="post">
                    <button type="button" class="btn btn-danger"   type="submit">Elimiar</button>
                </form>

            </td>
        <?php } ?>
        </tr>
</table>

<?php echo $pager->links()?>
<?php echo $this->endSection() ?>