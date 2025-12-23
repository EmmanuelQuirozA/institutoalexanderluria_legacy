<!-------------------------UPDATE TAREA MODAL FORM------------------------->
<div class="modal fade" id="editarTarea_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar tarea</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarTarea_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <input type="hidden" id="editarTarea_idTarea" name="idTarea">

            <div class="row d-flex justify-content-center"> <!-- generacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="generacion">Generación</label>
                <input type="text" id="editarTarea_generacion" name="generacion" autocomplete="no" disabled="disabled" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="editarTarea_nivelEscolar" name="nivelEscolar" autocomplete="no" disabled="disabled" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Nivel escolar</label>
                <input type="text" id="editarTarea_gradoyGrupo" name="gradoyGrupo" autocomplete="no" disabled="disabled" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nombreCompletoDocente -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombreCompletoDocente">Docente</label>
                <input type="text" id="editarTarea_nombreCompletoDocente" name="nombreCompletoDocente" autocomplete="no" disabled="disabled" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- materia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="materia">Materia</label>
                <input type="text" id="editarTarea_materia" name="materia" autocomplete="no" disabled="disabled" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="editarTarea_titulo" name="titulo" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción </label>
                <textarea id="editarTarea_descripcion" name="descripcion" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- fechaInicio -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaInicio">Fecha de inicio <span class="required">*</span></label>
                <input type="date" id="editarTarea_fechaInicio" name="fechaInicio" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- fechaEntrega -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaEntrega">Fecha de entrega <span class="required">*</span></label>
                <input type="date" id="editarTarea_fechaEntrega" name="fechaEntrega" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Tarea_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="Tarea_editRegistro btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE TAREA MODAL FORM------------------------->
<div class="modal fade" id="registrarTarea_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar tarea</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarTarea_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- idGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idGrupo">Grupo</label>
                <select id="crearTarea_idGrupo" name="idGrupo" class="form-control" required="required" onchange="fetchMateria(this.value);">
                  <option value=""></option> 
                    <?php 
                    $sqlselect="SELECT idGrupo,CONCAT(generacion,' | ',nivelEscolar,' | ',CONCAT(grado,'-',grupo)) AS grupo FROM grupos WHERE estadoGrupo='Activo' ORDER BY generacion DESC;";
                    try{
                        $stmtselect=$connection->prepare($sqlselect);
                        $stmtselect->execute();
                        $results=$stmtselect->fetchAll();
                    }
                    catch(Exception $ex){
                        echo($ex -> getMessage());
                    }
                    foreach ($results as $output){?>
                      <option value="<?php echo $output["idGrupo"]?>"><?php echo $output["grupo"]?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- idMateria -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idMateria">Materia <span class="required">*</span></label>
                <select id="crearTarea_idMateria" name="idMateria" class="form-control" required="required">
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="crearTarea_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="personaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="crearTarea_titulo" name="titulo" autocomplete="no" required="required" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción</label>
                <textarea id="crearTarea_descripcion" name="descripcion" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- fechaInicio -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaInicio">Fecha de inicio <span class="required">*</span></label>
                <input type="date" id="crearTarea_fechaInicio" name="fechaInicio" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- fechaEntrega -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaEntrega">Fecha de entrega <span class="required">*</span></label>
                <input type="date" id="crearTarea_fechaEntrega" name="fechaEntrega" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearTarea_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>