<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
<form action="<?= base_url('/Pelicula/update/').$pelicula['id'] ?>" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo $pelicula['titulo']?>">
         <label for="descripcion">Descripcion</label>
         <textarea name="descripcion" id="descripcion">
         <?php echo $pelicula['descripcion']?>
         </textarea>

         <button type="submit">Enviar</button>
    </form>
</body>
</html>