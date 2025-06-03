<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href="<?php echo base_url() ?>public/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">
            <a class="navbar-brand"> Sistema </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Categoria</a>
                    </li>

                </ul>
            </div>
        </div>

    </nav>

    <?= view('partials/_session') ?>
    <div class="container">
       <?php echo $this->renderSection('contenido') ?>
    </div>


    <script src="<?php echo base_url() ?>public/bootstrap/js/bootstrap.min.js">

    </script>
</body>

</html>