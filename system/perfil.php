<?php 
  $nombrePagina="Perfil";
  include_once "auxiliar/sidenav.php";

  
  $sqlselect="SELECT * FROM trabajadores t 
  INNER JOIN personas p ON t.idPersona=p.idPersona 
  INNER JOIN usuarios u ON t.idPersona=u.idPersona
  INNER JOIN roles r ON  u.idRol=r.idRol WHERE t.idPersona = ".$_SESSION['idPersona'];
  $stmtselect=$connection->prepare($sqlselect);
  $stmtselect->execute();
  $results=$stmtselect->fetchAll();
  
  foreach ($results as $output){
    $nombre=$output["nombre"];
    $apellidoPaterno=$output["apellidoPaterno"];
    $apellidoMaterno=$output["apellidoMaterno"];
    $aniosExperienciaLaboral=$output["aniosExperienciaLaboral"];
    $banco=$output["banco"];
    $calle=$output["calle"];
    $codigoPostal=$output["codigoPostal"];
    $colonia=$output["colonia"];
    $curp=$output["curp"];
    $egresadoDe=$output["egresadoDe"];
    $estado=$output["estado"];
    $estadoCivil=$output["estadoCivil"];
    $fechaEgreso=$output["fechaEgreso"];
    $fechaEgresoMaestria=$output["fechaEgresoMaestria"];
    $fechaFinLabores=$output["fechaFinLabores"];
    $fechaInicioLabores=$output["fechaInicioLabores"];
    $fechaNacimiento=$output["fechaNacimiento"];
    $hijos=$output["hijos"];
    $idPersona=$output["idPersona"];
    $idTrabajador=$output["idTrabajador"];
    $localidad=$output["localidad"];
    $lugarNacimiento=$output["lugarNacimiento"];
    $maestria=$output["maestria"];
    $noCuenta=$output["noCuenta"];
    $noSeguro=$output["noSeguro"];
    $noTrabajador=$output["noTrabajador"];
    $numero=$output["numero"];
    $numeroCel=$output["numeroCel"];
    $puesto=$output["puesto"];
    $referencia=$output["referencia"];
    $rfc=$output["rfc"];
    $saldo=$output["saldo"];
    $sueldo=$output["sueldo"];
    $universidad=$output["universidad"];
    $correoElectronico=$output["correoElectronico"];
    $nombreRol=$output["nombreRol"];
  }
?>

  <section class="home-section">
    <div class="home-content" style="justify-content: space-between;">
      <i class='bx bx-menu' ></i>
      <span class="text">Perfil</span>
      <?php 
        include_once "auxiliar/options.php";
      ?>
    </div>

    <div class="container body" style="margin-bottom: -12px;">
      <div class="main_container">
          
        <div class="right_col" role="main" >

          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Perfil</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <button type="button" class="editarContrasena btn btn-primary actionBtn" data-toggle="modal" title="Cambiar contraseña" >Cambiar contraseña</button>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <ul class="nav options nav-tabs bar_tabs" id="myTab" role="tablist" style="display: flex;">
                    <li class="nav-item">
                      <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Usuario</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Cuenta</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contáctanos</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent" style="margin-top: 12px;">
                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                      
                      <h2 class="StepTitle">Información general</h2><hr style="margin-top: -10px;">

                      <div class="form-group row"><!-- cliente -->
                        
                        <div class="form-group col-md-4 col-sm-6">
                          <label for="nombre">Nombre:</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $nombre?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                          <label for="apellidoPaterno">Apellido paterno:</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $apellidoPaterno?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                          <label for="apellidoMaterno">Apellido Materno:</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $apellidoMaterno?>">
                        </div>

                      </div>

                      <h2 class="StepTitle">Información de contacto</h2><hr style="margin-top: -10px;">

                      <div class="form-group row">
                        <div class="form-group col-md-6 col-sm-6">
                          <label for="numero">Numero telefónico:</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $numeroCel?>">
                        </div>

                        <div class="form-group col-md-6 col-sm-6">
                          <label for="correo">Correo electrónico:</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $correoElectronico?>">
                        </div>
                      </div>

                      <h2 class="StepTitle">Información laboral</h2><hr style="margin-top: -10px;">
                      
                      <div class="form-group row">
                      
                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_puesto -->
                          <label for="trabajadores_puesto">Puesto</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $puesto?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_fechaInicioLabores -->
                          <label for="trabajadores_fechaInicioLabores">Fecha Inicio Labores</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $fechaInicioLabores?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_fechaFinLabores -->
                          <label for="trabajadores_fechaFinLabores">Fecha fin Labores</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $fechaFinLabores?>">
                        </div>
                      </div>

                      <h2 class="StepTitle">Información general</h2><hr style="margin-top: -10px;">

                      <div class="form-group row">
                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_fechaNacimiento -->
                          <label for="trabajadores_fechaNacimiento">Fecha nacimiento</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $fechaNacimiento?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_lugarNacimiento -->
                          <label for="trabajadores_lugarNacimiento">Lugar de nacimiento</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $lugarNacimiento?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_CURP -->
                          <label for="trabajadores_CURP">CURP</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $curp?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_RFC -->
                          <label for="trabajadores_RFC">RFC</label>
                          <input type="text" class="form-control " disabled="disabled" value="<?php echo $rfc?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_noSeguro -->
                          <label for="trabajadores_noSeguro">No. Seguro Social</label>
                          <input type="text" class="form-control " disabled="disabled" value="<?php echo $noSeguro?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"><!-- trabajadores_estadoCivil -->
                          <label for="trabajadores_estadoCivil">Estado Civil</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $estadoCivil?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_hijos -->
                          <label for="trabajadores_hijos">Hijos</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $hijos?>">
                        </div>
                      </div>

                      <h2 class="StepTitle">Información de contacto y dirección</h2><hr style="margin-top: -10px;">
                      
                      <div class="form-group row">
                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_correoElectronico -->
                          <label for="trabajadores_correoElectronico">Correo electrónico</label>
                          <input type="email" class="form-control" disabled="disabled" value="<?php echo $correoElectronico?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_numeroCel -->
                          <label for="trabajadores_numeroCel">Teléfono</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $numeroCel?>">
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_calle -->
                          <label for="trabajadores_calle">Calle</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $calle?>" >
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_numero -->
                          <label for="trabajadores_numero">Numero</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $numero?>" >
                        </div>
                        
                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_colonia -->
                          <label for="trabajadores_colonia">Colonia</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $colonia?>" >
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_codigoPostal -->
                          <label for="trabajadores_codigoPostal">Codigo postal</label>
                          <input type="text" class="form-control" disabled="disabled" value="<?php echo $codigoPostal?>" >
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_localidad -->
                          <label for="trabajadores_localidad">Localidad</label>
                          <input type="text" class="form-control"  disabled="disabled" value="<?php echo $localidad?>" >
                        </div>

                        <div class="form-group col-md-4 col-sm-6"> <!-- trabajadores_estado -->
                          <label for="trabajadores_estado">Estado</label>
                          <input type="text" class="form-control"  disabled="disabled" value="<?php echo $estado?>" >
                        </div>
                      </div>

                      <div class="modal-footer">
                        <!-- <button type="button" style="font-size: 10px;" class="guardarCambios btn btn-primary">Guardar cambios</button> -->
                      </div>
                    </div>
                    
                    <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <h2 class="StepTitle">Información de la cuenta</h2> <hr style="margin-top: -10px;">
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="tab-content ntTabContent">
                            <h4 class="StepTitle">Rol de usuario: <small><?php echo $nombreRol ?></small> </h4> 
                            <div class="col" style="margin-bottom: 20px;">Descrpición: 
                                Los permisos y roles son configurados por el administrador. Para dudas o aclaraciones, contacte a su administrador para que realize las modificaciones necesarias si es necesario.
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="container">
                        <section class="mb-4">

                          <!--Section description-->
                          <!-- <p class="text-center w-responsive mx-auto mb-5">¿Tienes alguna pregunta? Por favor, no dudes en contactarnos. Nuestro equipo se pondrá en contacto contigo lo más pronto posible.</p> -->

                          <div class="row justify-content-md-center">
                            <!--Grid column-->
                            <div class="col-md-9 mb-md-0 mb-5">
                              <div class="wrapper">
                                <div class="modal-header">
                                  <h3 class="modal-title">¿Tienes alguna pregunta? <br> Por favor, no dudes en contactarnos. Nuestro equipo se pondrá en contacto contigo lo más pronto posible.</h3>
                                </div>
                                <div class="modal-body">
                                  <div class="register_form">
                                    <form class="was-validated form-register" id="editarUsuario_modal_Form" method="post" action="" onkeydown="return event.key != 'Enter';" name="signup-form">
                                                
                                      <div class="row d-flex justify-content-center"> <!-- name -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="name">Nombre <span class="required">*</span></label>
                                          <input type="text" id="name" name="name" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
                                        </div>
                                      </div>
                                      <div class="row d-flex justify-content-center"> <!-- email -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="email">Correo electrónico <span class="required">*</span></label>
                                          <input type="email" id="email" name="email" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
                                        </div>
                                      </div>
                                      <div class="row d-flex justify-content-center"> <!-- phone -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="phone">Número telefónico <span class="required">*</span></label>
                                          <input type="number" id="phone" name="phone" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
                                        </div>
                                      </div>
                                      <div class="row d-flex justify-content-center"> <!-- subject -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="subject">Asunto <span class="required">*</span></label>
                                          <input type="subject" id="subject" name="subject" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
                                        </div>
                                      </div>
                                      <div class="row d-flex justify-content-center"> <!-- subject -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="subject">Asunto <span class="required">*</span></label>
                                          <input type="subject" id="subject" name="subject" required="required" autocomplete="no" class="form-control" pattern="[a-zA-Z0-9]+">
                                        </div>
                                      </div>
                                      <div class="row d-flex justify-content-center"> <!-- message -->
                                        <div class="form-group col-md-9 col-sm-6">
                                          <label for="message">Escribe tu mensaje <span class="required">*</span></label>
                                          <textarea id="message" name="message" rows="5" cols="33" required="required" class="form-control "></textarea>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary actionBtn">Enviar mensaje</button>
                                      </div>

                                    </form>
                                  </div>
                                </div>

                              </div>
                              <div class="text-center text-md-left">
                                  <!-- <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Enviar<i class="fas fa-angle-double-right ms-2"></i></a> -->
                              </div>
                              <div class="status"></div>
                            </div>
                          </div>
                        </section>
                        <!--Section: Contact v.2-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h5>Aviso de privacidad</h5>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <span>La protección de datos personales es un derecho humano que le da a los individuos el poder de controlar la información que comparten con terceros, así como el derecho 
                    a que ésta se utilice de forma adecuada, para permitir el ejercicio de otros derechos y evitar daños a su Titular.</span>
                  <br> 
                  <span style="margin-top: 12px;display: block;">Se informa que no realizarán transferencias que requieran su consentimiento, salvo aquellas que sean necesarias para atender requerimientos de información de una autoridad competente, debidamente fundados y motivados. Cualquier otro elemento o documento que facilite la localización de los datos personales, en su caso.</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        

      </div>
    </div>
    
    
  </section>

  <?php 
    // Se incluyen los modales
    include "backend/perfil/modals.php";
    // Se incluye el footer y los js sources
    include_once "auxiliar/footer.php";
  ?>
  
  <!-- Custom Theme Scripts -->
  <script src="../build/funciones.js"></script>
  <script src="auxiliar/js.js"></script>
  <script src="backend/perfil/js.js"></script>
</body>
</html>

