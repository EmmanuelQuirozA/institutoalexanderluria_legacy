<!-------------------------UPDATE GRUPO MODAL FORM------------------------->
<div class="modal fade" id="editarGrupo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar grupo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarGrupo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <input type="hidden" id="editarGrupo_idGrupo" name="idGrupo">

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="editarGrupo_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="editarpersonaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- generacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="generacion">Generación <span class="required">*</span></label>
                <input type="text" id="editarGrupo_generacion" name="generacion" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar <span class="required">*</span></label>
                <select id="editarGrupo_nivelEscolar" name="estatusPago" class="form-control">
                  <option value="Preescolar">Preescolar</option> 
                  <option value="Primaria">Primaria</option> 
                  <option value="Taller">Taller</option> 
                </select>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grado -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grado">Grado <span class="required">*</span></label>
                <input type="number" id="editarGrupo_grado" name="grado" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grupo">Grupo <span class="required">*</span></label>
                <input type="text" id="editarGrupo_grupo" name="grupo" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- salon -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="salon">Salón</label>
                <input type="text" id="editarGrupo_salon" name="salon" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="modal-footer">
              <div class="form-group">
                <label class="control-label" for="update_altaBaja">Activar o desactivar</label>
                <input id="editarGrupo_cambiarEstado" type="checkbox" class="js-switch" />
              </div>
              <?php if ($d==1) { echo'<button type="button" class="Grupo_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="editarGrupo_relacionarMateria btn btn-secondary actionBtn">Relacionar materia</button>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="Grupo_editRegistro btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE GRUPO MODAL FORM------------------------->
<div class="modal fade" id="registrarGrupo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un grupo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarGrupo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="crearGrupo_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="personaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- generaciom -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="generaciom">Generación <span class="required">*</span></label>
                <input type="text" id="crearGrupo_generacion" name="generacion" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar <span class="required">*</span></label>
                  <select id="crearGrupo_nivelEscolar" name="nivelEscolar" class="form-control">
                    <option value="Preescolar">Preescolar</option> 
                    <option value="Primaria">Primaria</option> 
                    <option value="Taller">Taller</option> 
                  </select>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grado -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grado">Grado <span class="required">*</span></label>
                <input type="number" id="crearGrupo_grado" name="grado" autocomplete="no" required="required" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grupo">Grupo <span class="required">*</span></label>
                <input type="text" id="crearGrupo_grupo" name="grupo" autocomplete="no" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- salon -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="salon">Salón</label>
                <input type="text" id="crearGrupo_salon" name="salon" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearGrupo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------UPDATE RELACION MATERIA MODAL FORM------------------------->
<div class="modal fade" id="relacionarMateria_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Relacionar materia</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="relacionarMateria_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-10 col-sm-10">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="relacionarMateria_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="relacionarMateriaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"><!-- idMateria -->
              <div class="form-group col-md-10 col-sm-10">
                <label for="idMateria">Materia <span class="required">*</span></label>
                <select id="relacionarMateria_idMateria" name="idMateria" class="form-control" required>
                  <option value=""></option> 
                </select>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"><!-- horaInicio -->
              <div class="form-group col-md-5 col-sm-5">
                <label for="horaInicio">Hora de inicio <span class="required">*</span></label>
                <input type="time" id="relacionarMateria_horaInicio" name="horaInicio" autocomplete="no" class="form-control" required="required">
              </div>
              <div class="form-group col-md-5 col-sm-5">
                <label for="horaFin">Hora de fin <span class="required">*</span></label>
                <input type="time" id="relacionarMateria_horaFin" name="horaFin" autocomplete="no" class="form-control" required="required">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- dia -->
              <div class="form-group col-md-10 col-sm-10">
                <label for="dia">Día <span class="required">*</span></label>
                  <select id="relacionarMateria_dia" name="dia" class="form-control">
                    <option value="Lunes">Lunes</option> 
                    <option value="Martes">Martes</option> 
                    <option value="Miércoles">Miércoles</option> 
                    <option value="Jueves">Jueves</option> 
                    <option value="Viernes">Viernes</option> 
                    <option value="Sábado">Sábado</option> 
                  </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="relacionarMateria_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-------------------------DELETE HORARIO MODAL FORM------------------------->

<div class="modal fade" id="borrarHorario_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Relacionar materia</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="borrarHorario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
          <table id="modulosPermisosTable" class=" table table-bordered  table-striped  nowrap"  cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Horario</th>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miércoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
              <th>Sábado</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td id="Horario"> </td>
                <td id="Lunes"> </td>
                <td id="Martes"> </td>
                <td id="Miércoles"> </td>
                <td id="Jueves"> </td>
                <td id="Viernes"> </td>
                <td id="Sábado"> </td>
              </tr>
          </tbody>
        </table>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Horario_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>