<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo de dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>public/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <a class="navbar-brand"> Sistema </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo  base_url()?>dashboard/Categoria" class="nav-link">Categoria</a>
                   </li>
                    <li class="nav-item">
                        <a href="<?php echo  base_url()?>dashboard/Pelicula" class="nav-link">Pelicula</a>

                    </li>
                       <li class="nav-item">
                        <a href="<?php echo  base_url()?>dashboard/Etiqueta" class="nav-link">Etiqueta</a>

                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!--muestra los muestra el titulo del listado-->
                <div class="card-header">
                    <h1><?php echo $this->renderSection('header') ?></h1>
                </div>

                <!--muestra los  errores en partials session-->
                <?php echo view('partials/_session') ?>
                <!--contenido de la plantilla layouts que es el html estructura-->
                <?php echo $this->renderSection('contenido') ?>
            </div>
        </div>


    </div>
    <script src="<?php echo base_url() ?>public/bootstrap/js/bootstrap.min.js">

    </script>
 

</html>