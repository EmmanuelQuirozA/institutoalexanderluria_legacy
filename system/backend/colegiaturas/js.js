
var tablesLoaded="";
function fetch_select(cicloEscolar){
  $.ajax({
		type: 'post',
		url: 'backend/colegiaturas/fetch_data.php',
		data: {
			get_option:cicloEscolar.substring(12,21)
		},
		success: function (response) {
      if (tablesLoaded=="") {
        document.getElementById("columns"+cicloEscolar).innerHTML=response; 

        var select = document.getElementById('consultar_cicloEscolar')
        select.removeChild(select.querySelector('option[value=""]'))
        
        tablesLoaded=cicloEscolar;
        table = $('#'+tablesLoaded).DataTable({
          order: [[ 0, "desc" ]],
          "columnDefs": [{
              targets: [ 0,1 ],
              visible: false},
            {"targets":  "_all" ,
              "createdCell": function (td, cellData, rowData, row, col) {
                if ( cellData == null ) {
                  $(td).css('background-color', 'rgb(234 139 139)');
                }
              }
          }],
          scrollX: true,
          processing: true,
          serverSide: true,
          language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            oPaginate: {
              sFirst: "Primero",
              sLast:"Último",
              sNext:"Siguiente",
              sPrevious: "Anterior"
            },
            sProcessing:"Procesando...",
          },
          serverMethod: 'post',
          ajax: {
              url:'backend/colegiaturas_read.php',
              type:"POST",
              'data': function(data){
                data.cicloEscolar=cicloEscolar;
              }
          },
          dom: 'Blfrtip',
          buttons: [
            {
              text: 'Copiar',
              className: 'btn btn-info',
              extend: 'copy'
            },
            {
              extend: 'csv',
              className: 'btn btn-info',
              sheetName: 'Reporte de colegiaturas',
              title: 'Reporte de colegiaturas'
            },
            {
              extend: 'excel',
              className: 'btn btn-info',
              autoFilter: true,
              sheetName: 'Reporte de colegiaturas',
              title: 'Reporte de colegiaturas'
            }
          ]
        });
      }else{
        document.getElementById(tablesLoaded+"_wrapper").style.display = "none";
        tablesLoaded=cicloEscolar;
        if ($('#'+tablesLoaded+"_wrapper").css('display') == 'none') {
          document.getElementById(tablesLoaded+"_wrapper").style.display = "block";
        }else{
          document.getElementById("columns"+cicloEscolar).innerHTML=response; 
          $('#'+tablesLoaded).DataTable({
            order: [[ 0, "desc" ]],
            "columnDefs": [{
                targets: [ 0,1 ],
                visible: false},
              {"targets":  "_all" ,
                "createdCell": function (td, cellData, rowData, row, col) {
                  if ( cellData == null ) {
                    $(td).css('background-color', 'rgb(234 139 139)');
                  }
                }
            }],
            scrollX: true,
            processing: true,
            serverSide: true,
            language: {
              lengthMenu: "Mostrar _MENU_ registros",
              zeroRecords: "No se encontraron resultados",
              info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
              infoFiltered: "(filtrado de un total de _MAX_ registros)",
              sSearch: "Buscar:",
              oPaginate: {
                sFirst: "Primero",
                sLast:"Último",
                sNext:"Siguiente",
                sPrevious: "Anterior"
              },
              sProcessing:"Procesando...",
            },
            serverMethod: 'post',
            ajax: {
                url:'backend/colegiaturas_read.php',
                type:"POST",
                'data': function(data){
                  data.cicloEscolar=cicloEscolar;
                }
            },
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel'
            ]
          });
        }
      }
    }
	});
}
