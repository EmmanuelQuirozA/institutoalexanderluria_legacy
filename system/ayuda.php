<?php 
  $nombrePagina="Ayuda";
  include_once "auxiliar/sidenav.php";
?>

  <section class="home-section">
    <div class="home-content" style="justify-content: space-between;">
      <i class='bx bx-menu' ></i>
      <span class="text">Ayuda</span>
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
                  <h2>Ayuda</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <ul class="nav options nav-tabs bar_tabs" id="myTab" role="tablist" style="display: flex;">
                    <li class="nav-item">
                      <a class="nav-link active" id="pagos-tab" data-toggle="tab" href="#pagos" role="tab" aria-controls="pagos" aria-selected="true">Finanzas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="alumnos" aria-selected="false">Alumnos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tutores-tab" data-toggle="tab" href="#tutores" role="tab" aria-controls="tutores" aria-selected="false">Tutores</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="trabajadores-tab" data-toggle="tab" href="#trabajadores" role="tab" aria-controls="trabajadores" aria-selected="false">Trabajadores</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="cocina-tab" data-toggle="tab" href="#cocina" role="tab" aria-controls="cocina" aria-selected="false">Cocina</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="inventarios-tab" data-toggle="tab" href="#inventarios" role="tab" aria-controls="inventarios" aria-selected="false">Inventarios</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="materialDidactico-tab" data-toggle="tab" href="#materialDidactico" role="tab" aria-controls="materialDidactico" aria-selected="false">Material didáctico</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent" style="margin-top: 12px;">
                    <div class="tab-pane fade show active" id="pagos" role="tabpanel" aria-labelledby="pagos-tab">
                      pagos
                    </div>
                    
                    <div class="tab-pane fade " id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                      alumnos
                    </div>
                    
                    <div class="tab-pane fade " id="tutores" role="tabpanel" aria-labelledby="tutores-tab">
                      tutores
                    </div>

                    <div class="tab-pane fade" id="trabajadores" role="tabpanel" aria-labelledby="trabajadores-tab">
                      trabajadores
                    </div>

                    <div class="tab-pane fade" id="cocina" role="tabpanel" aria-labelledby="cocina-tab">
                      cocina
                    </div>

                    <div class="tab-pane fade" id="inventarios" role="tabpanel" aria-labelledby="inventarios-tab">
                      inventarios
                    </div>

                    <div class="tab-pane fade" id="materialDidactico" role="tabpanel" aria-labelledby="materialDidactico-tab">
                      materialDidactico
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
    // Se incluye el footer y los js sources
    include_once "auxiliar/footer.php";
  ?>
  
  <!-- Custom Theme Scripts -->
</body>
</html>

