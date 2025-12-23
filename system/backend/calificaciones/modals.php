<!-------------------------CREATE CALIFICACION MODAL FORM------------------------->
<div class="modal fade" id="registrarCalificacion_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar calificación</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarCalificacion_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="crearCalificacion_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="personaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- alumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="alumno">Alumno <span class="required">*</span></label>
                <input type="text" id="crearCalificacion_alumno" name="alumno" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="alumnoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="crearCalificacion_nivelEscolarDisabled" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="crearCalificacion_nivelEscolar" name="nivelEscolar"> <!-- nivelEscolar -->
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="crearCalificacion_gradoyGrupoDisabled" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="crearCalificacion_gradoyGrupo" name="gradoyGrupo"> <!-- gradoyGrupo -->
              </div>
            </div>

            
            <div class="row d-flex justify-content-center"> <!-- cicloEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cicloEscolar">Ciclo escolar</label>
                <select id="crearCalificacion_cicloEscolar" name="cicloEscolar" class="form-control" onchange="fetch_select(this.value);" required="required"> 
                  <option value=""></option> 
                  <?php 
                    $sql='SELECT  * FROM ciclosescolares ORDER BY cicloEscolar ASC;';
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if ($rInicio) {
                      foreach ($result as $row) {
                        echo('<option value="'.$row["idCicloEscolar"].'">'.$row["cicloEscolar"].'</option>'); 
                      }
                    }
                    echo('<option value="otro">Otro</option>'); 
                
                  ?>
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- periodo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="periodo">Periodo</label>
                <input type="text" id="crearCalificacion_periodo" name="periodo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"><!-- idMateria -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idMateria">Materia <span class="required">*</span></label>
                <select id="crearCalificacion_idMateria" name="idMateria" class="form-control" required>
                  <option value=""></option> 
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- calificacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="calificacion">Calificación</label>
                <input type="number" id="crearCalificacion_calificacion" name="calificacion" required="required" autocomplete="no" class="form-control" step="0.1" max="100" min="0">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearCalificacion_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------UPDATE CALIFICACION MODAL FORM------------------------->
<div class="modal fade" id="editarCalificacion_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar calificación</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarCalificacion_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarCalificacion_idCalificacion" name="idCalificacion"> <!-- idCalificacion -->
            <input type="hidden" id="editarCalificacion_idTrabajador" name="idTrabajador"> <!-- idTrabajador -->
            <input type="hidden" id="editarCalificacion_idAlumno" name="idAlumno"> <!-- idAlumno -->
            <input type="hidden" id="editarCalificacion_cicloEscolar" name="cicloEscolar"> <!-- cicloEscolar -->
            <input type="hidden" id="editarCalificacion_nivelEscolar" name="nivelEscolar"> <!-- nivelEscolar -->
            <input type="hidden" id="editarCalificacion_gradoyGrupo" name="gradoyGrupo"> <!-- gradoyGrupo -->

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente</label>
                <input type="text" id="editarCalificacion_idTrabajadorDisabled" name="idTrabajador" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno</label>
                <input type="text" id="editarCalificacion_idAlumnoDisabled" name="idAlumno" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="editarCalificacion_nivelEscolarDisabled" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="editarCalificacion_gradoyGrupoDisabled" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            
            <div class="row d-flex justify-content-center"> <!-- cicloEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cicloEscolar">Ciclo escolar</label>
                <input type="text" id="editarCalificacion_cicloEscolarDisabled" name="cicloEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- periodo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="periodo">Periodo</label>
                <input type="text" id="editarCalificacion_periodo" name="periodo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"><!-- idMateria -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idMateria">Materia <span class="required">*</span></label>
                <select id="editarCalificacion_idMateria" name="idMateria" class="form-control" required>
                  <option value=""></option> 
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- calificacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="calificacion">Calificación</label>
                <input type="number" id="editarCalificacion_calificacion" name="calificacion" required="required" autocomplete="no" class="form-control" step="0.1" max="100" min="0">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarCalificacion_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="editarCalificacion_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>