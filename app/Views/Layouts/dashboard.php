<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo de dashboard</title>
</head>

<body>
    <!--muestra los muestra el titulo del listado-->
    <h1><?php echo $this->renderSection('header') ?></h1>
    <!--muestra los  errores en partials session-->
    <?php echo view('partials/_session') ?>
    <!--contenido de la plantilla layouts que es el html estructura-->
    <?php echo $this->renderSection('contenido') ?>
</body>

</html>