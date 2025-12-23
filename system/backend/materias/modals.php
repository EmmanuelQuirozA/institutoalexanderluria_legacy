<!-------------------------UPDATE MATERIA MODAL FORM------------------------->
<div class="modal fade" id="editarMateria_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar registro de materia</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarMateria_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <input type="hidden" id="editarMateria_idMateria" name="idMateria">

            <div class="row d-flex justify-content-center"> <!-- clave -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="clave">Clave</label>
                <input type="text" id="editarMateria_clave" name="clave" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- materia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="materia">Nombre de materia <span class="required">*</span></label>
                <input type="text" id="editarMateria_materia" name="materia" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar <span class="required">*</span></label>
                  <select id="editarMateria_nivelEscolar" name="estatusPago" class="form-control">
                    <option value="Preescolar">Preescolar</option> 
                    <option value="Primaria">Primaria</option> 
                    <option value="Taller">Taller</option> 
                  </select>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grado -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grado">Grado <span class="required">*</span></label>
                  <select id="editarMateria_grado" name="estatusPago" class="form-control">
                    <option value="1ro">1ro</option> 
                    <option value="2do">2do</option> 
                    <option value="3ro">3ro</option> 
                    <option value="4to">4to</option> 
                    <option value="5to">5to</option> 
                    <option value="6to">6to</option> 
                  </select>
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Materia_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="Materia_editRegistro btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE MATERIA MODAL FORM------------------------->
<div class="modal fade" id="registrarMateria_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta una materia</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarMateria_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- clave -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="clave">Clave</label>
                <input type="text" id="crearMateria_clave" name="clave" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- materia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="materia">Nombre de materia <span class="required">*</span></label>
                <input type="text" id="crearMateria_materia" name="materia" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar <span class="required">*</span></label>
                  <select id="crearMateria_nivelEscolar" name="estatusPago" class="form-control">
                    <option value="Preescolar">Preescolar</option> 
                    <option value="Primaria">Primaria</option> 
                    <option value="Taller">Taller</option> 
                  </select>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- grado -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="grado">Grado <span class="required">*</span></label>
                  <select id="crearMateria_grado" name="estatusPago" class="form-control">
                    <option value="1ro">1ro</option> 
                    <option value="2do">2do</option> 
                    <option value="3ro">3ro</option> 
                    <option value="4to">4to</option> 
                    <option value="5to">5to</option> 
                    <option value="6to">6to</option> 
                  </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearMateria_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>