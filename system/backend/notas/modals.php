<!-------------------------CREATE NOTADOCENTE MODAL FORM------------------------->
<div class="modal fade" id="registrarNotaAdmin_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Crear nota</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-horizontal" id="registrarNotaAdmin_modal_Form">
            
            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente <span class="required">*</span></label>
                <input type="text" id="crearNotaAdmin_idTrabajador" name="idTrabajador" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="docenteDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="crearNotaAdmin_titulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- texto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="texto">Texto <span class="required">*</span></label>
                <textarea id="crearNotaAdmin_texto" name="texto" rows="5" cols="33" required="required" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="button" class="crearNotaAdmin_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------EDIT NOTADOCENTE MODAL FORM------------------------->
<div class="modal fade" id="editarNotaAdmin_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar nota</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-horizontal" id="editarNotaAdmin_modal_Form">
            <input type="hidden" id="editarNotaAdmin_idNotasAdmin" name="idNotasAdmin" disabled="disabled" autocomplete="no" class="form-control">
            
            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente</label>
                <input type="text" id="editarNotaAdmin_idTrabajador" name="idTrabajador" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="editarNotaAdmin_titulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- texto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="texto">Texto <span class="required">*</span></label>
                <textarea id="editarNotaAdmin_texto" name="texto" rows="5" cols="33" required="required" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" id="borrarBtn" class="editarNotaAdmin_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="button" id="editarBtn" class="editarNotaAdmin_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>