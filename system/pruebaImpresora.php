<?php 
  $nombrePagina="Prueba de impresora";
  include_once "auxiliar/sidenav.php";
?>

  <section class="home-section">
    <div class="home-content" style="justify-content: space-between;">
      <i class='bx bx-menu' ></i>
      <span class="text">Prueba de impresora térmica</span>
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
                  <h2>Prueba de conexión</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p class="mb-3">
                    Envía un solo renglón a la impresora térmica para validar la conexión. 
                    Usa la 80mm Series Printer con el driver sprt-printer.
                  </p>

                  <form id="printerTestForm" autocomplete="off">
                    <div class="form-group">
                      <label for="printerSelector">Impresora</label>
                      <select id="printerSelector" class="form-control" required>
                        <option selected disabled>Cargando impresoras...</option>
                      </select>
                      <small class="form-text text-muted">
                        Se muestran las impresoras detectadas en el sistema operativo.
                      </small>
                    </div>

                    <div class="form-group">
                      <label for="testLine">Renglón de prueba</label>
                      <input 
                        type="text" 
                        class="form-control" 
                        id="testLine" 
                        name="testLine" 
                        value="Prueba de conexión - 80mm Series Printer (driver sprt-printer)"
                        maxlength="200"
                      >
                      <small class="form-text text-muted">
                        Solo se imprimirá este renglón en la impresora seleccionada.
                      </small>
                    </div>

                    <button type="submit" class="btn btn-primary" id="sendTest">
                      Imprimir línea de prueba
                    </button>
                  </form>

                  <div id="printerTestFeedback" class="mt-3"></div>
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

  <script>
    (function() {
      const printerSelector = $('#printerSelector');
      const feedback = $('#printerTestFeedback');
      const defaultLine = 'Prueba de conexión - 80mm Series Printer (driver sprt-printer)';

      function guardarImpresoraSeleccionada(nombre) {
        if (nombre) {
          localStorage.setItem('selectedPrinter', nombre);
        }
      }

      function obtenerImpresoraGuardada() {
        return localStorage.getItem('selectedPrinter') || '';
      }

      function mostrarMensaje(tipo, mensaje) {
        const alertClass = tipo === 'success' ? 'alert-success' : 'alert-danger';
        feedback.html(
          '<div class="alert '+ alertClass +' mb-0" role="alert">'+ mensaje +'</div>'
        );
      }

      function cargarImpresorasDisponibles() {
        if (!printerSelector.length) {
          return;
        }

        printerSelector
          .prop('disabled', true)
          .html('<option selected disabled>Cargando impresoras...</option>');

        $.ajax({
          url:"backend/home/printers.php",
          type:"GET",
          dataType:"json",
          success: function(response){
            printerSelector.empty();
            const printers = response.printers || [];
            if (printers.length === 0) {
              printerSelector.append('<option value=\"\">No se detectaron impresoras</option>');
              return;
            }

            printerSelector.append('<option value=\"\">Selecciona una impresora</option>');
            printers.forEach(function(printerName){
              const cleanName = printerName.trim();
              printerSelector.append('<option value=\"'+cleanName+'\">'+cleanName+'</option>');
            });

            const storedPrinter = obtenerImpresoraGuardada();
            if (storedPrinter && printers.includes(storedPrinter)) {
              printerSelector.val(storedPrinter);
            } else if (printers.length === 1) {
              printerSelector.val(printers[0]);
              guardarImpresoraSeleccionada(printers[0]);
            }
          },
          error: function(){
            printerSelector.html('<option value=\"\">No se pudieron cargar las impresoras</option>');
          },
          complete: function(){
            printerSelector.prop('disabled', false);
          }
        });
      }

      $(document).ready(function(){
        cargarImpresorasDisponibles();

        printerSelector.on('change', function(){
          guardarImpresoraSeleccionada($(this).val());
        });

        $('#printerTestForm').on('submit', function(event){
          event.preventDefault();
          const printer = printerSelector.val();
          const linea = ($('#testLine').val() || defaultLine).trim() || defaultLine;

          if (!printer) {
            mostrarMensaje('error', 'Selecciona una impresora para continuar.');
            return;
          }

          feedback.html('<div class="alert alert-info mb-0" role="alert">Enviando prueba de impresión...</div>');
          $('#sendTest').prop('disabled', true);

          $.ajax({
            url: 'backend/printer/testPrint.php',
            method: 'POST',
            dataType: 'json',
            data: {
              nombre_impresora: printer,
              texto: linea
            },
            success: function(response){
              const status = response.status || 'error';
              const message = response.message || 'Prueba enviada.';
              mostrarMensaje(status === 'success' ? 'success' : 'error', message);
            },
            error: function(xhr){
              const message = xhr.responseJSON && xhr.responseJSON.message
                ? xhr.responseJSON.message
                : 'No se pudo enviar la prueba de impresión.';
              mostrarMensaje('error', message);
            },
            complete: function(){
              $('#sendTest').prop('disabled', false);
            }
          });
        });
      });
    })();
  </script>
  
  <!-- Custom Theme Scripts -->
</body>
</html>
