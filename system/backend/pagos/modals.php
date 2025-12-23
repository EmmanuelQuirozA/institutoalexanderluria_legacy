<!-------------------------UPDATE PAGO MODAL FORM------------------------->
<div class="modal fade" id="editarPago_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar información de pago</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarPago_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarPago_idPago" name="idPago">
            <input type="hidden" id="editarPago_idAlumno" name="idAlumno">
            <input type="hidden" id="editarPago_idColegiatura" name="idColegiatura">
            
            <!-- INFORMACIÓN NOMBRE DEL ALUMNO (DISABLE) -->
            <div class="row d-flex justify-content-center"> <!-- nombreCompleto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombreCompleto">Nombre</label>
                <input type="text" id="editarPago_alumnoDisabled" name="nombreCompleto" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_alumno">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- username -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="username">Usuario que registró</label>
                <input type="text" id="editarPago_usernameDisabled" name="username" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_username">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="editarPago_nivelEscolarDisabled" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_nivelEscolar">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="editarPago_gradoyGrupoDisabled" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_gradoyGrupo">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- cicloEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cicloEscolar">Ciclo escolar</label>
                <input type="text" id="editarPago_cicloEscolarDisabled" name="cicloEscolar" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_cicloEscolar">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaRegistro -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaRegistro">Fecha de registro</label>
                <input type="date" id="editarPago_fechaRegistroDisabled" name="fechaRegistro" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_fechaRegistro">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- concepto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="concepto">Concepto</label>
                <input type="text" id="editarPago_conceptoDisabled" name="concepto" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_concepto">
              </div>
            </div>
            <div id="editarPago_mesColegiaturaDiv" class="row d-flex justify-content-center"> <!-- mesColegiatura -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="mesColegiatura">Colegiatura del mes:</label>
                <input type="text" id="editarPago_mesColegiaturaDisabled" name="mesColegiatura" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_mesColegiatura">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- monto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="monto">Monto</label>
                <input type="text" id="editarPago_montoDisabled" name="monto" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarPago_monto">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaPago">Fecha de pago</label>
                <input type="date" id="editarPago_fechaPagoDisabled" name="fechaPago" disabled="disabled" autocomplete="no" class="form-control" step="0.01">
                <input type="hidden" id="editarPago_fechaPago">
              </div>
            </div>

            <!-- <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;"> -->
            
            <div class="container">
              <!-- INFORMACIÓN DEL PAGO -->
              <h4 class="StepTitle">Información extra</h4><hr style="margin-top: -10px;">
            
              <div class="row d-flex justify-content-center"> <!-- referencia -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="referencia">Referencia</label>
                  <input type="number" id="editarPago_referencia" name="referencia" autocomplete="no" class="form-control" pattern="[0-9]+">
                </div>
              </div>
              <div class="row d-flex justify-content-center"> <!-- formaPago -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="formaPago">Forma de pago</label>
                  <input type="text" id="editarPago_formaPago" name="formaPago" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                </div>
              </div>
              <div class="row d-flex justify-content-center"> <!-- observaciones -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="observaciones">Observaciones</label>
                  <textarea id="editarPago_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
                </div>
              </div>
              <div class="row d-flex justify-content-center"> <!-- folio -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="folio">Folio</label>
                  <input type="text" id="editarPago_folio" name="folio" autocomplete="no" class="form-control" pattern="[0-9]+">
                </div>
              </div>
              <div class="row d-flex justify-content-center"> <!-- estatusPago -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="estatusPago">Estatus del pago</label>
                  <select id="editarPago_estatusPago" name="estatusPago" class="form-control">
                    <option value="Aceptado">Aceptado</option> 
                    <option value="En validación">En validación</option> 
                    <option value="Sin aprobar">Sin aprobar</option> 
                    <option value="Rechazado">Rechazado</option> 
                  </select>
                </div>
              </div>

              <div id="comprobanteDiv" class="row d-flex justify-content-center"> <!-- comprobante -->
                <div class="form-group col-md-9 col-sm-6">
                  <label for="comprobante">Comprobante</label>
                  <input type="file" class="form-control" onchange="validateSize(this)" id="editarPago_comprobante" style="height: calc(3.5em + 3.75rem + 7px)!important;padding:0px!important;">
                </div>
              </div>
              
            </div>
            
            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarPago_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($r==1) { echo'<a rel="nofollow" id="enlaceComprobante" href="#" target="_blank" class="btn btn-secondary">Ver comprobante</a>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="editarPago_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE PAGO MODAL FORM------------------------->
<div class="modal fade" id="crearPago_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Registrar pago</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="crearPago_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form" enctype="multipart/form-data">
            
            <h4 class="StepTitle">Información del alumno</h4><hr style="margin-top: -10px;">
            <!-- INFORMACIÓN NOMBRE DEL ALUMNO (DISABLE) -->

            <div class="row d-flex justify-content-center"> <!-- alumno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="alumno">Alumno <span class="required">*</span></label>
                <input type="text" id="crearPago_alumno" name="alumno" required="required" autocomplete="no" class="form-control">
                <div class="unidad_list">
                  <div class="list-group" id="alumnoDrop_show_list">
                  <!-- autocomplete list will be display -->
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" id="crearPago_nivelEscolar" name="nivelEscolar"> <!-- nivelEscolar -->

            <div class="row d-flex justify-content-center"> <!-- nivelEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nivelEscolar">Nivel escolar</label>
                <input type="text" id="disabled_crearPago_nivelEscolar" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <input type="hidden" id="crearPago_gradoyGrupo" name="gradoyGrupo"> <!-- gradoyGrupo -->

            <div class="row d-flex justify-content-center"> <!-- gradoyGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="gradoyGrupo">Grado y grupo</label>
                <input type="text" id="disabled_crearPago_gradoyGrupo" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>

            <h4 class="StepTitle">Información del pago</h4><hr style="margin-top: -10px;">
          
            <!-- INFORMACIÓN DEL PAGO -->
          
            <div class="row d-flex justify-content-center"> <!-- concepto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="concepto">Concepto <span class="required">*</span></label>
                <!-- <input type="text" id="crearPago_concepto" name="concepto" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}"> -->
                <select id="crearPago_concepto" name="concepto" class="form-control " required onchange="conceptoValue(this.value);" >
                  <option value=""></option> 
                  <option value="Inscripción">Inscripción </option>
                  <option value="Colegiatura" selected="selected">Colegiatura </option>
                  <option value="Uniforme">Uniforme </option>
                  <option value="Seguro">Seguro </option>
                  <option value="Lista de útiles">Lista de útiles </option>
                  <option value="Libros">Libros </option>
                  <option value="Talleres">Talleres </option>
                  <option value="Otros">Otros (Especificar en "Observaciones")</option>
                </select>
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- cicloEscolar -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="cicloEscolar">Ciclo escolar</label>
                <!-- <input type="text" id="crearPago_cicloEscolar" name="cicloEscolar" autocomplete="no" class="form-control"> -->
                <select id="crearPago_cicloEscolar" name="cicloEscolar" class="form-control" onchange="fetch_select(this.value);"> 
                  <option value=""></option> 
                  <?php 
                    $sql='SELECT  table_name, SUBSTRING(table_name, 13, 9) AS cicloEscolar FROM information_schema.tables
                    WHERE table_name LIKE "colegiaturas%"  ORDER BY SUBSTRING(table_name, 13, 4) ASC;';
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if ($rInicio) {
                      foreach ($result as $row) {
                        //<option value="2018-2019" =$cicloEscolar == '2018-2019' ? ' selected="selected"' : ''; >2018-2019</option>
                        if ($cInicio==$row["cicloEscolar"]) {
                          echo('<option value="'.$row["TABLE_NAME"].'" selected="selected">'.$row["cicloEscolar"].'</option>'); 
                        }else{
                          echo('<option value="'.$row["TABLE_NAME"].'" >'.$row["cicloEscolar"].'</option>'); 
                        }
                      }
                    }
                    echo('<option value="otro">Otro</option>'); 
                
                  ?>
                </select>
              </div>
            </div>
            <div id="crearPago_mesColegiaturaDiv" class="row d-flex justify-content-center"> <!-- mesColegiatura -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="mesColegiatura">Pago del mes de: </label>
                <select id="crearPago_mesColegiatura" name="mesColegiatura" class="form-control" required="required">
                  <option value=""></option> 
                </select>
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- referencia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="referencia">Referencia</label>
                <input type="number" id="crearPago_referencia" name="referencia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- monto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="monto">Monto <span class="required">*</span></label>
                <input type="number" id="crearPago_monto" name="monto" required="required" autocomplete="no" class="form-control" step="0.01" pattern="[0-9]{0,10}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fechaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fechaPago">Fecha de pago <span class="required">*</span></label>
                <input type="date" id="crearPago_fechaPago" name="fechaPago" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- formaPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="formaPago">Forma de pago</label>
                <input type="text" id="crearPago_formaPago" name="formaPago" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,100}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- folio -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="folio">Folio</label>
                <input type="text" id="crearPago_folio" name="folio" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
              </div>
            </div>


            <div class="row d-flex justify-content-center"> <!-- observaciones -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="observaciones">Observaciones</label>
                <textarea id="crearPago_observaciones" name="observaciones" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>


            <div class="row d-flex justify-content-center"> <!-- estatusPago -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="estatusPago">Estatus del pago</label>
                <select id="crearPago_estatusPago" name="estatusPago" class="form-control">
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
                <input type="file" class="form-control" onchange="validateSize(this)" id="crearPago_comprobante" style="height: calc(3.5em + 3.75rem + 7px)!important;padding:0px!important;">
              </div>
            </div>
            
            
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearPago_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------UPDATE RECARGA DE SALDO MODAL FORM------------------------->
<div class="modal fade" id="editarRecargaSaldo_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Recarga de saldo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarRecargaSaldo_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarRecargaSaldo_idRecargasSaldo" name="idRecargasSaldo">
            
            <!-- INFORMACIÓN NOMBRE DEL ALUMNO (DISABLE) -->
            <div class="row d-flex justify-content-center"> <!-- nombreCompleto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombreCompleto">Nombre</label>
                <input type="text" id="editarRecargaSaldo_nombreCompleto" name="nombreCompleto" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- tipoPersona -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoPersona">Tipo de persona</label>
                <input type="text" id="editarRecargaSaldo_tipoPersonaDisabled" name="tipoPersona" disabled="disabled" autocomplete="no" class="form-control">
                <input type="hidden" id="editarRecargaSaldo_tipoPersona" name="tipoPersona">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- monto -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="monto">Monto</label>
                <input type="text" id="editarRecargaSaldo_montoDisabled" name="monto" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- fecha -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="fecha">Fecha</label>
                <input type="text" id="editarRecargaSaldo_fechaDisabled" name="fecha" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- username -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="username">Usuario que registró</label>
                <input type="text" id="editarRecargaSaldo_usernameDisabled" name="username" disabled="disabled" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarRecargaSaldo_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
