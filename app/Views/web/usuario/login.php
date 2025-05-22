<?php echo $this->extend('Layouts/dashboard') ?>

<?php echo $this->section('contenido') ?>
<?php echo view('partials/_form-error') ?>

<div class="container">
   <div class="card mx-auto d-block mt-5" style="max-width: 500px;">
      <div class="card-header">
         <h1 class="text-center">Login</h1>

      </div>
      <div class="card-body">
         <form action="<?php echo base_url('login_post') ?> " method="post">
            <div class="mb-3">
               <label class="form-label" for="email">Usuario/Email</label>
               <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="mb-3">
               <label class="form-label" for="contrasena">Contrasena</label>
               <input class="form-control" type="password" name="contrasena" id="contrasena">
            </div>
            <div class="d-grid">
               <input class="btn btn-primary btn-block" type="submit" value="Enviar">
            </div>

         </form>
      </div>

   </div>

</div>

<?php echo $this->endSection() ?>