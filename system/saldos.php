<?php 
  $nombrePagina="Saldos";
  include_once "auxiliar/sidenav.php";

  try{
    $sqlselect="SELECT nombreRol,c,r,u,d,nombre FROM roles INNER JOIN permisos ON roles.idRol=permisos.idRol INNER JOIN modulos ON permisos.idModulo=modulos.idModulo WHERE nombre = 'Reportes Financieros' AND roles.idRol = ".$_SESSION['idRol'];
    $stmtselect=$connection->prepare($sqlselect);
    $stmtselect->execute();
    $results=$stmtselect->fetchAll();
    
    foreach ($results as $output){
      $c=$output["c"];
      $r=$output["r"];
      $u=$output["u"];
      $d=$output["d"];
    }
    if ($r!=1) {
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
    include_once "auxiliar/footer.php";
      die();
    }
  }
  catch(Exception $ex){
      echo($ex -> getMessage());
  }
?>

  <section class="home-section">
    <div class="home-content" style="justify-content: space-between;">
      <i class='bx bx-menu' ></i>
      <span class="text">Saldos</span>
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
                    <h2>Reporte de saldos de alumnos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <?php //if ($c==1) { echo'<button type="button" class="registrarPago btn btn-primary actionBtn" data-toggle="modal" title="Añadir un pago" >Añadir un pago</button>'; } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id='saldosAlumnosTable' class=" table table-bordered  table-striped  nowrap"  cellspacing="0" style="width: 100%;cursor: auto;">
                        <thead>
                          <tr>
                            <th rowspan="2">idAlumno</th>
                            <th rowspan="2">Alumno</th>
                            <th rowspan="2">Nivel escolar</th>
                            <th rowspan="2">Grado y grupo</th>
                            <th colspan="1">Saldo</th>
                          </tr>
                          <tr>
                            <th>
                              <select id="searchBysaldo" style="width: 100%;height: 24px;color:rgb(121, 117, 117);font: caption;">
                                <option value="">Saldo</option>
                                <option value=">0">Saldo positivo </option>
                                <option value="<=0">Saldo negativo </option>
                              </select>
                            </th>
                          </tr>	
                        </thead>
                        <tfoot>
                          <tr>
                            <th>idAlumno</th>
                            <th>Alumno</th>
                            <th>Nivel escolar</th>
                            <th>Grado y grupo</th>
                            <th>Saldo</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reporte de saldos de trabajadores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <?php //if ($c==1) { echo'<button type="button" class="registrarPago btn btn-primary actionBtn" data-toggle="modal" title="Añadir un pago" >Añadir un pago</button>'; } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id='saldosTrabajadoresTable' class=" table table-bordered  table-striped  nowrap"  cellspacing="0" style="width: 100%;cursor: auto;">
                        <thead>
                          <tr>
                            <th rowspan="2">idTrabajador</th>
                            <th rowspan="2">Nombre</th>
                            <th colspan="1">Saldo</th>
                          </tr>
                          <tr>
                            <th>
                              <select id="TrabajadorsearchBysaldo" style="width: 100%;height: 24px;color:rgb(121, 117, 117);font: caption;">
                                <option value="">Saldo</option>
                                <option value=">0">Saldo positivo </option>
                                <option value="<=0">Saldo negativo </option>
                              </select>
                            </th>
                          </tr>	
                        </thead>
                        <tfoot>
                          <tr>
                            <th>idTrabajador</th>
                            <th>Nombre</th>
                            <th>Saldo</th>
                          </tr>
                        </tfoot>
                      </table>
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
    include "backend/saldos/modals.php";
    // Se incluye el footer y los js sources
    include_once "auxiliar/footer.php";
  ?>
  
  <!-- Custom Theme Scripts -->
  <script src="../build/funciones.js"></script>
  <script src="auxiliar/js.js"></script>
  <script src="backend/saldos/js.js"></script>
</body>
</html>

