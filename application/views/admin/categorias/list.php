<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">

    <a href="#" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span>Agregar categoría</a>

   </div>
 </div>

  <div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_content">
        

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="headings">
               
                <th class="column-title"># </th>
                <th class="column-title">Descripción</th>
               
                <th class="column-title "><span class="nobr">Opciones</span>
                </th>
                
              </tr>
            </thead>

            <tbody>

              <?php if (!empty($lineas)): ?>
                <?php foreach ($lineas as $linea): ?>

                      <td class=" "><?php echo $linea->id_linea; ?></td>
                 <td class=" "><?php echo $linea->nombre_linea; ?></td>
               
                
                <td class=" last">
                 <div class="btn-group">
                  <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target=".bs-example-modal-lg" value="<?php echo $linea->id_linea ?>"><span class="fa fa-search"></span></button>
                  
                    <a href="#" title="" class="btn btn-warning "><span class="fa fa-pencil"></span></a>
                    
                     <a href="<?php echo base_url() ?>categorias/delete/<?php echo $linea->id_linea; ?>" title="" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                 </div>
                </td>
              </tr>


                  
                 
                
                <?php endforeach ?>
                
              <?php endif ?>
              
                
              
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- Large modal -->
                  


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Información de las Lista</h4>
                        </div>
                        <div class="modal-body">
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                         
                        </div>

                      </div>
                    </div>
                  </div>

    <!-- //Large modal -->              
<script>

        
  //agregado personal
    var base_url= "<?php echo base_url(); ?>"
    

    
    
  
</script>