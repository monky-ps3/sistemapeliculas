<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>

<body>
    <h3>Listado de peliculas </h3>

    <?php echo view('partials/_session') ?>
    <a href="Pelicula/new/">Nuevo</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Opciones</th>
        </tr>
        <?php foreach ($peliculas as $pelicula) {

        ?>
            <tr>
                <td><?php echo $pelicula['id']; ?></td>
                <td><?php echo $pelicula['titulo']; ?></td>
                <td><?php echo $pelicula['descripcion']; ?></td>
                <td><a href=" Pelicula/show/<?php echo $pelicula['id']; ?>">Show</a>
                    <a href="Pelicula/edit/<?php echo $pelicula['id']; ?>">Edit</a>
                    <form action="<?= base_url('dashboard/Pelicula/delete/').$pelicula['id'] ?>" method="post">Elimiar
                        <button type="submit">Elimiar</button>
                    </form>
                   
                </td>
            <?php } ?>
            </tr>
    </table>
</body>

</html>