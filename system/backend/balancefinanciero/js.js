/*--------------------------------VARIABLES EGRESOS--------------------------------*/
var egresosTable;
var egresosArray = [];
var egresosText;
var estatusEgreso;

var comprobantePath;

var idsEgresos = [ 
  '#searchByreferencia',
  '#searchByreceptor',
  '#searchByconcepto',
  '#searchBytipoGasto',
  '#searchByprecioUnitario',
  '#searchBycantidad',
  '#searchBytotal',
  '#searchByunidad',
  '#searchByfechaRegistro',
  '#searchByfechaPago',
  '#searchByformaPago',
  '#searchByobservaciones',
  '#searchByfolio',
  '#searchByestatusEgreso',
  '#searchByusername',
  '#searchByfechaAprobado'
];


/*--------------------------------VARIABLES INGRESOS--------------------------------*/
var ingresosTable;
var ingresosArray = [];
var ingresosText;

var idsIngresos = [ 
  '#searchBytipoIngreso',
  '#searchBydescripcion',
  '#searchByfecha',
  '#searchBymonto'
];


/*--------------------------------VARIABLES VENTAS DE COCINA--------------------------------*/
var TableTrabajadores;

/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
  // -----------------------------------------------------------------------------------------------------TABLA DE EGRESOS-----------------------------------------------------------------------------------------------------
  egresosTable = $('#egresosTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,15,16 ],
			visible: false
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
		}
		,
		serverMethod: 'post',
		ajax: {
			url:'backend/balanceEgresos_Read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchByreferencia = $('#searchByreferencia').val();
        var searchByreceptor = $('#searchByreceptor').val();
        var searchByconcepto = $('#searchByconcepto').val();
        var searchBytipoGasto = $('#searchBytipoGasto').val();
        var searchByprecioUnitario = $('#searchByprecioUnitario').val();
        var searchBycantidad = $('#searchBycantidad').val();
        var searchBytotal = $('#searchBytotal').val();
        var searchByunidad = $('#searchByunidad').val();
        var searchByfechaRegistro = $('#searchByfechaRegistro').val();
        var searchByfechaPago = $('#searchByfechaPago').val();
        var searchByformaPago = $('#searchByformaPago').val();
        var searchByobservaciones = $('#searchByobservaciones').val();
        var searchByfolio = $('#searchByfolio').val();
        var searchByestatusEgreso = $('#searchByestatusEgreso').val();
        var searchByusername = $('#searchByusername').val();
        var searchByfechaAprobado = $('#searchByfechaAprobado').val();
        // Append to data
        data.searchByreferencia=searchByreferencia;
        data.searchByreceptor=searchByreceptor;
        data.searchByconcepto=searchByconcepto;
        data.searchBytipoGasto=searchBytipoGasto;
        data.searchByprecioUnitario=searchByprecioUnitario;
        data.searchBycantidad=searchBycantidad;
        data.searchBytotal=searchBytotal;
        data.searchByunidad=searchByunidad;
        data.searchByfechaRegistro=searchByfechaRegistro;
        data.searchByfechaPago=searchByfechaPago;
        data.searchByformaPago=searchByformaPago;
        data.searchByobservaciones=searchByobservaciones;
        data.searchByfolio=searchByfolio;
        data.searchByestatusEgreso=searchByestatusEgreso;
        data.searchByusername=searchByusername;
        data.searchByfechaAprobado=searchByfechaAprobado;
      }
		},

		columns: [
      { data: 'idEgreso' },
      { data: 'referencia' },
      { data: 'receptor' },
      { data: 'concepto' },
      { data: 'tipoGasto' },
      { data: 'precioUnitario' },
      { data: 'cantidad' },
      { data: 'total' },
      { data: 'unidad' },
      { data: 'fechaRegistro' },
      { data: 'fechaPago' },
      { data: 'formaPago' },
      { data: 'observaciones' },
      { data: 'folio' },
      { data: 'estatusEgreso' },
      { data: 'comprobante' },
      { data: 'idUsuario' },
      { data: 'username' },
      { data: 'fechaAprobado' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        text: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de egresos',
        title: 'Tabla egresos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de egresos',
        title: 'Tabla egresos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 ]
        }
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.estatusEgreso == "Rechazado") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  idsEgresos.forEach(function(id) {
    $(id).keyup(function(){
      egresosTable.draw();
    });
  });

	var numColsEgresos = egresosTable.init().columns.length;
	
	egresosTable.on("dblclick", "tr",function(){
		egresosArray.length=0;
		var idx = egresosTable.fixedColumns().rowIndex( this );
		var aData = egresosTable.row( idx ).data();
		for(var i=0;i<numColsEgresos;i++){
			egresosText = egresosTable.cell( idx, i ).data();
			egresosArray.push(egresosText);
		};
    $("#editarEgreso_modal").modal("show");
		$('#editarEgreso_idEgreso').val(egresosArray[0]);
		$('#editarEgreso_referencia').val(egresosArray[1]);
		$('#editarEgreso_receptor').val(egresosArray[2]);
		$('#editarEgreso_concepto').val(egresosArray[3]);
		$('#editarEgreso_tipoGasto').val(egresosArray[4]);
		$('#editarEgreso_precioUnitario').val(egresosArray[5]);
		$('#editarEgreso_cantidad').val(egresosArray[6]);
		$('#editarEgreso_total').val(egresosArray[7]);
		$('#editarEgreso_unidad').val(egresosArray[8]);
		$('#editarEgreso_fechaRegistro').val(egresosArray[9]);
		$('#editarEgreso_fechaPago').val(egresosArray[10]);
		$('#editarEgreso_formaPago').val(egresosArray[11]);
		$('#editarEgreso_observaciones').val(egresosArray[12]);
		$('#editarEgreso_folio').val(egresosArray[13]);
		$('#editarEgreso_estatusEgreso').val(egresosArray[14]);
		// $('#editarEgreso_comprobante').val(egresosArray[15]);

    if (egresosArray[15]) {
		  document.getElementById('enlaceComprobante').setAttribute('href', egresosArray[15]);
      comprobantePath=egresosArray[15];

      document.getElementById("comprobanteDiv").setAttribute('style', 'display:none !important');
      document.getElementById("enlaceComprobante").style.display = "block";
    }else{
      document.getElementById("comprobanteDiv").setAttribute('style', 'display:flex !important');
      document.getElementById("enlaceComprobante").style.display = "none";
    }

		$('#editarEgreso_idUsuario').val(egresosArray[16]);
		$('#editarEgreso_username').val(egresosArray[17]);
		$('#editarEgreso_fechaAprobado').val(egresosArray[18]);
		$('#editarEgreso_fechaAprobadoDisabled').val(egresosArray[18]);
	});

    
	// -----------------------------------------------------------------------------------------------------TABLA DE INGRESOS-----------------------------------------------------------------------------------------------------
  ingresosTable = $('#ingresosTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0 ],
			visible: false
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
		}
		,
		serverMethod: 'post',
		ajax: {
			url:'backend/balanceIngresos_Read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBytipoIngreso = $('#searchBytipoIngreso').val();
        var searchBydescripcion = $('#searchBydescripcion').val();
        var searchByfecha = $('#searchByfecha').val();
        var searchBymonto = $('#searchBymonto').val();
        // Append to data
        data.searchBytipoIngreso=searchBytipoIngreso;
        data.searchBydescripcion=searchBydescripcion;
        data.searchByfecha=searchByfecha;
        data.searchBymonto=searchBymonto;
      }
		},
		columns: [
      { data: 'id' },
      { data: 'tipoIngreso' },
      { data: 'descripcion' },
      { data: 'fecha' },
      { data: 'monto' }
		],
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
        sheetName: 'Tabla exportada de ingresos',
        title: 'Tabla ingresos'
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de ingresos',
        title: 'Tabla ingresos'
      }
    ]
  });
  idsIngresos.forEach(function(id) {
    $(id).keyup(function(){
      ingresosTable.draw();
    });
  });



	// -----------------------------------------------------------------------------------------------------TABLA DE VENTAS DE COCINA-----------------------------------------------------------------------------------------------------
  TableTrabajadores = $('#TableVentasTrabajadores').DataTable({
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todo"] ],
		order: [[ 0, "desc" ]],
		columnDefs: [{
			targets: [ 0 ],
			visible: false
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
		}
		,
		serverMethod: 'post',
		ajax: {
			url:'backend/ventascocina_read.php'
		},
		columns: [
			{ data: 'idVenta_Cocina'},
			{ data: 'nombreCompleto'},
			{ data: 'username'},
			{ data: 'fecha'},
			{ data: 'descripcion'},
			{ data: 'cantidad'},
			{ data: 'precioUnitario'},
			{ data: 'totalUnitario'}
		],
    dom: 'Blfrtip',
    buttons: [
      {
				text: 'Copiar',
				className: 'btn btn-info',
				extend: 'copy',
      	exportOptions: {
        columns: [0,1,2,3,4,5,6 ]
      }}
      ,
      {
				className: 'btn btn-info',
				extend: 'csv',
				sheetName: 'Tabla exportada de ventas de cocina',
				title: 'Tabla ventas de cocina',
				exportOptions: {
        columns: [0,1,2,3,4,5,6 ]
      }},
      {
				className: 'btn btn-info',
				extend: 'excel',
				autoFilter: true,
				sheetName: 'Tabla exportada de ventas de cocina',
				title: 'Tabla ventas de cocina',
				exportOptions: {
        columns: [0,1,2,3,4,5,6 ]
      }}
    ]
	});
});


// CHARTS------------------------------------------------------

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
	var fechaInicial = document.getElementById('fechaInicial').value;
	var fechaFinal = document.getElementById('fechaFinal').value;

  var chartData = $.ajax({
    url: "backend/balancefinanciero/ingresosChart.php",
		type:"POST",
    dataType: "json",
    data:{
			fechaInicial:fechaInicial,
			fechaFinal:fechaFinal
		},
    async: false
  }).responseText;
  
  var data = google.visualization.arrayToDataTable(JSON.parse(chartData));
  var options = {
    title: 'Ingresos',
    animation: {
      duration: 20,
      easing: 'in',
      startup: true
    }
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawBarChart);

function drawBarChart() {
	var fechaInicial = document.getElementById('fechaInicial').value;
	var fechaFinal = document.getElementById('fechaFinal').value;
  
  var chartData = $.ajax({
    url: "backend/balancefinanciero/balanceChart.php",
		type:"POST",
    dataType: "json",
    data:{
			fechaInicial:fechaInicial,
			fechaFinal:fechaFinal
		},
    async: false
  }).responseText;

  var data = google.visualization.arrayToDataTable(JSON.parse(chartData));
  var options = {
    chart: {
      title: 'Balance financiero',
      subtitle: 'Ingresos, Egresos, y Ganancias',
    }
  };

  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
  chart.draw(data, google.charts.Bar.convertOptions(options));
}



var fechaInicial = document.getElementById('fechaInicial');
var fechaFinal = document.getElementById('fechaFinal');

fechaInicial.onchange = function(){
  if(fechaInicial&&fechaFinal){
    if (fechaInicial<=fechaFinal) {
      drawChart();
      drawBarChart();
    } else {
      Swal.fire({
        icon: 'warning',
        title: "La fecha inicial debe ser anterior a la fecha final.",
        showConfirmButton: true,
        timer: 1500
      });
    }
    
  }
}
fechaFinal.onchange = function(){
  if(fechaInicial&&fechaFinal){
    if (fechaInicial<=fechaFinal) {
      drawChart();
      drawBarChart();
    } else {
      Swal.fire({
        icon: 'warning',
        title: "La fecha inicial debe ser anterior a la fecha final.",
        showConfirmButton: true,
        timer: 1500
      });
    }
    
  }
}

$(window).resize(function(){
  drawChart();
  drawBarChart();
});

