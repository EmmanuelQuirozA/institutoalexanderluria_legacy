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
              <?php // if ($dInicio==1) { echo'<button type="button" class="editarPago_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($rInicio==1) { echo'<a rel="nofollow" id="enlaceComprobante" href="#" target="_blank" class="btn btn-secondary">Ver comprobante</a>'; } ?>
              <?php //if ($uInicio==1) { echo'<button type="button" id="guardarComprobante" class="editarPago_guardarComprobante btn btn-secondary actionBtn">Guardar comprobante</button>'; } ?>
              <?php if ($uInicio==1) { echo'<button type="button" class="editarPago_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
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
                    $sql='SELECT  table_name AS colegiaturaCicloEscolar, SUBSTRING(table_name, 13, 9) AS cicloEscolar FROM information_schema.tables
                    WHERE table_name LIKE "colegiaturas%"  ORDER BY SUBSTRING(table_name, 13, 4) ASC;';
                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if ($rInicio) {
                      foreach ($result as $row) {
                        //<option value="2018-2019" =$cicloEscolar == '2018-2019' ? ' selected="selected"' : ''; >2018-2019</option>
                          echo('<option value="'.$row["colegiaturaCicloEscolar"].'" >'.$row["cicloEscolar"].'</option>'); 
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
              <?php if ($cInicio==1) { echo'<button type="button" class="crearPago_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-------------------------CREATE ALUMNO MODAL FORM------------------------->
<div class="modal fade" id="registrarAlumno_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un alumno</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarAlumno_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="crearAlumno_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="crearAlumno_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="crearAlumno_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <!-- <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;"> -->
            <!-- INFORMACIÓN ESCOLAR -->
            <h4 class="StepTitle">Información escolar</h4><hr style="margin-top: -10px;">
              
            <div class="row d-flex justify-content-center"> <!-- matricula -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="matricula">Matrícula</label>
                <input type="text" id="crearAlumno_matricula" name="matricula" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- referencia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="referencia">Referencia <span class="required">*</span></label>
                <input type="text" id="crearAlumno_referencia" name="referencia" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- idGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idGrupo">Grupo</label>
                <select id="crearAlumno_idGrupo" name="idGrupo" class="form-control" required="required">
                  <option value=""></option> 
                    <?php 
                    $sqlselect="SELECT idGrupo,CONCAT(generacion,' | ',nivelEscolar,' | ',CONCAT(grado,'-',grupo)) AS grupo FROM grupos WHERE estadoGrupo='Activo' ORDER BY generacion DESC;";
                    try{
                        $stmtselect=$connection->prepare($sqlselect);
                        $stmtselect->execute();
                        $results=$stmtselect->fetchAll();
                    }
                    catch(Exception $ex){
                        echo($ex -> getMessage());
                    }
                    foreach ($results as $output){?>
                      <option value="<?php echo $output["idGrupo"]?>"><?php echo $output["grupo"]?></option>
                    <?php }?>
                </select>
              </div>
            </div>
            
            <div class="container">
              <div class="row">
                
                <!-- INFORMACIÓN DE EMERGENCIAS-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información de emergencias</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- medicoFamiliar -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="medicoFamiliar">Médico familiar</label>
                      <input type="text" id="crearAlumno_medicoFamiliar" name="medicoFamiliar" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- telefonoMF -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="telefonoMF">Teléfono médico familiar</label>
                      <input type="text" id="crearAlumno_telefonoMF" name="telefonoMF" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,15}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- enCasoDeEmergencia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="enCasoDeEmergencia">En caso de emergencia</label>
                      <input type="text" id="crearAlumno_enCasoDeEmergencia" name="enCasoDeEmergencia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>
                  

                <!-- INFORMACIÓN ADICIONAL-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información adicional</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- alergias -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="alergias">Alergias</label>
                      <textarea id="crearAlumno_alergias" name="alergias" rows="5" cols="33" class="form-control "></textarea>
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- cuidadosEspeciales -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="cuidadosEspeciales">Cuidados especiales</label>
                      <textarea id="crearAlumno_cuidadosEspeciales" name="cuidadosEspeciales" rows="5" cols="33" class="form-control "></textarea>
                    </div>
                  </div>
                </div>

                <!-- INFORMACIÓN PERSONAL-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- curp -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="curp">CURP</label>
                      <input type="text" id="crearAlumno_curp" name="curp" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,18}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noSeguro -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noSeguro">No. Seguro</label>
                      <input type="text" id="crearAlumno_noSeguro" name="noSeguro" autocomplete="no" class="form-control" pattern="[0-9]{0,15}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaNacimiento">Fecha de nacimiento</label>
                      <input type="date" id="crearAlumno_fechaNacimiento" name="fechaNacimiento" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="lugarNacimiento">Lugar de nacimiento</label>
                      <input type="text" id="crearAlumno_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- nacionalidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="nacionalidad">Nacionalidad</label>
                      <input type="text" id="crearAlumno_nacionalidad" name="nacionalidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- religion -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="religion">Religión</label>
                      <input type="text" id="crearAlumno_religion" name="religion" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- tipoSangre -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="tipoSangre">Tipo de sangre</label>
                      <select id="crearAlumno_tipoSangre" name="tipoSangre" class="form-control">
                        <option value=""></option>
												<option value="A+">A+</option>
												<option value="A-">A-</option>
												<option value="B+">B+</option>
												<option value="B-">B-</option>
												<option value="AB+">AB+</option>
												<option value="AB-">AB-</option>
												<option value="O+">O+</option>
												<option value="O-">O-</option>
											</select>
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- peso -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="peso">Peso</label>
                      <input type="number" id="crearAlumno_peso" name="peso" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- talla -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="talla">Talla</label>
                      <input type="text" id="crearAlumno_talla" name="talla" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>
                  
                <!-- INFORMACIÓN DE VIVIENDA-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información de vivienda</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- calle -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="calle">Calle</label>
                      <input type="text" id="crearAlumno_calle" name="calle" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- numero -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numero">Número</label>
                      <input type="text" id="crearAlumno_numero" name="numero" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- colonia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="colonia">Colonia</label>
                      <input type="text" id="crearAlumno_colonia" name="colonia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- codigoPostal -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="codigoPostal">Código postal</label>
                      <input type="text" id="crearAlumno_codigoPostal" name="codigoPostal" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- localidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="localidad">Localidad</label>
                      <input type="text" id="crearAlumno_localidad" name="localidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- ciudad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="ciudad">Ciudad</label>
                      <input type="text" id="crearAlumno_ciudad" name="ciudad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estado -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estado">Estado</label>
                      <input type="text" id="crearAlumno_estado" name="estado" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>

                

                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($cInicio==1) { echo'<button type="button" class="crearAlumno_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>










<!-------------------------SALDO MODAL FORM------------------------->
<div class="update_form">
	<div class="modal_container">
		<!-- Modal -->
		<div class="modal fade" id="saldoAlumno_modal" role="dialog">
			<div class="modal-dialog modal-xl">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Añadir pago de alimentos a alumno</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="register_form">
							<form class="form-register" method="post" action="" id="saldoForm" name="signup-form">
								
								<!-- <h2 class="StepTitle">Seleccionar alumno y monto</h2><hr style="margin-top: -10px;"> -->
                <input type="hidden" id="saldo_idPersona" name="idPersona">
							

								<div class="form-group row"> <!-- nombreAlumnoCompleto -->
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombreAlumnoCompleto">Nombre alumno <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_nombreAlumnoCompleto" name="saldo_nombreAlumnoCompleto" required="required" autocomplete="no" class="form-control ">
										<div class="unidad_list">
											<div class="list-group" id="saldoAlumnosDrop_show_list">
											<!-- autocomplete list will be display -->
											</div>
										</div>
									</div>
								</div>

								<!-- nivelEscolar -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nivelEscolar">Nivel escolar
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_nivelEscolarDisabled" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control ">
                    <input type="hidden" id="saldo_nivelEscolar" name="nivelEscolar">
									</div>
								</div>
								<!-- gradoyGrupo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="gradoyGrupo">Grado y grupo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_gradoyGrupoDisabled" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control ">
                    <input type="hidden" id="saldo_gradoyGrupo" name="gradoyGrupo">
									</div>
								</div>
								<!-- saldo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="saldo">Saldo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_saldoDisabled" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
										<input type="hidden" id="saldo_saldo" name="saldo">
									</div>
								</div>

								<h2 class="StepTitle">Monto</h2><hr style="margin-top: -10px;">
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="50" data-toggle="modal" title="Registrar pago" >$50</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="100" data-toggle="modal" title="Registrar pago" >$100</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="150" data-toggle="modal" title="Registrar pago" >$150</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="200" data-toggle="modal" title="Registrar pago" >$200</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="250" data-toggle="modal" title="Registrar pago" >$250</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click(this.value)" value="otraCantidad" data-toggle="modal" title="Registrar pago" >Otra cantidad</button>
								</div>
								
								
								<!-- <button type="submit" id="addSaldo_addSaldo" name="addSaldo" value="addSaldo">Agregar colegiatura</button> -->
								<div class="col modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-------------------------SALDO Trabajador FORM------------------------->
<div class="update_form">
	<div class="modal_container">
		<!-- Modal -->
		<div class="modal fade" id="saldoTrabajador_modal" role="dialog">
			<div class="modal-dialog modal-xl">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Añadir pago de alimentos a trabajador</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="register_form">
							<form class="form-register" method="post" action="" id="saldoTrabajadorForm" name="signup-form">

								<!-- <h4 class="StepTitle">Seleccionar trabajador y monto</h4><hr style="margin-top: -10px;"> -->
                <input type="hidden" id="saldo_idPersona_trabajador" name="idPersona">

								<div class="form-group row"> <!-- nombreTrabajadorCompleto -->
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombreTrabajadorCompleto">Nombre trabajador <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_nombreTrabajadorCompleto" name="saldo_nombreTrabajadorCompleto" required="required" autocomplete="no" class="form-control ">
										<div class="unidad_list" style="z-index: 10;">
											<div class="list-group" id="saldoTrabajadorDrop_show_list">
											<!-- autocomplete list will be display -->
											</div>
										</div>
									</div>
								</div>

								<!-- saldo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="saldo">Saldo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="saldo_saldo_trabajador" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
										<input type="hidden" id="saldo_trabajador" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
									</div>
								</div>

								<h2 class="StepTitle">Monto</h2><hr style="margin-top: -10px;">
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="50" data-toggle="modal" title="Registrar pago" >$50</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="100" data-toggle="modal" title="Registrar pago" >$100</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="150" data-toggle="modal" title="Registrar pago" >$150</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="200" data-toggle="modal" title="Registrar pago" >$200</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="250" data-toggle="modal" title="Registrar pago" >$250</button>
									<button type="button" id="item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="reply_click_trabajador(this.value)" value="otraCantidad" data-toggle="modal" title="Registrar pago" >Otra cantidad</button>
								</div>
								
								
								<!-- <button type="submit" id="addSaldo_addSaldo" name="addSaldo" value="addSaldo">Agregar colegiatura</button> -->
								<div class="col modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-------------------------SALDO DEVOLUCIÓN ALUMNO MODAL FORM------------------------->
<div class="update_form">
	<div class="modal_container">
		<!-- Modal -->
		<div class="modal fade" id="devolucion_saldoAlumno_modal" role="dialog">
			<div class="modal-dialog modal-xl">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Devolver saldo a alumno</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="register_form">
							<form class="form-register" method="post" action="" id="devolucion_saldoForm" name="signup-form">
								
								<!-- <h2 class="StepTitle">Seleccionar alumno y monto</h2><hr style="margin-top: -10px;"> -->
                <input type="hidden" id="devolucion_saldo_idPersona" name="idPersona">
							

								<div class="form-group row"> <!-- nombreAlumnoCompleto -->
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombreAlumnoCompleto">Nombre alumno <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_nombreAlumnoCompleto" name="saldo_nombreAlumnoCompleto" required="required" autocomplete="no" class="form-control ">
										<div class="unidad_list">
											<div class="list-group" id="devolucion_saldoAlumnosDrop_show_list">
											<!-- autocomplete list will be display -->
											</div>
										</div>
									</div>
								</div>

								<!-- nivelEscolar -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nivelEscolar">Nivel escolar
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_nivelEscolarDisabled" name="nivelEscolar" disabled="disabled" autocomplete="no" class="form-control ">
                    <input type="hidden" id="devolucion_saldo_nivelEscolar" name="nivelEscolar">
									</div>
								</div>
								<!-- gradoyGrupo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="gradoyGrupo">Grado y grupo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_gradoyGrupoDisabled" name="gradoyGrupo" disabled="disabled" autocomplete="no" class="form-control ">
                    <input type="hidden" id="devolucion_saldo_gradoyGrupo" name="gradoyGrupo">
									</div>
								</div>
								<!-- saldo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="saldo">Saldo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_saldoDisabled" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
										<input type="hidden" id="devolucion_saldo_saldo" name="saldo">
									</div>
								</div>

								<h2 class="StepTitle">Monto</h2><hr style="margin-top: -10px;">
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="devolucion_item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="devolucionSaldoAlumno(this.value)" value="otraCantidad" data-toggle="modal" title="Registrar pago" >Cantidad a devolver</button>
								</div>
								
								
								<!-- <button type="submit" id="addSaldo_addSaldo" name="addSaldo" value="addSaldo">Agregar colegiatura</button> -->
								<div class="col modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-------------------------SALDO Trabajador FORM------------------------->
<div class="update_form">
	<div class="modal_container">
		<!-- Modal -->
		<div class="modal fade" id="devolucion_saldoTrabajador_modal" role="dialog">
			<div class="modal-dialog modal-xl">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title">Añadir pago de alimentos a trabajador</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="register_form">
							<form class="form-register" method="post" action="" id="devolucion_saldoTrabajadorForm" name="signup-form">

								<!-- <h4 class="StepTitle">Seleccionar trabajador y monto</h4><hr style="margin-top: -10px;"> -->
                <input type="hidden" id="devolucion_saldo_idPersona_trabajador" name="idPersona">

								<div class="form-group row"> <!-- nombreTrabajadorCompleto -->
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombreTrabajadorCompleto">Nombre trabajador <span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_nombreTrabajadorCompleto" name="saldo_nombreTrabajadorCompleto" required="required" autocomplete="no" class="form-control ">
										<div class="unidad_list" style="z-index: 10;">
											<div class="list-group" id="devolucion_saldoTrabajadorDrop_show_list">
											<!-- autocomplete list will be display -->
											</div>
										</div>
									</div>
								</div>

								<!-- saldo -->
								<div class="form-group row">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="saldo">Saldo
									</label>
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="devolucion_saldo_saldo_trabajador" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
										<input type="hidden" id="devolucion_saldo_trabajador" name="saldo" disabled="disabled" autocomplete="no" class="form-control ">
									</div>
								</div>

								<h2 class="StepTitle">Monto</h2><hr style="margin-top: -10px;">
								<div class="col-md-12 d-flex justify-content-center">
									<button type="button" id="devolucion_item_register_btn" style="margin: 10px; font-size: 14px;" class="btn btn-info actionBtn" onClick="devolucionSaldoTrabajador(this.value)" value="otraCantidad" data-toggle="modal" title="Registrar pago" >Otra cantidad</button>
								</div>
								
								
								<!-- <button type="submit" id="devolucion_addSaldo_addSaldo" name="addSaldo" value="addSaldo">Agregar colegiatura</button> -->
								<div class="col modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>









<!-------------------------ADD TO CALENDAR MODAL FORM------------------------->
<div class="modal fade" id="ModalAdd" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Añadir un evento</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="register_form">


          <form class="was-validated form-register" id="crearEvento_modal_Form">
            
          
            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="titulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- start -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="start">Inicio del evento <span class="required">*</span></label>
                <input type="datetime-local" id="start" name="start" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- end -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="end">Fin del evento <span class="required">*</span></label>
                <input type="datetime-local" id="end" name="end" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- notas -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="notas">Notas </label>
                <textarea id="notas" name="notas" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- tipoEvento -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoEvento">Tipo de evento <span class="required">*</span></label>
                <select id="tipoEvento" name="tipoEvento" required="required" class="form-control">
                  <option value=""></option>
                  <option value="Día festivo">Día festivo </option>
                  <option value="Evento escolar">Evento escolar </option>
                  <option value="Actividad escolar">Actividad escolar </option>
                  <option value="Junta">Junta </option>
                  <option value="Otros">Otros</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <?php if ($cInicio==1) { echo'<button type="button" class="addEvent btn btn-primary">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------EDIT EVENT MODAL FORM------------------------->
<div class="modal fade" id="ModalEdit" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Editar un evento</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-horizontal" id="editarEvento_modal_Form">
            
            <div class="row d-flex justify-content-center"> <!-- titulo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="titulo">Título <span class="required">*</span></label>
                <input type="text" id="edittitulo" name="titulo" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- start -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="start">Inicio del evento <span class="required">*</span></label>
                <input type="datetime-local" id="editstart" name="start" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- end -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="end">Fin del evento <span class="required">*</span></label>
                <input type="datetime-local" id="editend" name="end" required="required" autocomplete="no" class="form-control">
              </div>
            </div>
            
            <div class="row d-flex justify-content-center"> <!-- notas -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="notas">Notas </label>
                <textarea id="editnotas" name="notas" rows="5" cols="33" class="form-control "></textarea>
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- tipoEvento -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="tipoEvento">Tipo de evento <span class="required">*</span></label>
                <select id="edittipoEvento" name="tipoEvento" required="required" class="form-control">
                  <option value=""></option>
                  <option value="Día festivo">Día festivo </option>
                  <option value="Evento escolar">Evento escolar </option>
                  <option value="Actividad escolar">Actividad escolar </option>
                  <option value="Junta">Junta </option>
                  <option value="Otros">Otros</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <?php if ($dInicio==1) { echo'<button type="button" class="borrarEvent btn btn-danger actionBtn">Borrar</button>'; } ?>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <?php if ($uInicio==1) { echo'<button type="button" class="editEvent btn btn-primary">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>