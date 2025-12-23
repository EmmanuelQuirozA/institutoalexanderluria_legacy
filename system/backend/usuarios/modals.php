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

            <div class="row d-flex justify-content-center"><!-- idRol -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idRol">Rol <span class="required">*</span></label>
                <select id="editarUsuario_idRol" name="idRol" class="form-control" required>
                  <option value=""></option> 
                  <?php $sqlselect="SELECT idRol,nombreRol FROM roles;";
                  try{$stmtselect=$connection->prepare($sqlselect); $stmtselect->execute();$results=$stmtselect->fetchAll();}catch(Exception $ex){echo($ex -> getMessage());}foreach ($results as $output){?>
                  <option value="<?php echo $output["idRol"]?>"><?php echo $output["nombreRol"]?></option> <?php }?>
                </select>
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

            <div class="row d-flex justify-content-center"><!-- idRol -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idRol">Rol <span class="required">*</span></label>
                <select id="crearUsuario_idRol" name="idRol" class="form-control" required>
                  <option value=""></option> 
                    <?php 
                    $sqlselect="SELECT idRol,nombreRol FROM roles;";
                    try{
                        $stmtselect=$connection->prepare($sqlselect);
                        $stmtselect->execute();
                        $results=$stmtselect->fetchAll();
                    }
                    catch(Exception $ex){
                        echo($ex -> getMessage());
                    }
                    foreach ($results as $output){?>
                      <option value="<?php echo $output["idRol"]?>"><?php echo $output["nombreRol"]?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <h2 class="StepTitle">Cambiar contraseña</h2><hr style="margin-top: -10px;">

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



<!-------------------------UPDATE PERSONA MODAL FORM------------------------->
<div class="modal fade" id="editarPersona_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar registro de persona</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarPersona_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <input type="hidden" id="editarPersona_idPersona" name="idPersona">

            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="editarPersona_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="editarPersona_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="editarPersona_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Persona_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($u==1) { echo'<button type="button" class="Persona_editRegistro btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE PERSONA MODAL FORM------------------------->
<div class="modal fade" id="crearPersona_modal" role="dialog">
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
          <form class="was-validated form-register" id="crearPersona_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="crearPersona_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="crearPersona_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">apellido materno <span class="required">*</span></label>
                <input type="text" id="crearPersona_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]+">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearPersona_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>