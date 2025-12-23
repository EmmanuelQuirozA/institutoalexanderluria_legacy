<!-------------------------UPDATE PERMISOS MODAL FORM------------------------->
<div class="modal fade" id="editarRol_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar permisos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarRol_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <input type="hidden" id="editarRol_idRol" name="idRol">

            <div id="modulosTabla"></div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarRol_borrarRegistro btn btn-danger actionBtn">Borrar rol</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="editarRol_relacionarModulo btn btn-secondary actionBtn">Relacionar módulo</button>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="editarRol_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------UPDATE RELACION MODULO MODAL FORM------------------------->
<div class="modal fade" id="relacionarModulo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar permisos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="relacionarModulo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <div class="row d-flex justify-content-center"><!-- modulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="modulo">Modulo <span class="required">*</span></label>
                <select id="relacionarModulo_modulo" name="modulo" class="form-control " required>
                  <option value=""></option> 
                    <?php 
                    $sqlselect="SELECT idModulo,nombre FROM modulos ORDER BY nombre ASC;";
                    try{
                        $stmtselect=$connection->prepare($sqlselect);
                        $stmtselect->execute();
                        $results=$stmtselect->fetchAll();
                    }
                    catch(Exception $ex){
                        echo($ex -> getMessage());
                    }
                    foreach ($results as $output){?>
                      <option id="<?php echo $output["idModulo"]?>" value="<?php echo $output["idModulo"]?>"><?php echo $output["nombre"]?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="relacionarModulo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE ROL MODAL FORM------------------------->
<div class="modal fade" id="crearRol_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Crear rol</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearRol_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <div class="form-group row"> <!-- nombreRol -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="nombreRol">Nombre del rol <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <input type="text" id="crearRol_nombreRol" name="nombreRol" required="required" autocomplete="no" class="form-control ">
              </div>
            </div>

            <div class="form-group row"> <!-- descripcion -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="descripcion">Descripción <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <!-- <input type="text" id="crearRol_descripcion" name="descripcion" required="required" autocomplete="no" class="form-control "> -->
                <textarea id="crearRol_descripcion" name="descripcion" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearRol_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------UPDATE MODULO MODAL FORM------------------------->
<div class="modal fade" id="editarModulo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar módulo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarModulo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <input type="hidden" id="editarModulo_idModulo" name="idModulo">

            <div class="form-group row"> <!-- nombre -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="nombre">Nombre del módulo <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <input type="text" id="editarModulo_nombre" name="nombre" required="required" autocomplete="no" class="form-control ">
              </div>
            </div>

            <div class="form-group row"> <!-- descripcion -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="descripcion">Descripción <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <textarea id="editarModulo_descripcion" name="descripcion" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <?php //if ($d==1) { echo'<button type="button" class="editarModulo_borrarRegistro btn btn-danger actionBtn">Borrar módulo</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php //if ($u==1) { echo'<button type="button" class="editarModulo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE MODULO MODAL FORM------------------------->
<div class="modal fade" id="crearModulo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Crear módulo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearModulo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <div class="form-group row"> <!-- nombre -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="nombre">Nombre del módulo <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <input type="text" id="crearModulo_nombre" name="nombre" required="required" autocomplete="no" class="form-control ">
              </div>
            </div>

            <div class="form-group row"> <!-- descripcion -->
              <label class="col-form-label col-md-4 col-sm-3 label-align" for="descripcion">Descripción <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-6 ">
                <textarea id="crearModulo_descripcion" name="descripcion" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearModulo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-------------------------CREATE CICLO ESCOLAR MODAL FORM------------------------->
<div class="modal fade" id="crearCicloEscolar_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Agregar un ciclo escolar</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearCicloEscolar_modal_Form" onkeydown="return event.key != 'Enter';">

            <input type="hidden" id="crearCicloEscolar_cicloEscolar">

            <div class="row d-flex justify-content-center"> <!-- cicloEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cicloEscolar">Ciclo escolar</label>
                <input type="text" id="crearCicloEscolar_cicloEscolarDisabled" name="cicloEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="container" style="padding: 0;">
              <div class="row">
  
                <div class="col-md-6">
                  <div class="row d-flex justify-content-center"> <!-- fechaInicio -->
                    <div class="form-group col-md-9 col-sm-6" style="padding: 0;">
                      <label for="fechaInicio">Fecha de inicio <span class="required">*</span></label>
                      <input type="date" id="crearCicloEscolar_fechaInicio" name="fechaInicio" required="required" autocomplete="no" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row d-flex justify-content-center"> <!-- fechaFin -->
                    <div class="form-group col-md-9 col-sm-6" style="padding: 0;">
                      <label for="fechaFin">Fecha de fin <span class="required">*</span></label>
                      <input type="date" id="crearCicloEscolar_fechaFin" name="fechaFin" required="required" autocomplete="no" class="form-control">
                    </div>
                  </div>
                </div>

              </div>
            </div>
            
            
            <div class="modal-footer">
              <!-- <button type="button" class="borrarRegistro btn btn-borrar">Borrar</button> -->
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearCicloEscolar_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
