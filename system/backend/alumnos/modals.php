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
                <label for="matricula">Matrícula </label>
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
              <?php if ($c==1) { echo'<button type="button" class="crearAlumno_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------UPDATE ALUMNO MODAL FORM------------------------->
<div class="modal fade" id="editarAlumno_modal" role="dialog">
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
          <form class="was-validated form-register" id="editarAlumno_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <input type="hidden" id="editarAlumno_idPersona" name="idPersona">
            <input type="hidden" id="editarAlumno_idAlumno" name="idAlumno">

            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="editarAlumno_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="editarAlumno_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="editarAlumno_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-ZáÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>

            <!-- <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;"> -->
            <!-- INFORMACIÓN ESCOLAR -->
            <h4 class="StepTitle">Información escolar</h4><hr style="margin-top: -10px;">
              
            <div class="row d-flex justify-content-center"> <!-- matricula -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="matricula">Matrícula <span class="required">*</span></label>
                <input type="text" id="editarAlumno_matricula" name="matricula" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- referencia -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="referencia">Referencia <span class="required">*</span></label>
                <input type="text" id="editarAlumno_referencia" name="referencia" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
              </div>
            </div>
            <div class="row d-flex justify-content-center"> <!-- idGrupo -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idGrupo">Grupo</label>
                <select id="editarAlumno_idGrupo" name="idGrupo" class="form-control">
                  <option value=""></option> 
                    <?php 
                    $sqlselect="SELECT idGrupo,CONCAT(generacion,' ',nivelEscolar,' ',CONCAT(grado,'-',grupo)) AS grupo FROM grupos WHERE estadoGrupo='Activo' ORDER BY generacion DESC;";
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
                      <input type="text" id="editarAlumno_medicoFamiliar" name="medicoFamiliar" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- telefonoMF -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="telefonoMF">Teléfono médico familiar</label>
                      <input type="text" id="editarAlumno_telefonoMF" name="telefonoMF" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,15}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- enCasoDeEmergencia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="enCasoDeEmergencia">En caso de emergencia</label>
                      <input type="text" id="editarAlumno_enCasoDeEmergencia" name="enCasoDeEmergencia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>
                  

                <!-- INFORMACIÓN ADICIONAL-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información adicional</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- alergias -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="alergias">Alergias</label>
                      <textarea id="editarAlumno_alergias" name="alergias" rows="5" cols="33" class="form-control "></textarea>
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- cuidadosEspeciales -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="cuidadosEspeciales">Cuidados especiales</label>
                      <textarea id="editarAlumno_cuidadosEspeciales" name="cuidadosEspeciales" rows="5" cols="33" class="form-control "></textarea>
                    </div>
                  </div>
                </div>

                <!-- INFORMACIÓN PERSONAL-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- curp -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="curp">CURP</label>
                      <input type="text" id="editarAlumno_curp" name="curp" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,18}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noSeguro -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noSeguro">No. Seguro</label>
                      <input type="text" id="editarAlumno_noSeguro" name="noSeguro" autocomplete="no" class="form-control" pattern="[0-9]{0,15}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaNacimiento">Fecha de nacimiento</label>
                      <input type="date" id="editarAlumno_fechaNacimiento" name="fechaNacimiento" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="lugarNacimiento">Lugar de nacimiento</label>
                      <input type="text" id="editarAlumno_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- nacionalidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="nacionalidad">Nacionalidad</label>
                      <input type="text" id="editarAlumno_nacionalidad" name="nacionalidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- religion -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="religion">Religión</label>
                      <input type="text" id="editarAlumno_religion" name="religion" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- tipoSangre -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="tipoSangre">Tipo de sangre</label>
                      <select id="editarAlumno_tipoSangre" name="tipoSangre" class="form-control">
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
                      <input type="number" id="editarAlumno_peso" name="peso" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- talla -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="talla">Talla</label>
                      <input type="text" id="editarAlumno_talla" name="talla" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>
                  
                <!-- INFORMACIÓN DE VIVIENDA-->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información de vivienda</h4><hr style="margin-top: -10px;">

                  <div class="row d-flex justify-content-center"> <!-- calle -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="calle">Calle</label>
                      <input type="text" id="editarAlumno_calle" name="calle" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- numero -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numero">Número</label>
                      <input type="text" id="editarAlumno_numero" name="numero" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- colonia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="colonia">Colonia</label>
                      <input type="text" id="editarAlumno_colonia" name="colonia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- codigoPostal -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="codigoPostal">Código postal</label>
                      <input type="text" id="editarAlumno_codigoPostal" name="codigoPostal" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- localidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="localidad">Localidad</label>
                      <input type="text" id="editarAlumno_localidad" name="localidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- ciudad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="ciudad">Ciudad</label>
                      <input type="text" id="editarAlumno_ciudad" name="ciudad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estado -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estado">Estado</label>
                      <input type="text" id="editarAlumno_estado" name="estado" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9áÁéÉíÍóÓúÚñÑ, ]{0,45}">
                    </div>
                  </div>
                </div>

                

                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <div class="form-group">
                <label class="control-label" for="update_altaBaja">Dar de alta/baja</label>
                <input id="editarAlumno_cambiarEstado" type="checkbox" class="js-switch" />
              </div>
              <?php if ($d==1) { echo'<button type="button" class="editarAlumno_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="registrarUsuario btn btn-secondary actionBtn">Crear usuario</button>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="editarAlumno_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
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
                <label for="correoElectronico">Correo electrónico <span class="required">*</span></label>
                <input type="email" id="editarUsuario_correoElectronico" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"><!-- idRol -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idRol">Rol <span class="required">*</span></label>
                <select id="editarUsuario_idRol" name="idRol" class="form-control" required>
                  <?php $sqlselect="SELECT idRol,nombreRol FROM roles WHERE nombreRol='Alumno';";
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
                <label for="correoElectronico">Correo electrónico <span class="required">*</span></label>
                <input type="email" id="crearUsuario_correoElectronico" required="required" autocomplete="no" class="form-control">
              </div>
            </div>

            <div class="row d-flex justify-content-center"><!-- idRol -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="idRol">Rol <span class="required">*</span></label>
                <select id="crearUsuario_idRol" name="idRol" class="form-control" required>
                  <?php $sqlselect="SELECT idRol,nombreRol FROM roles WHERE nombreRol='Alumno';";
                  try{$stmtselect=$connection->prepare($sqlselect); $stmtselect->execute();$results=$stmtselect->fetchAll();}catch(Exception $ex){echo($ex -> getMessage());}foreach ($results as $output){?>
                  <option value="<?php echo $output["idRol"]?>"><?php echo $output["nombreRol"]?></option> <?php }?>
                </select>
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