<!-------------------------UPDATE PAGO MODAL FORM------------------------->
<div class="modal fade" id="editarMaterialeducativo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar material</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarMaterialeducativo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form" enctype="multipart/form-data">
            <input type="hidden" id="editarMaterialeducativo_idMaterialEducativo">
            
            <div class="row d-flex justify-content-center"> <!-- idGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idGrupo">Grupo <span class="required">*</span></label>
                <input type="text" id="editarMaterialeducativo_idGrupo" name="idGrupo" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente</label>
                <input type="text" id="editarMaterialeducativo_idTrabajador" name="idTrabajador" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- generacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="generacion">Generación</label>
                <input type="text" id="editarMaterialeducativo_generacion" name="generacion" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="editarMaterialeducativo_nivelEscolar" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="editarMaterialeducativo_gradoyGrupo" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Titulo</label>
                <input type="text" id="editarMaterialeducativo_titulo" name="titulo" disabled="disabled" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción</label>
                <textarea id="editarMaterialeducativo_descripcion" name="descripcion" required="required" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarMaterialeducativo_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($r==1) { echo'<a rel="nofollow" id="enlaceMaterialeducativo" href="#" target="_blank" class="btn btn-secondary">Ver material</a>'; } ?>
              <?php if ($c==1) { echo'<button type="button" class="editarMaterialeducativo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE PAGO MODAL FORM------------------------->
<div class="modal fade" id="crearMaterialeducativo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Subir material</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearMaterialeducativo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form" enctype="multipart/form-data">
            
            <div class="row d-flex justify-content-center"> <!-- idGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idGrupo">Grupo <span class="required">*</span></label>
                <input type="text" id="crearMaterialeducativo_idGrupo" name="idGrupo" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="idGrupoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- idTrabajador -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idTrabajador">Docente</label>
                <input type="text" id="crearMaterialeducativo_idTrabajadorDisabled" name="idTrabajador" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="crearMaterialeducativo_idTrabajador">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- generacion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="generacion">Generación</label>
                <input type="text" id="crearMaterialeducativo_generacion" name="generacion" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="crearMaterialeducativo_nivelEscolar" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="crearMaterialeducativo_gradoyGrupo" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Titulo</label>
                <input type="text" id="crearMaterialeducativo_titulo" name="titulo" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción</label>
                <textarea id="crearMaterialeducativo_descripcion" name="descripcion" required="required" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- path -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="path">Archivo</label>
                <input type="file" class="form-control" onchange="validateSize(this)" required="required" id="crearMaterialeducativo_path" style="height: calc(3.5em + 3.75rem + 7px)!important;padding:0px!important;">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($cInicio==1) { echo'<button type="button" class="crearMaterialeducativo_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>