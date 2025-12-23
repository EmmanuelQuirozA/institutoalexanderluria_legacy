

<!-------------------------CREATE INVENTARIO MODAL FORM------------------------->
<div class="modal fade" id="registrarInventario_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar artículo en inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarInventario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción <span class="required">*</span></label>
                <input type="text" id="crearInventario_descripcion" name="descripcion" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- unidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="unidad">Unidad <span class="required">*</span></label>
                <input type="text" id="crearInventario_unidad" name="unidad" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- precioCompra -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioCompra">Precio de compra <span class="required">*</span></label>
                <input type="number" id="crearInventario_precioCompra" name="precioCompra" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- precioSugerido -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioSugerido">Precio sugerido <span class="required">*</span></label>
                <input type="number" id="crearInventario_precioSugerido" name="precioSugerido" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearInventario_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE ENTRADA MODAL FORM------------------------->
<div class="modal fade" id="registrarEntrada_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar entrada al inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarEntrada_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- idInventario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idInventario">Artículo del inventario <span class="required">*</span></label>
                <input type="text" id="crearEntrada_idInventario" name="idInventario" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="Entrada_idInventarioDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad <span class="required">*</span></label>
                <input type="number" id="crearEntrada_cantidad" name="cantidad" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- costoUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="costoUnitario">Costo unitario <span class="required">*</span></label>
                <input type="number" id="crearEntrada_costoUnitario" name="costoUnitario" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- proveedor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="proveedor">Proveedor</label>
                <input type="text" id="crearEntrada_proveedor" name="proveedor" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="crearEntrada_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearEntrada_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE SALIDAS MODAL FORM------------------------->
<div class="modal fade" id="registrarSalida_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar salida del inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarSalida_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">

            <div class="row d-flex justify-content-center"> <!-- idInventario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idInventario">Artículo del inventario <span class="required">*</span></label>
                <input type="text" id="crearSalida_idInventario" name="idInventario" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="Salida_idInventarioDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno </label>
                <input type="text" id="crearSalida_idAlumno" name="idAlumno" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="idAlumnoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad <span class="required">*</span></label>
                <input type="number" id="crearSalida_cantidad" name="cantidad" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- costoUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="costoUnitario">Costo unitario <span class="required">*</span></label>
                <input type="number" id="crearSalida_costoUnitario" name="costoUnitario" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="crearSalida_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearSalida_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>







<!-------------------------EDIT INVENTARIO MODAL FORM------------------------->
<div class="modal fade" id="editInventario_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar artículo en inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editInventario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editInventario_idInventario" name="idInventario">

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Descripción <span class="required">*</span></label>
                <input type="text" id="editInventario_descripcion" name="descripcion" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- unidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="unidad">Unidad <span class="required">*</span></label>
                <input type="text" id="editInventario_unidad" name="unidad" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- precioCompra -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioCompra">Precio de compra <span class="required">*</span></label>
                <input type="number" id="editInventario_precioCompra" name="precioCompra" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- precioSugerido -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="precioSugerido">Precio sugerido <span class="required">*</span></label>
                <input type="number" id="editInventario_precioSugerido" name="precioSugerido" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Inventario_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="editInventario_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------EDIT ENTRADA MODAL FORM------------------------->
<div class="modal fade" id="editEntrada_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar entrada al inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editEntrada_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editEntrada_idEntrada" name="idEntrada">
            <input type="hidden" id="editEntrada_idInventario" name="idInventario">

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Artículo del inventario</label>
                <input type="text" id="editEntrada_descripcion" name="descripcion" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="editEntrada_cantidad" name="cantidad" disabled="disabled" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- costoUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="costoUnitario">Costo unitario <span class="required">*</span></label>
                <input type="number" id="editEntrada_costoUnitario" name="costoUnitario" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- proveedor -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="proveedor">Proveedor</label>
                <input type="text" id="editEntrada_proveedor" name="proveedor" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="editEntrada_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Entrada_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="editEntrada_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------EDIT SALIDAS MODAL FORM------------------------->
<div class="modal fade" id="editSalida_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar salida del inventario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editSalida_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editSalida_idSalida" name="idSalida">
            <input type="hidden" id="editSalida_idInventario" name="idInventario">

            <div class="row d-flex justify-content-center"> <!-- descripcion -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="descripcion">Artículo del inventario</label>
                <input type="text" id="editSalida_descripcion" name="descripcion" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- idAlumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idAlumno">Alumno </label>
                <input type="text" id="editSalida_idAlumno" name="idAlumno" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- cantidad -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="editSalida_cantidad" name="cantidad" disabled="disabled" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- costoUnitario -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="costoUnitario">Costo unitario <span class="required">*</span></label>
                <input type="number" id="editSalida_costoUnitario" name="costoUnitario" required="required" autocomplete="no" class="form-control" step="0.1" min="0">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="editSalida_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="Salida_borrarRegistro btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="editSalida_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>