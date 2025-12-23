<!-------------------------UPDATE TRABAJADOR MODAL FORM------------------------->
<div class="modal fade" id="editarTrabajador_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un trabajador</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="editarTrabajador_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            <input type="hidden" id="editarTrabajador_idTrabajador" name="idTrabajador">
            <input type="hidden" id="editarTrabajador_idPersona" name="idPersona">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="editarTrabajador_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="editarTrabajador_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="editarTrabajador_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <!-- <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;"> -->
            
            <div class="container">
              <div class="row">
                <!-- INFORMACIÓN LABORAL (ACTUAL) -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información laboral (Actual)</h4><hr style="margin-top: -10px;">
                
                  <div class="row d-flex justify-content-center"> <!-- noTrabajador -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noTrabajador">Numero de trabajador</label>
                      <input type="number" id="editarTrabajador_noTrabajador" name="noTrabajador" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaInicioLabores -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaInicioLabores">Fecha de inicio de labores</label>
                      <input type="date" id="editarTrabajador_fechaInicioLabores" name="fechaInicioLabores" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaFinLabores -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaFinLabores">Fecha de fin de labores</label>
                      <input type="date" id="editarTrabajador_fechaFinLabores" name="fechaFinLabores" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- puesto -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="puesto">Puesto</label>
                      <input type="text" id="editarTrabajador_puesto" name="puesto" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- sueldo -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="sueldo">Sueldo</label>
                      <input type="number" id="editarTrabajador_sueldo" name="sueldo" autocomplete="no" class="form-control" step="0.01">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- banco -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="banco">Banco</label>
                      <input type="text" id="editarTrabajador_banco" name="banco" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noCuenta -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noCuenta">Número de cuenta</label>
                      <input type="number" id="editarTrabajador_noCuenta" name="noCuenta" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- referencia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="referencia">Referencia</label>
                      <input type="number" id="editarTrabajador_referencia" name="referencia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
                    </div>
                  </div>

                </div>


                <!-- INFORMACIÓN PERSONAL -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- curp -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="curp">CURP</label>
                      <input type="text" id="editarTrabajador_curp" name="curp" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{18}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- rfc -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="rfc">RFC</label>
                      <input type="text" id="editarTrabajador_rfc" name="rfc" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{13}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noSeguro -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noSeguro">Número de seguro</label>
                      <input type="text" id="editarTrabajador_noSeguro" name="noSeguro" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{11}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaNacimiento">Fecha de nacimiento</label>
                      <input type="date" id="editarTrabajador_fechaNacimiento" name="fechaNacimiento" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="lugarNacimiento">Lugar de nacimiento</label>
                      <input type="text" id="editarTrabajador_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estadoCivil -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estadoCivil">Estado civil</label>
                      <input type="text" id="editarTrabajador_estadoCivil" name="estadoCivil" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- hijos -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="hijos">Hijos</label>
                      <input type="text" id="editarTrabajador_hijos" name="hijos" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>

                </div>

                
                <!-- INFORMACIÓN PERSONAL DE CONTACTO -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal de contacto</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- numeroCel -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numeroCel">Número de celular</label>
                      <input type="number" id="editarTrabajador_numeroCel" name="numeroCel" autocomplete="no" class="form-control" pattern="[0-9]{10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- calle -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="calle">Calle</label>
                      <input type="text" id="editarTrabajador_calle" name="calle" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- numero -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numero">Número</label>
                      <input type="text" id="editarTrabajador_numero" name="numero" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- colonia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="colonia">Colonia</label>
                      <input type="text" id="editarTrabajador_colonia" name="colonia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- codigoPostal -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="codigoPostal">Código postal</label>
                      <input type="text" id="editarTrabajador_codigoPostal" name="codigoPostal" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- localidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="localidad">Localidad</label>
                      <input type="text" id="editarTrabajador_localidad" name="localidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estado -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estado">Estado</label>
                      <input type="text" id="editarTrabajador_estado" name="estado" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>

                </div>

                
                <!-- INFORMACIÓN DE EDUCACIÓN Y LABORAL -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información de educación y laboral</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- egresadoDe -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="egresadoDe">Egresado de la carrera de: </label>
                      <input type="text" id="editarTrabajador_egresadoDe" name="egresadoDe" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- universidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="universidad">Universidad</label>
                      <input type="text" id="editarTrabajador_universidad" name="universidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaEgreso -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaEgreso">Fecha de egreso</label>
                      <input type="date" id="editarTrabajador_fechaEgreso" name="fechaEgreso" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- maestria -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="maestria">Maestría</label>
                      <input type="text" id="editarTrabajador_maestria" name="maestria" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaEgresoMaestria -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaEgresoMaestria">Fecha de egreso de la maestría</label>
                      <input type="date" id="editarTrabajador_fechaEgresoMaestria" name="fechaEgresoMaestria" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- aniosExperienciaLaboral -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="aniosExperienciaLaboral">Años de experiencia laboral</label>
                      <input type="number" id="editarTrabajador_aniosExperienciaLaboral" name="aniosExperienciaLaboral" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>

                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <?php if ($d==1) { echo'<button type="button" class="editarTrabajador_borrarRegistro btn btn-danger actionBtn">Borrar registro</button>'; } ?>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="registrarUsuario btn btn-secondary actionBtn">Crear usuario</button>'; } ?>
              <?php if ($u==1) { echo'<button type="button" class="editarTrabajador_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
              <img src="../src/img/loading.gif" alt="" class="loadingGif">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-------------------------CREATE TRABAJADOR MODAL FORM------------------------->
<div class="modal fade" id="registrarTrabajador_modal" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Dar de alta un trabajador</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="register_form">
          <form class="was-validated form-register" id="registrarTrabajador_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
            
            <!-- INFORMACIÓN BÁSICA Y OBLIGATORIA -->
            <div class="row d-flex justify-content-center"> <!-- nombre -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text" id="crearTrabajador_nombre" name="nombre" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoPaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoPaterno">Apellido paterno <span class="required">*</span></label>
                <input type="text" id="crearTrabajador_apellidoPaterno" name="apellidoPaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <div class="row d-flex justify-content-center"> <!-- apellidoMaterno -->
              <div class="form-group col-md-9 col-sm-6">
                <label for="apellidoMaterno">Apellido materno <span class="required">*</span></label>
                <input type="text" id="crearTrabajador_apellidoMaterno" name="apellidoMaterno" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
              </div>
            </div>

            <!-- <h2 class="StepTitle">Información adicional</h2><hr style="margin-top: -10px;"> -->
            
            <div class="container">
              <div class="row">
                <!-- INFORMACIÓN LABORAL (ACTUAL) -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información laboral (Actual)</h4><hr style="margin-top: -10px;">
                
                  <div class="row d-flex justify-content-center"> <!-- noTrabajador -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noTrabajador">Numero de trabajador</label>
                      <input type="number" id="crearTrabajador_noTrabajador" name="noTrabajador" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaInicioLabores -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaInicioLabores">Fecha de inicio de labores</label>
                      <input type="date" id="crearTrabajador_fechaInicioLabores" name="fechaInicioLabores" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaFinLabores -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaFinLabores">Fecha de fin de labores</label>
                      <input type="date" id="crearTrabajador_fechaFinLabores" name="fechaFinLabores" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- puesto -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="puesto">Puesto</label>
                      <input type="text" id="crearTrabajador_puesto" name="puesto" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- sueldo -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="sueldo">Sueldo</label>
                      <input type="number" id="crearTrabajador_sueldo" name="sueldo" autocomplete="no" class="form-control" step="0.01">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- banco -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="banco">Banco</label>
                      <input type="text" id="crearTrabajador_banco" name="banco" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noCuenta -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noCuenta">Número de cuenta</label>
                      <input type="number" id="crearTrabajador_noCuenta" name="noCuenta" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- referencia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="referencia">Referencia</label>
                      <input type="number" id="crearTrabajador_referencia" name="referencia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,45}">
                    </div>
                  </div>

                </div>


                <!-- INFORMACIÓN PERSONAL -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- curp -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="curp">CURP</label>
                      <input type="text" id="crearTrabajador_curp" name="curp" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{18}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- rfc -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="rfc">RFC</label>
                      <input type="text" id="crearTrabajador_rfc" name="rfc" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{13}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- noSeguro -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="noSeguro">Número de seguro</label>
                      <input type="text" id="crearTrabajador_noSeguro" name="noSeguro" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{11}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaNacimiento">Fecha de nacimiento</label>
                      <input type="date" id="crearTrabajador_fechaNacimiento" name="fechaNacimiento" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- lugarNacimiento -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="lugarNacimiento">Lugar de nacimiento</label>
                      <input type="text" id="crearTrabajador_lugarNacimiento" name="lugarNacimiento" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estadoCivil -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estadoCivil">Estado civil</label>
                      <input type="text" id="crearTrabajador_estadoCivil" name="estadoCivil" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- hijos -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="hijos">Hijos</label>
                      <input type="text" id="crearTrabajador_hijos" name="hijos" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>

                </div>

                
                <!-- INFORMACIÓN PERSONAL DE CONTACTO -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información personal de contacto</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- numeroCel -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numeroCel">Número de celular</label>
                      <input type="number" id="crearTrabajador_numeroCel" name="numeroCel" autocomplete="no" class="form-control" pattern="[0-9]{10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- calle -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="calle">Calle</label>
                      <input type="text" id="crearTrabajador_calle" name="calle" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- numero -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="numero">Número</label>
                      <input type="text" id="crearTrabajador_numero" name="numero" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- colonia -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="colonia">Colonia</label>
                      <input type="text" id="crearTrabajador_colonia" name="colonia" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,70}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- codigoPostal -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="codigoPostal">Código postal</label>
                      <input type="text" id="crearTrabajador_codigoPostal" name="codigoPostal" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,10}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- localidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="localidad">Localidad</label>
                      <input type="text" id="crearTrabajador_localidad" name="localidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- estado -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="estado">Estado</label>
                      <input type="text" id="crearTrabajador_estado" name="estado" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>

                </div>

                
                <!-- INFORMACIÓN DE EDUCACIÓN Y LABORAL -->
                <div class="col-md-6 ">
                  <h4 class="StepTitle">Información de educación y laboral</h4><hr style="margin-top: -10px;">
                  
                  <div class="row d-flex justify-content-center"> <!-- egresadoDe -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="egresadoDe">Egresado de la carrera de: </label>
                      <input type="text" id="crearTrabajador_egresadoDe" name="egresadoDe" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- universidad -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="universidad">Universidad</label>
                      <input type="text" id="crearTrabajador_universidad" name="universidad" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaEgreso -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaEgreso">Fecha de egreso</label>
                      <input type="date" id="crearTrabajador_fechaEgreso" name="fechaEgreso" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- maestria -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="maestria">Maestría</label>
                      <input type="text" id="crearTrabajador_maestria" name="maestria" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9,áÁ,éÉ,íÍ,óÓ,úÚ,ñÑ, ]{0,50}">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- fechaEgresoMaestria -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="fechaEgresoMaestria">Fecha de egreso de la maestría</label>
                      <input type="date" id="crearTrabajador_fechaEgresoMaestria" name="fechaEgresoMaestria" autocomplete="no" class="form-control">
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center"> <!-- aniosExperienciaLaboral -->
                    <div class="form-group col-md-9 col-sm-6">
                      <label for="aniosExperienciaLaboral">Años de experiencia laboral</label>
                      <input type="number" id="crearTrabajador_aniosExperienciaLaboral" name="aniosExperienciaLaboral" autocomplete="no" class="form-control" pattern="[0-9]+">
                    </div>
                  </div>

                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
              <?php if ($c==1) { echo'<button type="button" class="crearTrabajador_guardarCambios btn btn-primary actionBtn">Guardar cambios</button>'; } ?>
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