
 <?php echo $this->extend('Layouts/dashboard')?>
 
 <?php echo $this->section('header')?>
  Listado de categorias
  
 <?php echo $this->endSection()?>
 
 <?php echo $this->section('contenido')?>
    <a href="Categoria/new/">Nuevo</a>
    <table>
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

                <td><a href="Categoria/show/<?php echo $categoria->id; ?>">Show</a>
                    <a href="Categoria/edit/<?php echo $categoria->id; ?>">Edit</a>
                    <form action="<?= base_url('dashboard/Categoria/delete/') . $categoria->id ?>" method="post">
                        <button type="submit">Elimiar</button>
                    </form>

                </td>
            <?php } ?>
            </tr>
    </table>
 <?php echo $this->endSection()?>