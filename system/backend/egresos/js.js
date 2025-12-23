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
/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
  // -----------------------------------------------------------------------------------------------------TABLA DE RECARGAS DE PAGOS-----------------------------------------------------------------------------------------------------
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
			url:'backend/egresos_read.php',
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
			// console.log(egresosText);
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

});

$(document).on('click', '.editarEgreso_guardarCambios', function(){
	var idEgreso = document.getElementById('editarEgreso_idEgreso').value;
	var referencia = document.getElementById('editarEgreso_referencia').value;
	var receptor = document.getElementById('editarEgreso_receptor').value;
	var concepto = document.getElementById('editarEgreso_concepto').value;
	var tipoGasto = document.getElementById('editarEgreso_tipoGasto').value;
	var precioUnitario = document.getElementById('editarEgreso_precioUnitario').value;
	var cantidad = document.getElementById('editarEgreso_cantidad').value;
	// var total = document.getElementById('editarEgreso_total').value;//-------
	var unidad = document.getElementById('editarEgreso_unidad').value;
	var fechaRegistro = document.getElementById('editarEgreso_fechaRegistro').value;
	var fechaPago = document.getElementById('editarEgreso_fechaPago').value;
	var formaPago = document.getElementById('editarEgreso_formaPago').value;
	var observaciones = document.getElementById('editarEgreso_observaciones').value;//-------
	var folio = document.getElementById('editarEgreso_folio').value;
	var estatusEgreso = document.getElementById('editarEgreso_estatusEgreso').value;//-------
	var comprobante = document.getElementById('editarEgreso_comprobante').value;
	var idUsuario = document.getElementById('editarEgreso_idUsuario').value;
	// var username = document.getElementById('editarEgreso_username').value;
	var fechaAprobado = document.getElementById('editarEgreso_fechaAprobado').value;
	editarEgreso(idEgreso,referencia,receptor,concepto,tipoGasto,precioUnitario,cantidad,unidad,fechaRegistro,fechaPago,formaPago,observaciones,folio,estatusEgreso,comprobante,idUsuario,fechaAprobado);
});

$(document).on('click', '.registrarEgreso', function(){
	$("#crearEgreso_modal").modal("toggle");
});

$(document).on('click', '.crearEgreso_guardarCambios', function(){
	var referencia = document.getElementById('crearEgreso_referencia').value;
	var receptor = document.getElementById('crearEgreso_receptor').value;
	var concepto = document.getElementById('crearEgreso_concepto').value;
	var tipoGasto = document.getElementById('crearEgreso_tipoGasto').value;
	var precioUnitario = document.getElementById('crearEgreso_precioUnitario').value;
	var cantidad = document.getElementById('crearEgreso_cantidad').value;
	var unidad = document.getElementById('crearEgreso_unidad').value;
	var fechaPago = document.getElementById('crearEgreso_fechaPago').value;
	var formaPago = document.getElementById('crearEgreso_formaPago').value;
	var observaciones = document.getElementById('crearEgreso_observaciones').value;
	var folio = document.getElementById('crearEgreso_folio').value;
	var estatusEgreso = document.getElementById('crearEgreso_estatusEgreso').value;
	var comprobante = document.getElementById('crearEgreso_comprobante').value;
  crearEgreso(referencia,receptor,concepto,tipoGasto,precioUnitario,cantidad,unidad,fechaPago,formaPago,observaciones,folio,estatusEgreso,comprobante);
});

$(document).on('click', '.editarEgreso_borrarRegistro', function(){
	var idEgreso = document.getElementById('editarEgreso_idEgreso').value;
  borrarEgreso(idEgreso,comprobantePath);
});
