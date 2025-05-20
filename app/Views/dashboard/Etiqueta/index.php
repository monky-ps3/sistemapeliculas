<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('header') ?>
Listado de Etiquetas

<?php echo $this->endSection() ?>

<?php echo $this->section('contenido') ?>
<a href="Etiqueta/new/">Nuevo</a>
<table>
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
      
            <td><a href=" Etiqueta/show/<?php echo $etiqueta->id ?>">Show</a>
                <a href="Etiqueta/edit/<?php echo $etiqueta->id ?>">Edit</a>
           
                <form action="<?= base_url('dashboard/Etiqueta/delete/') . $etiqueta->id?>" method="post">
                    <button type="submit">Elimiar</button>
                </form>

            </td>
        <?php } ?>
        </tr>
</table>

<?php echo $pager->links()?>
<?php echo $this->endSection() ?>