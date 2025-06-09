<?php echo $this->extend('Layouts/dashboard') ?>



<?php echo $this->section('contenido') ?>

<form action="" method="post">

    <label for="">Categorias</label>
    <select name="categoria_id" id="categoria_id">
        <option value=""></option>
        <?php foreach ($categorias as $c) {

        ?>
            <!-- <option value="<?= $c->id ?>" <?= ($c->id == $categoria_id) ? 'selected' : '' ?>>
                <?= $c->titulo ?>
            </option> -->


            <option value="<?php echo $c->id; ?>" <?php echo ($c->id == $categoria_id) ? 'selected' : ''; ?>>
                <?php echo $c->titulo; ?>
            </option>
        <?php
        }
        ?>
    </select>

    <label for="">Etiquetas</label>
    <select name="etiqueta_id" id="etiqueta_id">
        <option value=""></option>
        <?php foreach ($etiquetas as $e) {

        ?>
            <option value="<?php echo $e->id ?>"><?php echo $e->titulo ?></option>
        <?php
        }
        ?>
    </select>

    <button type="submit" id="sendboton">Enviar</button>
</form>



<script>
    function disableEnableButton() {
        if (document.querySelector('[name=etiqueta_id]').value == '') {
            document.querySelector('#sendboton').setAttribute('disabled', 'disabled')
        } else {
            document.querySelector('#sendboton').removeAttribute('disabled')
        }
    }
    document.querySelector('[name=categoria_id]').onchange = function(event) {
        // console.log(this.value)
        window.location.href = '<?= route_to('Pelicula/etiquetas/', $pelicula->id) ?>?categoria_id=' + this.value

    }
    document.querySelector('[name=etiqueta_id]').onchange = function(event) {
        disableEnableButton()

    }
    disableEnableButton()

</script>

<?php echo $this->endSection() ?>