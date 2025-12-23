// BUSQUEDA AJAX DE ALUMNO
$("#crearPago_alumno").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/home/fetchAlumno.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#alumnoDrop_show_list").html(response);
			},
		});
	} else {
		$("#alumnoDrop_show_list").html("");
	}
});
$(document).on("click", ".personaSearch", function () {
	$("#crearPago_alumno").val($(this).text());
	$("#alumnoDrop_show_list").html("");
  alumno=($(this).text());

  $.ajax({
    url:"backend/home/fetchAlumnoData.php",
    type:"POST",
    data:{alumno:alumno},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#crearPago_nivelEscolar').val(json.response.nivelEscolar);
      $('#disabled_crearPago_nivelEscolar').val(json.response.nivelEscolar);
      $('#crearPago_gradoyGrupo').val(json.response.gradoyGrupo);
      $('#disabled_crearPago_gradoyGrupo').val(json.response.gradoyGrupo);
    }
  });
});


var pagosTable;
var pagosArray = [];
var pagosText;
var estatusPago;

var recargasSaldoTable;
var recargasSaldoArray = [];
var recargasSaldoText;

var idsPagos = [ 
  '#searchBynombreCompleto',
  '#searchByusername',
  '#searchBynivelEscolar',
  '#searchBygradoyGrupo',
  '#searchByreferencia',
  '#searchByconcepto',
  '#searchBymonto',
  '#searchByfechaRegistro',
  '#searchByfechaPago',
  '#searchByformaPago',
  '#searchByestatusPago',
  '#searchBycicloEscolar',
  '#searchBymesColegiatura',
  '#searchByobservaciones',
  '#searchByfolio',
  '#searchByusernameAprobo',
  '#searchByfechaAprobacion'
];
var idsRecargasSaldos = [ 
  '#searchBynombreCompletoRS',
  '#searchBytipoPersona',
  '#searchBymonto',
  '#searchByfecha',
  '#searchByusername'
];
/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
  // -----------------------------------------------------------------------------------------------------TABLA DE RECARGAS DE PAGOS-----------------------------------------------------------------------------------------------------
  pagosTable = $('#pagosTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,1,2,3,4,5,6,18,23 ],
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
			url:'backend/pagos_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBynombreCompleto = $('#searchBynombreCompleto').val();
        var searchByusername = $('#searchByusername').val();
        var searchBynivelEscolar = $('#searchBynivelEscolar').val();
        var searchBygradoyGrupo = $('#searchBygradoyGrupo').val();
        var searchByreferencia = $('#searchByreferencia').val();
        var searchByconcepto = $('#searchByconcepto').val();
        var searchBymonto = $('#searchBymonto').val();
        var searchByfechaRegistro = $('#searchByfechaRegistro').val();
        var searchByfechaPago = $('#searchByfechaPago').val();
        var searchByformaPago = $('#searchByformaPago').val();
        var searchByestatusPago = $('#searchByestatusPago').val();
        var searchBycicloEscolar = $('#searchBycicloEscolar').val();
        var searchBymesColegiatura = $('#searchBymesColegiatura').val();
        var searchByobservaciones = $('#searchByobservaciones').val();
        var searchByfolio = $('#searchByfolio').val();
        var searchByusernameAprobo = $('#searchByusernameAprobo').val();
        var searchByfechaAprobacion = $('#searchByfechaAprobacion').val();
        // Append to data
        data.searchBynombreCompleto=searchBynombreCompleto;
        data.searchByusername=searchByusername;
        data.searchBynivelEscolar=searchBynivelEscolar;
        data.searchBygradoyGrupo=searchBygradoyGrupo;
        data.searchByreferencia=searchByreferencia;
        data.searchByconcepto=searchByconcepto;
        data.searchBymonto=searchBymonto;
        data.searchByfechaRegistro=searchByfechaRegistro;
        data.searchByfechaPago=searchByfechaPago;
        data.searchByformaPago=searchByformaPago;
        data.searchByestatusPago=searchByestatusPago;
        data.searchBycicloEscolar=searchBycicloEscolar;
        data.searchBymesColegiatura=searchBymesColegiatura;
        data.searchByobservaciones=searchByobservaciones;
        data.searchByfolio=searchByfolio;
        data.searchByusernameAprobo=searchByusernameAprobo;
        data.searchByfechaAprobacion=searchByfechaAprobacion;
      }
		},

		columns: [
      { data: 'idPago' },
      { data: 'idColegiatura' },
      { data: 'idAlumno' },
      { data: 'idUsuario' },
      { data: 'nombre' },
      { data: 'apellidoPaterno' },
      { data: 'apellidoMaterno' },
      { data: 'nombreCompleto' },
      { data: 'usuarioRegistro' },
      { data: 'nivelEscolar' },
      { data: 'gradoyGrupo' },
      { data: 'referencia' },
      { data: 'concepto' },
      { data: 'monto' },
      { data: 'fechaRegistro' },
      { data: 'fechaPago' },
      { data: 'formaPago' },
      { data: 'estatusPago' },
      { data: 'comprobante' },
      { data: 'cicloEscolar' },
      { data: 'mesColegiatura' },
      { data: 'observaciones' },
      { data: 'folio' },
      { data: 'idUsuarioAprobo' },
      { data: 'usuarioAprobo' },
      { data: 'fechaAprobacion' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        text: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de pagos',
        title: 'Tabla pagos',
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de pagos',
        title: 'Tabla pagos',
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.estatusPago == "Rechazado") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  idsPagos.forEach(function(id) {
    $(id).keyup(function(){
      pagosTable.draw();
    });
  });

	var numColsPagos = pagosTable.init().columns.length;
	
	pagosTable.on("dblclick", "tr",function(){
		pagosArray.length=0;
		var idx = pagosTable.fixedColumns().rowIndex( this );
		var aData = pagosTable.row( idx ).data();
		for(var i=0;i<numColsPagos;i++){
			pagosText = pagosTable.cell( idx, i ).data();
			pagosArray.push(pagosText);
			// console.log(pagosText);
		};
		var idPago=pagosArray[0]
		var idColegiatura=pagosArray[1]
		var idAlumno=pagosArray[2]
		var idUsuario=pagosArray[3]
		var nombre=pagosArray[4]
		var apellidoPaterno=pagosArray[5]
		var apellidoMaterno=pagosArray[6]
		var nombreCompleto=pagosArray[7]
		var usuarioRegistro=pagosArray[8]
		var nivelEscolar=pagosArray[9]
		var gradoyGrupo=pagosArray[10]
		var referencia=pagosArray[11]
		var concepto=pagosArray[12]
		var monto=pagosArray[13]
		var fechaRegistro=pagosArray[14]
		var fechaPago=pagosArray[15]
		var formaPago=pagosArray[16]
		var estatusPago=pagosArray[17]
		var comprobante=pagosArray[18]
		var cicloEscolar=pagosArray[19]
		var mesColegiatura=pagosArray[20]
		var observaciones=pagosArray[21]
		var folio=pagosArray[22]
		var idUsuarioAprobo=pagosArray[23]
		var usuarioAprobo=pagosArray[24]
		var fechaAprobacion=pagosArray[25]

    $("#editarPago_modal").modal("show");

		$('#editarPago_idPago').val(idPago);
		$('#editarPago_idAlumno').val(idAlumno);
		$('#editarPago_idColegiatura').val(idColegiatura);
		$('#editarPago_alumnoDisabled').val(nombreCompleto);
		$('#editarPago_alumno').val(nombreCompleto);
		$('#editarPago_usernameDisabled').val(usuarioRegistro);
		$('#editarPago_username').val(usuarioRegistro);
		$('#editarPago_nivelEscolarDisabled').val(nivelEscolar);
		$('#editarPago_nivelEscolar').val(nivelEscolar);
		$('#editarPago_gradoyGrupoDisabled').val(gradoyGrupo);
		$('#editarPago_gradoyGrupo').val(gradoyGrupo);
		$('#editarPago_cicloEscolarDisabled').val(cicloEscolar);
		$('#editarPago_cicloEscolar').val(cicloEscolar);
		$('#editarPago_fechaRegistroDisabled').val(fechaRegistro);
		$('#editarPago_fechaRegistro').val(fechaRegistro);
		$('#editarPago_conceptoDisabled').val(concepto);
		$('#editarPago_concepto').val(concepto);
		$('#editarPago_mesColegiaturaDisabled').val(mesColegiatura);
		$('#editarPago_mesColegiatura').val(mesColegiatura);
		$('#editarPago_montoDisabled').val(monto);
		$('#editarPago_monto').val(monto);
		$('#editarPago_fechaPagoDisabled').val(fechaPago);
		$('#editarPago_fechaPago').val(fechaPago);
		$('#editarPago_referencia').val(referencia);
		$('#editarPago_formaPago').val(formaPago);
		$('#editarPago_observaciones').val(observaciones);
		$('#editarPago_folio').val(folio);
		$('#editarPago_estatusPago').val(estatusPago);
		// $('#editarPago_comprobante').val(comprobante);


		

    if (comprobante) {
		  document.getElementById('enlaceComprobante').setAttribute('href', comprobante);

      document.getElementById("comprobanteDiv").setAttribute('style', 'display:none !important');
      // document.getElementById("guardarComprobante").style.display = "none";
      document.getElementById("enlaceComprobante").style.display = "block";
    }else{
      document.getElementById("comprobanteDiv").setAttribute('style', 'display:flex !important');
      // document.getElementById("guardarComprobante").style.display = "block";
      document.getElementById("enlaceComprobante").style.display = "none";
    }
		if (mesColegiatura) {
      document.getElementById("editarPago_mesColegiaturaDiv").setAttribute('style', 'display:flex !important');
    }else{
      document.getElementById("editarPago_mesColegiaturaDiv").setAttribute('style', 'display:none !important');
    }
	
	});

	// -----------------------------------------------------------------------------------------------------TABLA DE RECARGAS DE SALDOS-----------------------------------------------------------------------------------------------------
	recargasSaldoTable = $('#recargasSaldoTable').DataTable({
		"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
		orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,1,2 ],
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
			url:'backend/recargasSaldo_read.php',
			type:"POST",
			'data': function(data){
				// Read values
				var searchBynombreCompletoRS = $('#searchBynombreCompletoRS').val();
				var searchBytipoPersona = $('#searchBytipoPersona').val();
				var searchBymonto = $('#searchBymonto').val();
				var searchByfecha = $('#searchByfecha').val();
				var searchByusername = $('#searchByusername').val();
				// Append to data
				data.searchBynombreCompletoRS=searchBynombreCompletoRS;
				data.searchBytipoPersona=searchBytipoPersona;
				data.searchBymonto=searchBymonto;
				data.searchByfecha=searchByfecha;
				data.searchByusername=searchByusername;
			}
		},

		columns: [
			{ data: 'idRecargasSaldo' },
			{ data: 'idPersona' },
			{ data: 'idUsuario' },
			{ data: 'nombreCompleto' },
			{ data: 'tipoPersona' },
			{ data: 'monto' },
			{ data: 'fecha' },
			{ data: 'username' }
		],
		dom: 'Blfrtip',
		buttons: [
			{
				text: 'Copiar',
				className: 'btn btn-info',
				extend: 'copy',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8 ]
				}
			},
			{
				extend: 'csv',
				className: 'btn btn-info',
				sheetName: 'Tabla exportada de recargas de saldos',
				title: 'Tabla recargas de saldos',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8 ]
				}
			},
			{
				extend: 'excel',
				className: 'btn btn-info',
				autoFilter: true,
				sheetName: 'Tabla exportada de recargas de saldos',
				title: 'Tabla recargas de saldos',
				exportOptions: {
					columns: [0,1,2,3,4,5,6,7,8 ]
				}
			}
		]
	});

	idsRecargasSaldos.forEach(function(id) {
		$(id).keyup(function(){
			recargasSaldoTable.draw();
		});
	});

	var numCols = recargasSaldoTable.init().columns.length;

	recargasSaldoTable.on("dblclick", "tr",function(){
		recargasSaldoArray.length=0;
		var idx = recargasSaldoTable.fixedColumns().rowIndex( this );
		var aData = recargasSaldoTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			recargasSaldoText = recargasSaldoTable.cell( idx, i ).data();
			recargasSaldoArray.push(recargasSaldoText);
			// console.log(recargasSaldoText);
		};
		$("#editarRecargaSaldo_modal").modal("show");

		$('#editarRecargaSaldo_idRecargasSaldo').val(recargasSaldoArray[0]);
		// $('#editarRecargaSaldo_idColegiatura').val(recargasSaldoArray[1]);
		// $('#editarRecargaSaldo_idAlumno').val(recargasSaldoArray[2]);
		// $('#editarRecargaSaldo_idAlumno').val(recargasSaldoArray[2]);
		$('#editarRecargaSaldo_nombreCompleto').val(recargasSaldoArray[3]);
		$('#editarRecargaSaldo_tipoPersonaDisabled').val(recargasSaldoArray[4]);
		$('#editarRecargaSaldo_tipoPersona').val(recargasSaldoArray[4]);
		$('#editarRecargaSaldo_montoDisabled').val(recargasSaldoArray[5]);
		$('#editarRecargaSaldo_fechaDisabled').val(recargasSaldoArray[6]);
		$('#editarRecargaSaldo_usernameDisabled').val(recargasSaldoArray[7]);

	});
  
});

$(document).on('click', '.editarPago_guardarCambios', function(){
	var idPago = document.getElementById('editarPago_idPago').value;
	var idAlumno = document.getElementById('editarPago_idAlumno').value;
	var alumno = document.getElementById('editarPago_alumno').value;//-------
	var referencia = document.getElementById('editarPago_referencia').value;
	var monto = document.getElementById('editarPago_monto').value;
	var fechaPago = document.getElementById('editarPago_fechaPago').value;
	var formaPago = document.getElementById('editarPago_formaPago').value;
	var concepto = document.getElementById('editarPago_concepto').value;//-------
	
	var idColegiatura = document.getElementById('editarPago_idColegiatura').value;
	var cicloEscolar = document.getElementById('editarPago_cicloEscolar').value;
	var mesColegiatura = document.getElementById('editarPago_mesColegiatura').value;
	
	var observaciones = document.getElementById('editarPago_observaciones').value;
	var fechaRegistro = document.getElementById('editarPago_fechaRegistro').value;//-------
	var folio = document.getElementById('editarPago_folio').value;
	var estatusPago = document.getElementById('editarPago_estatusPago').value;
	var comprobante = document.getElementById('editarPago_comprobante').value;
	editarPagoAdmin(idPago,idColegiatura,idAlumno,alumno,referencia,monto,fechaPago,formaPago,concepto,cicloEscolar,mesColegiatura,observaciones,fechaRegistro,folio,estatusPago,comprobante);
});

$(document).on('click', '.registrarPago', function(){
	$("#crearPago_modal").modal("toggle");
});

$(document).on('click', '.crearPago_guardarCambios', function(){
	var alumno = document.getElementById('crearPago_alumno').value;
	var nivelEscolar = document.getElementById('crearPago_nivelEscolar').value;
	var gradoyGrupo = document.getElementById('crearPago_gradoyGrupo').value;
	var concepto = document.getElementById('crearPago_concepto').value;
	var cicloEscolar = document.getElementById('crearPago_cicloEscolar').value;
	var mesColegiatura = document.getElementById('crearPago_mesColegiatura').value;
	var referencia = document.getElementById('crearPago_referencia').value;
	var monto = document.getElementById('crearPago_monto').value;
	var fechaPago = document.getElementById('crearPago_fechaPago').value;
	var formaPago = document.getElementById('crearPago_formaPago').value;
	var folio = document.getElementById('crearPago_folio').value;
	var observaciones = document.getElementById('crearPago_observaciones').value;
	var estatusPago = document.getElementById('crearPago_estatusPago').value;
	var comprobante = document.getElementById('crearPago_comprobante').value;
  crearPago(alumno,nivelEscolar,gradoyGrupo,concepto,cicloEscolar,mesColegiatura,referencia,monto,fechaPago,formaPago,folio,observaciones,estatusPago,comprobante);
});

$(document).on('click', '.editarRecargaSaldo_borrarRegistro', function(){
	var idRecargasSaldo = document.getElementById('editarRecargaSaldo_idRecargasSaldo').value;
	var tipoPersona = document.getElementById('editarRecargaSaldo_tipoPersona').value;
	borrarRecargaSaldo(idRecargasSaldo,tipoPersona);
});

$(document).on('click', '.editarPago_borrarRegistro', function(){
	var idPago = document.getElementById('editarPago_idPago').value;
	var idAlumno = document.getElementById('editarPago_idAlumno').value;
	var mesColegiatura = document.getElementById('editarPago_mesColegiatura').value;
	var cicloEscolar = document.getElementById('editarPago_cicloEscolar').value;
	borrarPago(idPago,idAlumno,mesColegiatura,cicloEscolar);
});