<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
<form action="<?= base_url('/Categoria/update/').$categoria['id'] ?>" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="titulo" value="<?php echo $categoria['titulo']?>">
        

         <button type="submit">Enviar</button>
    </form>
</body>
</html>