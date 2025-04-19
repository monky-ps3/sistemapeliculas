<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Listado de peliculas </h3>
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
                <td><?php echo $categoria['id']; ?></td>
                <td><?php echo $categoria['titulo']; ?></td>
              
                <td><a href="Categoria/show/<?php echo $categoria['id']; ?>">Show</a>
                    <a href="Categoria/edit/<?php echo $categoria['id']; ?>">Edit</a>
                    <form action="<?= base_url('/Categoria/delete/').$categoria['id'] ?>" method="post">
                        <button type="submit">Elimiar</button>
                    </form>
                   
                </td>
            <?php } ?>
            </tr>
    </table>
</body>

</html>