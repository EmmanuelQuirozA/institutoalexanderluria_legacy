<!-------------------------CREATE NOTAALUMNO MODAL FORM------------------------->
<div class="modal fade" id="registrarNotaAlumno_modal" role="dialog">
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
          <form class="was-validated form-horizontal" id="registrarNotaAlumno_modal_Form">
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno <span class="required">*</span></label>
                <input type="text" id="crearNotaAlumno_idAlumno" name="idAlumno" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="alumnoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="crearNotaAlumno_titulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- texto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="texto">Texto <span class="required">*</span></label>
                <textarea id="crearNotaAlumno_texto" name="texto" rows="5" cols="33" required="required" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="button" class="crearNotaAlumno_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------EDIT NOTAALUMNO MODAL FORM------------------------->
<div class="modal fade" id="editarNotaAlumno_modal" role="dialog">
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
          <form class="was-validated form-horizontal" id="editarNotaAlumno_modal_Form">
            <input type="hidden" id="editarNotaAlumno_idNotaAlumno" name="idNotaAlumno" disabled="disabled" autocomplete="no" class="form-control">
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno</label>
                <input type="text" id="editarNotaAlumno_idAlumno" name="idAlumno" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="editarNotaAlumno_titulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- texto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="texto">Texto <span class="required">*</span></label>
                <textarea id="editarNotaAlumno_texto" name="texto" rows="5" cols="33" required="required" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" id="borrarBtn" class="editarNotaAlumno_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <button type="button" id="editarBtn" class="editarNotaAlumno_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>