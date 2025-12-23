<!-------------------------UPDATE USUARIO MODAL FORM------------------------->
<div class="modal fade" id="editarcontrasena_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Cambiar contraseña</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarcontrasena_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                      
            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Nueva contraseña <span class="required">*</span></label>
                <input type="password" id="editarcontrasena_password" name="password" class="form-control" required="required">
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <div class="form-group col-md-9 col-sm-6">
                <label for="password">Confirmar contraseña <span class="required">*</span></label>
                <input type="password" id="editarcontrasena_passwordConfirm" name="passwordConfirm" class="form-control" required="required">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="button" class="contrasena_editRegistro btn btn-primary actionBtn">Guardar cambios</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>