<?php 
  $nombrePagina="Inicio";
  include_once "auxiliar/sidenav.php";

  try{
    $sqlselect="SELECT nombreRol,c,r,u,d,nombre FROM roles INNER JOIN permisos ON roles.idRol=permisos.idRol INNER JOIN modulos ON permisos.idModulo=modulos.idModulo WHERE nombre = 'Inicio' AND roles.idRol = ".$_SESSION['idRol'];
    $stmtselect=$connection->prepare($sqlselect);
    $stmtselect->execute();
    $results=$stmtselect->fetchAll();
    
    foreach ($results as $output){
      $c=$output["c"];
      $r=$output["r"];
      $u=$output["u"];
      $d=$output["d"];
    }
    if ($rInicio!=1) {
      echo '
    <section class="home-section" >
      <div class="home-content">
        <i class="bx bx-menu" ></i>
      </div>
      <div class="col-md-6 card" style="margin-left: auto;margin-right: auto;">
        <div class="thumb-wrapper">
          <div class="thumb-content">
            <h4>¡No tienes permisos para ver esta página :( !</h4>
            <span>Por favor, contacta a tu administrador para más información</span>
          </div>						
        </div>
      </div>
    </section>';
    header('Location: ../index.html');
    session_destroy();
    exit;
    }
  }
  catch(Exception $ex){
      echo($ex -> getMessage());
  }
?>

  <section class="home-section">
    <div class="home-content" style="justify-content: space-between;">
      <i class='bx bx-menu' ></i>
      <span class="text">Sistema Instituto Alexander Luria <small>Tickets</small></span>
      <?php 
        include_once "auxiliar/options.php";
      ?>
    </div>

    <div class="container body">
      <div class="main_container">
          
        <div class="right_col" role="main" >
          <div class="">
            <!-- <div class="page-title">
              <div class="title_left">
                <h3>Pagos</h3>
              </div>
            </div> -->

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inicio</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-top: 14px;">
                      <?php if ($cInicio==1) { 
                      echo'
                        <div class="small_panel_toolbox dropdown show">
                          <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                          </a>
                        
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      '; if ($cInicio==1) { echo'
                            <a class="dropdown-item registrarPago">Registrar pago</a>
                            <a class="dropdown-item registrarSaldoAlumnos">Registrar saldo alumnos</a>
                            <a class="dropdown-item registrarSaldoTrabajadores">registrar saldo trabajadores</a>
                      '; }; if ($dInicio==1) { echo'
                            <a class="dropdown-item devolverSaldoAlumno">Devolver saldo alumnos</a>
                            <a class="dropdown-item devolverSaldoTrabajador">Devolver saldo trabajadores</a>
                      '; } echo'
                      
                          </div>
                        </div>

                      '; if ($cInicio==1) { echo'
                        <button type="button" class="large_panel_toolbox registrarPago btn btn-info actionBtn" data-toggle="modal" title="Añadir pago escolar" style="margin-left: 10px; font-size: 14px;">Añadir pago escolar</button>
                        <button type="button" class="large_panel_toolbox registrarSaldoAlumnos btn btn-info actionBtn" data-toggle="modal" title="Agregar saldo de alimentos alumnos" style="margin-left: 10px; font-size: 14px;">Agregar saldo de alimentos alumnos</button>
                        <button type="button" class="large_panel_toolbox registrarSaldoTrabajadores btn btn-info actionBtn" data-toggle="modal" title="Agregar saldo de alimentos trabajadores" style="margin-left: 10px; font-size: 14px;">Agregar saldo de alimentos trabajadores</button>
                      '; }; if ($dInicio==1) { echo'
                        <button type="button" class="large_panel_toolbox devolverSaldoAlumno btn btn-info actionBtn" data-toggle="modal" title="Devolver saldo alumnos" style="margin-left: 10px; font-size: 14px;">Devolver saldo alumnos</button>
                        <button type="button" class="large_panel_toolbox devolverSaldoTrabajador btn btn-info actionBtn" data-toggle="modal" title="Devolver saldo trabajadores" style="margin-left: 10px; font-size: 14px;">Devolver saldo trabajadores</button>
                      '; } 
                       } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row animations">
							<div class="col" style="margin-bottom: 10px; overflow: hidden;">
								<div class="headerTutores">
									
									<div class="col-md-12 h-100 d-table justify-content-center" style="z-index: 19;">
											<hr>
										<div class="d-table-cell align-middle">
											<h4 style="color: white; font-size:calc(1em + 1vw);">Bienvenid@ <?php echo $_SESSION['nombreCompleto']?></h4>
											<h1 style="color: white; font-size:calc(1.5em + 1.5vw);">al sistema del Instituto Alexander Luria para administradores</h1>
											<h4 style="color: white; font-size:calc(.5em + 1vw);">Rol de usuario: <?php echo $_SESSION['nombreRol']?></h4>
										</div>
									</div>
				

									
									<!-- partial:index.partial.html -->
									<div class="arrow arrow--top">
										<svg xmlns="http://www.w3.org/2000/svg" width="270.11" height="649.9" overflow="visible">
											<style>.geo-arrow{fill:none;stroke:#fff;stroke-width:2;stroke-miterlimit:10}</style>
											<g class="item-to bounce-1">
												<path class="geo-arrow draw-in" d="M135.06 142.564L267.995 275.5 135.06 408.434 2.125 275.499z"></path>
											</g>
											<circle class="geo-arrow item-to bounce-2" cx="194.65" cy="69.54" r="7.96"></circle>
											<circle class="geo-arrow draw-in" cx="194.65" cy="39.5" r="7.96"></circle>
											<circle class="geo-arrow item-to bounce-3" cx="194.65" cy="9.46" r="7.96"></circle>
											<g class="geo-arrow item-to bounce-2">
												<path class="st0 draw-in" d="M181.21 619.5l13.27 27 13.27-27zM194.48 644.5v-552"></path>
											</g>
										</svg>
									</div>
									<div class="arrow arrow--bottom">
										<svg xmlns="http://www.w3.org/2000/svg" width="31.35" height="649.9" overflow="visible">
											<style>.geo-arrow{fill:none;stroke:#fff;stroke-width:2;stroke-miterlimit:10}</style>
											<g class="item-to bounce-1">
												<circle class="geo-arrow item-to bounce-3" cx="15.5" cy="580.36" r="7.96"></circle>
												<circle class="geo-arrow draw-in" cx="15.5" cy="610.4" r="7.96"></circle>
												<circle class="geo-arrow item-to bounce-2" cx="15.5" cy="640.44" r="7.96"></circle>
												<g class="item-to bounce-2">
													<path class="geo-arrow draw-in" d="M28.94 30.4l-13.26-27-13.27 27zM15.68 5.4v552"></path>
												</g>
											</g>
										</svg>
									</div>
									<div class="main" style="top:-264px;">
										<div class="main__text-wrapper">    
											<svg xmlns="http://www.w3.org/2000/svg" class="dotted-circle" width="352" height="352" overflow="visible">
												<circle cx="176" cy="176" r="174" fill="none" stroke="#fff" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="12.921,11.9271"></circle>
											</svg>
										</div>
									</div>
								</div>
							</div>
						</div>

            <div class="row">
              <div class="col-md-6 col-sm-12  ">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Reporte de recargas de saldos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <?php //if ($c==1) { echo'<button type="button" class="registrarPersona btn btn-primary actionBtn" data-toggle="modal" title="Añadir una recarga de saldo" >Añadir una recarga de saldo</button>'; } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id='recargasSaldoTable' class=" table table-bordered  table-striped  nowrap"  cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th rowspan="2">idRecargasSaldo</th>
                          <th rowspan="2">idPersona</th>
                          <th rowspan="2">idUsuario</th>
                          <th colspan="1">Nombre</th>
                          <th colspan="1">Tipo de persona</th>
                          <th colspan="1">Monto</th>
                          <th colspan="1">Fecha</th>
                          <th colspan="1">Usuario que registró</th>
                        </tr>
                        <tr>
													<th><input type="text" placeholder="Nombre" id="searchBynombreCompletoRS" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Tipo de persona" id="searchBytipoPersona" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Monto" id="searchBymonto" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Fecha" id="searchByfecha" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Usuario que registró" id="searchByusername" class="filter" style="height: 24px;" ></th>
												</tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reportes de pagos</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id='pagosTable' class=" table table-bordered  table-striped  nowrap"  cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th rowspan="2">idPago</th>
                          <th rowspan="2">idColegiatura</th>
                          <th rowspan="2">idAlumno</th>
                          <th rowspan="2">idUsuario</th>
                          <th rowspan="2">nombre</th>
                          <th rowspan="2">apellidoPaterno</th>
                          <th rowspan="2">apellidoMaterno</th>
                          <th colspan="1">Nombre</th>
                          <th colspan="1">Usuario</th>
                          <th colspan="1">Nivel escolar</th>
                          <th colspan="1">Grado y grupo</th>
                          <th colspan="1">Referencia</th>
                          <th colspan="1">Concepto</th>
                          <th colspan="1">Monto</th>
                          <th colspan="1">Fecha de registro</th>
                          <th colspan="1">Fecha de pago</th>
                          <th colspan="1">Forma de pago</th>
                          <th rowspan="2">Estatus del pago</th>
                          <th rowspan="2">Comprobante</th>
                          <th colspan="1">Ciclo escolar</th>
                          <th colspan="1">Mes de colegiatura</th>
                          <th colspan="1">Observaciones</th>
                          <th colspan="1">Folio</th>
                        </tr>
                        <tr>
                          <th><input type="text" placeholder="Nombre" id="searchBynombreCompleto" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Usuario" id="searchByusername" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Nivel escolar" id="searchBynivelEscolar" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Grado y grupo" id="searchBygradoyGrupo" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Referencia" id="searchByreferencia" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Concepto" id="searchByconcepto" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Monto" id="searchBymonto" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Fecha de registro" id="searchByfechaRegistro" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Fecha de pago" id="searchByfechaPago" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Forma de pago" id="searchByformaPago" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Ciclo escolar" id="searchBycicloEscolar" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Mes de colegiatura" id="searchBymesColegiatura" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Observaciones" id="searchByobservaciones" class="filter" style="height: 24px;" ></th>
													<th><input type="text" placeholder="Folio" id="searchByfolio" class="filter" style="height: 24px;" ></th>
												</tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Calendario</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 widget_tally_box" >
                      <div class="fixed_height_390">
                        <div class="x_content">
                          <div class="container">
                            <div id="calendar"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
    include "backend/home/modals.php";
    // Se incluye el footer y los js sources
    include_once "auxiliar/footer.php";
  ?>
  


  


  
  <script src="../build/funciones.js"></script>
  <script src="auxiliar/js.js"></script>
  <script src="backend/home/js.js"></script>

  <script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/lib/moment.min.js"></script>
  <script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/fullcalendar.min.js"></script>
  <script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/locale/es.js"></script>
  </body>
</html>