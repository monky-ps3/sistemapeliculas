<?php echo $this->extend('Layouts/dashboard') ?>
<?php echo $this->section('header') ?>
<h1><?php echo $pelicula->titulo ?></h1>
<?php echo $this->endSection() ?>
<?php echo $this->section('contenido') ?>
<p><?php echo $pelicula->descripcion ?></p>
<h3>Imagenes</h3>
<ul>
    <?php foreach ($imagenes as $i) {
    ?>
        <li><?php echo $i->imagen ?></li>

    <?php
    }
    ?>
</ul>

<h3>etiquetas</h3>
<ul>
    <?php foreach ($etiquetas as $e) {
    ?>
      <!--  <form action="<?= base_url('dashboard/Pelicula/' . $pelicula->id . '/etiqueta_delete'.'/' . $e->id . '/delete') ?>" method="post">  -->
            <button  data-url='<?= base_url('dashboard/Pelicula/' . $pelicula->id . '/etiqueta_delete'.'/' . $e->id . '/delete') ?>'     class="delete_etiqueta"><?php echo $e->titulo ?></button>

      <!--  </form>-->


    <?php
    }
    ?>
</ul>

<!-- 
<script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
      //  console.log(b)
    //console.log(b.getAttribute('data-url'))
     b.onclick=function(event){
       //console.log('click')
       console.log(this.getAttribute('data-url'))
       fetch(this.getAttribute('data-url'),{
        method:'POST'
       }).then(res=>res.json())
       .then(res=>{
        window.location.reload();
        console.log(res)
       })
     }  
    })


   
</script> -->

<script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
        //console.log(b.getAttribute('data-url'))
        b.onclick = function(event) {
            //console.log(this.getAttribute('data-url'))
            fetch(this.getAttribute('data-url'), {
                    method: 'POST'
                }).then(res => res.json())
                .then(res => {
                    //window.location.reload()
                    //console.log(res)
                    window.location.reload(true);
                })

        }

    })
</script>
<?php echo $this->endSection() ?>