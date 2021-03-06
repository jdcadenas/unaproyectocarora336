<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>carora </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>/assets/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>/assets/template/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>/assets/template/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>/assets/template/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>/assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <?php if ($this->session->flashdata("error")): ?>
            <div class="alert alert-danger">
              <p><?php echo $this->session->flashdata("error"); ?></p>
            </div>
          <?php endif; ?>
          <section class="login_content">
            <form action="<?php echo base_url(); ?>auth/login" method="post">
              <h1>Acceso</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuario" required="" name="usuario"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="clave" />
              </div>
              <div>
                <button type="submit" class="btn btn-primary btn-block btn-flat" >Ingreso</button>

              </div>




              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Departamento de ventas de la empresa Carora Color Venezuela, C.A. </h1>

              </div>

            </form>
          </section>
        </div>


      </div>
    </div>
  </body>
</html>