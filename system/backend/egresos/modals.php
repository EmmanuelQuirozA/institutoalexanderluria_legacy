<!-------------------------UPDATE EGRESO MODAL FORM------------------------->
<div class="modal fade" id="editarEgreso_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edtiar egreso</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarEgreso_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form" enctype="multipart/form-data">
            <input type="hidden" id="editarEgreso_idEgreso" name="idEgreso">
            <input type="hidden" id="editarEgreso_idUsuario" name="idUsuario">
            <input type="hidden" id="editarEgreso_fechaAprobado" name="fechaAprobado">
            
            <h4 class="StepTitle">Información del egreso</h4><hr style="margin-top: -10px;">
            <!-- INFORMACIÓN NOMBRE DEL ALUMNO (DISABLE) -->

            <div class="row d-flex justify-content-center"> <!-- referencia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="referencia">Referencia <span class="required">*</span></label>
                <input type="text" id="editarEgreso_referencia" name="referencia" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- receptor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="receptor">Receptor <span class="required">*</span></label>
                <input type="text" id="editarEgreso_receptor" name="receptor" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- concepto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="concepto">Concepto <span class="required">*</span></label>
                <input type="text" id="editarEgreso_concepto" name="concepto" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <!-- <h4 class="StepTitle">Información del pago</h4><hr style="margin-top: -10px;"> -->
          
            <div class="row d-flex justify-content-center"> <!-- tipoGasto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoGasto">Tipo de gasto</label>
                <input type="text" id="editarEgreso_tipoGasto" name="tipoGasto" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- precioUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioUnitario">Precio unitario</label>
                <input type="number" id="editarEgreso_precioUnitario" name="precioUnitario" autocomplete="no" class="form-control" step="0.01">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="editarEgreso_cantidad" name="cantidad" autocomplete="no" class="form-control" step="0.01" pattern="[0-9]+">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- unidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="unidad">Unidad</label>
                <input type="text" id="editarEgreso_unidad" name="unidad" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaRegistro -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaRegistro">Fecha de registro</label>
                <input type="date" id="editarEgreso_fechaRegistro" name="fechaRegistro" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaPago">Fecha de pago</label>
                <input type="date" id="editarEgreso_fechaPago" name="fechaPago" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- formaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="formaPago">Forma de pago</label>
                <input type="text" id="editarEgreso_formaPago" name="formaPago" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="editarEgreso_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- folio -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="folio">Folio</label>
                <input type="text" id="editarEgreso_folio" name="folio" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- estatusEgreso -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="estatusEgreso">Estatus del pago</label>
                <select id="editarEgreso_estatusEgreso" name="estatusEgreso" class="form-control">
                  <option value="Aceptado">Aceptado</option> 
                  <option value="En validación">En validación</option> 
                  <option value="Sin aprobar" selected="selected">Sin aprobar</option> 
                  <option value="Rechazado">Rechazado</option> 
                </select>
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaAprobado -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaAprobado">Fecha de aprobación o cambio de estatus</label>
                <input type="date" id="editarEgreso_fechaAprobadoDisabled" name="fechaAprobado" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div id="comprobanteDiv" class="row d-flex justify-content-center"> <!-- comprobante -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="comprobante">Comprobante</label>
                <input type="file" class="form-control" onchange="validateSize(this)" id="editarEgreso_comprobante" style="height: calc(3.5em + 3.75rem + 7px)!important;padding:0px!important;">
              </div>
            </div>
            
            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarEgreso_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($r==1) { echo'<a rel="nofollow" id="enlaceComprobante" href="#" target="_blank" class="btn btn-secondary">Ver comprobante</a>'; } ?>
              <?php if ($c==1) { echo'<button type="button" class="editarEgreso_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE EGRESO MODAL FORM------------------------->
<div class="modal fade" id="crearEgreso_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar egreso</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearEgreso_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form" enctype="multipart/form-data">
            
            <h4 class="StepTitle">Información del egreso</h4><hr style="margin-top: -10px;">
            <!-- INFORMACIÓN NOMBRE DEL ALUMNO (DISABLE) -->

            <div class="row d-flex justify-content-center"> <!-- referencia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="referencia">Referencia <span class="required">*</span></label>
                <input type="text" id="crearEgreso_referencia" name="referencia" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- receptor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="receptor">Receptor <span class="required">*</span></label>
                <input type="text" id="crearEgreso_receptor" name="receptor" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- concepto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="concepto">Concepto <span class="required">*</span></label>
                <input type="text" id="crearEgreso_concepto" name="concepto" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <!-- <h4 class="StepTitle">Información del pago</h4><hr style="margin-top: -10px;"> -->
          
            <div class="row d-flex justify-content-center"> <!-- tipoGasto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoGasto">Tipo de gasto</label>
                <input type="text" id="crearEgreso_tipoGasto" name="tipoGasto" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- precioUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioUnitario">Precio unitario</label>
                <input type="number" id="crearEgreso_precioUnitario" name="precioUnitario" autocomplete="no" class="form-control" step="0.01">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="crearEgreso_cantidad" name="cantidad" autocomplete="no" class="form-control" step="0.01" pattern="[0-9]+">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- unidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="unidad">Unidad</label>
                <input type="text" id="crearEgreso_unidad" name="unidad" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaPago">Fecha de pago</label>
                <input type="date" id="crearEgreso_fechaPago" name="fechaPago" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- formaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="formaPago">Forma de pago</label>
                <input type="text" id="crearEgreso_formaPago" name="formaPago" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="crearEgreso_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- folio -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="folio">Folio</label>
                <input type="text" id="crearEgreso_folio" name="folio" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- estatusEgreso -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="estatusEgreso">Estatus del pago</label>
                <select id="crearEgreso_estatusEgreso" name="estatusEgreso" class="form-control">
                  <option value="Aceptado">Aceptado</option> 
                  <option value="En validación">En validación</option> 
                  <option value="Sin aprobar" selected="selected">Sin aprobar</option> 
                  <option value="Rechazado">Rechazado</option> 
                </select>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- comprobante -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="comprobante">Comprobante</label>
                <input type="file" class="form-control" onchange="validateSize(this)" id="crearEgreso_comprobante" style="height: calc(3.5em + 3.75rem + 7px)!important;padding:0px!important;">
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearEgreso_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
