<!-- page content -->
        <div class="" role="main">

            <div class="page-title">
              <div class="title_left">
                <h3> Catálogo de Productos -- <small>  Fábrica de Pinturas Carora Venezuela C.A</small> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                   <select class="form-control"name="sucursalselectcatalogo" id="sucursalselectcatalogo">

  <option value="0">Seleccione la Sucursal ...</option>
   <?php if (!empty($sucursales)): ?>
        <?php foreach ($sucursales as $sucursal): ?>
             <?php if ($sucursal->id == $ids): ?>
                <option value="<?php echo $sucursal->id ?>" selected>
                      <?php echo $sucursal->id . '' . $sucursal->nombre ?>
                </option>
              <?php else: ?>
                <option value="<?php echo $sucursal->id ?>" >
                      <?php echo $sucursal->id . ' ' . $sucursal->nombre ?>
                </option>
              <?php endif;?>
        <?php endforeach;?>
          <?php endif?>
  </select>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">

                  <div class="x_content">

                    <div class="row">

 <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $producto): ?>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="<?php echo base_url() . $producto->imagen_producto ?>" alt="foto" />
                            <div class="mask">
                              <p>Codigo:
                                <?php echo $producto->codigo ?></p>
                              <div class="tools tools-bottom">
                              <!--  <a href="#"><i class="fa fa-link"></i></a>
                                <a href="#"><i class="fa fa-pencil"></i></a>
                                <a href="#"><i class="fa fa-times"></i></a>
                              -->
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p class="text-info"><?php echo $producto->nombre ?></p>
                            <p class="align-content-center"><?php echo 'Bs.' . $producto->precio ?></p>

                          </div>
                        </div>
                      </div>

              <?php endforeach?>
              <?php else: ?>

                <div class="alert alert-danger" role="alert" > No existen Productos a mostrar </div>

      <?php endif?>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<script>
//agregado personal
var base_url= "<?php echo base_url(); ?>";

</script>