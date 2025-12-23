<!-------------------------UPDATE TUTORES MODAL FORM------------------------->
<div class="modal fade" id="editarTutor_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar registro</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarTutor_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarTutor_idTutor" name="idTutor">
            <input type="hidden" id="editarTutor_idPersona" name="idPersona">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="editarTutor_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="editarTutor_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="editarTutor_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;">
            
            <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="lugarNacimiento">Lugar de nacimiento</label>
                <input type="text" id="editarTutor_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroCel -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroCel">Número de celular</label>
                <input type="text" id="editarTutor_numeroCel" name="numeroCel" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,10}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroTrabajo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroTrabajo">Numero de trabajo</label>
                <input type="text" id="editarTutor_numeroTrabajo" name="numeroTrabajo" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,15}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroCasa -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroCasa">Numero de casa</label>
                <input type="text" id="editarTutor_numeroCasa" name="numeroCasa" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,15}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- correoElectronico -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="correoElectronico">Correo electrónico</label>
                <input type="mail" id="editarTutor_correoElectronico" name="correoElectronico" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- religion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="religion">Religión</label>
                <input type="text" id="editarTutor_religion" name="religion" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            
            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarTutor_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php // if ($c==1) { echo'<button type="button" class="registrarUsuario btn btn-secondary actionBtn">Crear usuario</button>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="editarTutor_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE TUTORES MODAL FORM------------------------->
<div class="modal fade" id="registrarTutor_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un tutor</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarTutor_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="crearTutor_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="crearTutor_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="crearTutor_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;">
            
            <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="lugarNacimiento">Lugar de nacimiento</label>
                <input type="text" id="crearTutor_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroCel -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroCel">Número de celular</label>
                <input type="text" id="crearTutor_numeroCel" name="numeroCel" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,10}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroTrabajo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroTrabajo">Numero de trabajo</label>
                <input type="text" id="crearTutor_numeroTrabajo" name="numeroTrabajo" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,15}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- numeroCasa -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="numeroCasa">Numero de casa</label>
                <input type="text" id="crearTutor_numeroCasa" name="numeroCasa" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]{0,15}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- correoElectronico -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="correoElectronico">Correo electrónico</label>
                <input type="mail" id="crearTutor_correoElectronico" name="correoElectronico" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- religion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="religion">Religión</label>
                <input type="text" id="crearTutor_religion" name="religion" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearTutor_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<!-------------------------UPDATE USUARIO MODAL FORM------------------------->
<div class="modal fade" id="editarUsuario_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar un usuario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarUsuario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <input type="hidden" id="editarUsuario_idUsuario" name="idUsuario">

            <div class="row d-flex justify-content-center"> <!-- username -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="editarUsuario_username" name="username" disabled="disabled" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- correoElectronico -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="correoElectronico">CorreoElectrónico <span class="required">*</span></label>
                <input type="email" id="editarUsuario_correoElectronico" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <h2 class="StepTitle">Cambiar contraseña</h2><hr style="margin-top: -10px;">

            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Nueva contraseña</label>
                <input type="password" id="editarUsuario_password" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Confirmar contraseña</label>
                <input type="password" id="editarUsuario_passwordConfirm" class="form-control">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Usuario_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="Usuario_editRegistro btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE USUARIO MODAL FORM------------------------->
<div class="modal fade" id="registrarUsuario_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un usuario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarUsuario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <div class="row d-flex justify-content-center"> <!-- persona -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="persona">Persona <span class="required">*</span></label>
                <input type="text" id="crearUsuario_idPersona" name="persona" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="personaDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- username -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="username">Nombre de usuario <span class="required">*</span></label>
                <input type="text" id="crearUsuario_username" name="username" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- correoElectronico -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="correoElectronico">CorreoElectrónico <span class="required">*</span></label>
                <input type="email" id="crearUsuario_correoElectronico" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <h2 class="StepTitle">Contraseña</h2><hr style="margin-top: -10px;">

            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Nueva contraseña <span class="required">*</span></label>
                <input type="password" id="crearUsuario_password" required="required" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Confirmar contraseña <span class="required">*</span></label>
                <input type="password" id="crearUsuario_passwordConfirm" required="required" class="form-control">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearUsuario_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<!-------------------------CREATE RELACION MODAL FORM------------------------->
<div class="modal fade" id="registrarRelacion_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta una relación</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarRelacion_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- idTutor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTutor">Tutor <span class="required">*</span></label>
                <input type="text" id="crearRelacion_idTutor" name="idTutor" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="tutorDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno <span class="required">*</span></label>
                <input type="text" id="crearRelacion_idAlumno" name="idAlumno" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="alumnoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- tipoRelacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoRelacion">Tipo de relación <span class="required">*</span></label>
                <input type="text" id="crearRelacion_tipoRelacion" name="tipoRelacion" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearRelacion_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-------------------------UPDATE RELACION MODAL FORM------------------------->
<div class="modal fade" id="editarRelacion_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar relación</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarRelacion_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarRelacion_idR_tutor_alumno" name="idR_tutor_alumno" autocomplete="no" class="form-control">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- idTutor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTutor">Tutor</label>
                <input type="text" id="editarRelacion_idTutor" name="idTutor" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno</label>
                <input type="text" id="editarRelacion_idAlumno" name="idAlumno" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- tipoRelacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoRelacion">Tipo de relación <span class="required">*</span></label>
                <input type="text" id="editarRelacion_tipoRelacion" name="tipoRelacion" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarRelacion_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="editarRelacion_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>