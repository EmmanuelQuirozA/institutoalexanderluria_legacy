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
$(document).on("click", ".alumnoSearch", function () {
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


// BUSQUEDA AJAX DE TRABAJADOR
$("#saldo_nombreTrabajadorCompleto").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/home/fetchTrabajador.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#saldoTrabajadorDrop_show_list").html(response);
			},
		});
	} else {
		$("#saldoTrabajadorDrop_show_list").html("");
	}
});
$(document).on("click", ".trabajadorSearch", function () {
	$("#saldo_nombreTrabajadorCompleto").val($(this).text());
	$("#saldoTrabajadorDrop_show_list").html("");
  trabajador=($(this).text());

  $.ajax({
    url:"backend/home/fetchTrabajadorData.php",
    type:"POST",
    data:{trabajador:trabajador},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#saldo_idPersona_trabajador').val(json.response.idPersona);
      $('#saldo_saldo_trabajador').val(json.response.saldo);
      $('#saldo_trabajador').val(json.response.saldo);
    }
  });
});



// BUSQUEDA AJAX DE TRABAJADOR
$("#devolucion_saldo_nombreTrabajadorCompleto").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/home/fetchTrabajadorSaldo.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#devolucion_saldoTrabajadorDrop_show_list").html(response);
        recargasSaldoTable.ajax.reload();

			},
		});
	} else {
		$("#devolucion_saldoTrabajadorDrop_show_list").html("");
	}
});
$(document).on("click", ".trabajadorSaldoDevolucionSearch", function () {
	$("#devolucion_saldo_nombreTrabajadorCompleto").val($(this).text());
	$("#devolucion_saldoTrabajadorDrop_show_list").html("");
  trabajador=($(this).text());

  $.ajax({
    url:"backend/home/fetchTrabajadorData.php",
    type:"POST",
    data:{trabajador:trabajador},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#devolucion_saldo_idPersona_trabajador').val(json.response.idPersona);
      $('#devolucion_saldo_saldo_trabajador').val(json.response.saldo);
      $('#devolucion_saldo_trabajador').val(json.response.saldo);
    }
  });
});




// BUSQUEDA AJAX DE ALUMNO
$("#saldo_nombreAlumnoCompleto").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/home/fetchAlumnoSaldo.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#saldoAlumnosDrop_show_list").html(response);
        recargasSaldoTable.ajax.reload();
			},
		});
	} else {
		$("#saldoAlumnosDrop_show_list").html("");
	}
});
$(document).on("click", ".alumnoSaldoSearch", function () {
	$("#saldo_nombreAlumnoCompleto").val($(this).text());
	$("#saldoAlumnosDrop_show_list").html("");
  alumno=($(this).text());

  $.ajax({
    url:"backend/home/fetchAlumnoData.php",
    type:"POST",
    data:{alumno:alumno},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#saldo_idPersona').val(json.response.idPersona);
      $('#saldo_nivelEscolarDisabled').val(json.response.nivelEscolar);
      $('#saldo_nivelEscolar').val(json.response.nivelEscolar);
      $('#saldo_gradoyGrupoDisabled').val(json.response.gradoyGrupo);
      $('#saldo_gradoyGrupo').val(json.response.gradoyGrupo);
      $('#saldo_saldoDisabled').val(json.response.saldo);
      $('#saldo_saldo').val(json.response.saldo);
    }
  });
});

function getSelectedPrinter(){
  const selector = $('#printerSelector');
  const selectedFromSelector = selector.length ? selector.val() : '';
  const stored = localStorage.getItem('selectedPrinter') || '';

  if (selectedFromSelector && selectedFromSelector !== stored) {
    localStorage.setItem('selectedPrinter', selectedFromSelector);
    return selectedFromSelector;
  }

  return selectedFromSelector || stored;
}

function cargarImpresorasDisponibles(){
  const selector = $('#printerSelector');
  if (!selector.length) {
    return;
  }

  selector
    .prop('disabled', true)
    .html('<option selected disabled>Cargando impresoras...</option>');

  $.ajax({
    url:"backend/home/printers.php",
    type:"GET",
    dataType:"json",
    success: function(response){
      selector.empty();
      const printers = response.printers || [];
      if (printers.length === 0) {
        selector.append('<option value=\"\">No se detectaron impresoras</option>');
        return;
      }

      selector.append('<option value=\"\">Selecciona una impresora</option>');
      printers.forEach(function(printerName){
        const cleanName = printerName.trim();
        selector.append('<option value=\"'+cleanName+'\">'+cleanName+'</option>');
      });

      const storedPrinter = localStorage.getItem('selectedPrinter');
      if (storedPrinter && printers.includes(storedPrinter)) {
        selector.val(storedPrinter);
      } else if (printers.length === 1) {
        selector.val(printers[0]);
        localStorage.setItem('selectedPrinter', printers[0]);
      }
    },
    error: function(){
      selector.html('<option value=\"\">No se pudieron cargar las impresoras</option>');
    },
    complete: function(){
      selector.prop('disabled', false);
    }
  });

  selector.on('change', function(){
    localStorage.setItem('selectedPrinter', $(this).val());
  });
}

$(document).ready(function(){
  cargarImpresorasDisponibles();
});

// BUSQUEDA AJAX DE ALUMNO
$("#devolucion_saldo_nombreAlumnoCompleto").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/home/fetchAlumnoSaldoDevolucion.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#devolucion_saldoAlumnosDrop_show_list").html(response);
			},
		});
	} else {
		$("#devolucion_saldoAlumnosDrop_show_list").html("");
	}
});
$(document).on("click", ".alumnoSaldoDevolucionSearch", function () {
	$("#devolucion_saldo_nombreAlumnoCompleto").val($(this).text());
	$("#devolucion_saldoAlumnosDrop_show_list").html("");
  alumno=($(this).text());

  $.ajax({
    url:"backend/home/fetchAlumnoData.php",
    type:"POST",
    data:{alumno:alumno},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#devolucion_saldo_idPersona').val(json.response.idPersona);
      $('#devolucion_saldo_nivelEscolarDisabled').val(json.response.nivelEscolar);
      $('#devolucion_saldo_nivelEscolar').val(json.response.nivelEscolar);
      $('#devolucion_saldo_gradoyGrupoDisabled').val(json.response.gradoyGrupo);
      $('#devolucion_saldo_gradoyGrupo').val(json.response.gradoyGrupo);
      $('#devolucion_saldo_saldoDisabled').val(json.response.saldo);
      $('#devolucion_saldo_saldo').val(json.response.saldo);
    }
  });
});



var pagosTable;
var pagosArray = [];
var pagosText;
var estatusPago;

var recargasSaldoAlumnoTable;
var recargasSaldoAlumnoArray = [];
var recargasSaldoAlumnoText;

var nombrepago;
var apellidoPaternopago;
var apellidoMaternopago;

var ids = [ 
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
  '#searchBycicloEscolar',
  '#searchBymesColegiatura',
  '#searchByobservaciones',
  '#searchByfolio'
];

var recargasSaldoTable;
var recargasSaldoArray = [];
var recargasSaldoText;

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
  // tabla pagos
  pagosTable = $('#pagosTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,1,2,3,4,5,6,17,18 ],
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
			url:'backend/home_read.php',
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
        var searchBycicloEscolar = $('#searchBycicloEscolar').val();
        var searchBymesColegiatura = $('#searchBymesColegiatura').val();
        var searchByobservaciones = $('#searchByobservaciones').val();
        var searchByfolio = $('#searchByfolio').val();
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
        data.searchBycicloEscolar=searchBycicloEscolar;
        data.searchBymesColegiatura=searchBymesColegiatura;
        data.searchByobservaciones=searchByobservaciones;
        data.searchByfolio=searchByfolio;
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
      { data: 'username' },
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
      { data: 'folio' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        pagosText: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de pagos',
        title: 'Tabla pagos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de pagos',
        title: 'Tabla pagos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
        }
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.estatusPago == "Rechazado") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  ids.forEach(function(id) {
    $(id).keyup(function(){
      pagosTable.draw();
    });
  });

	var numCols = pagosTable.init().columns.length;
	
	pagosTable.on("dblclick", "tr",function(){
		pagosArray.length=0;
		var idx = pagosTable.fixedColumns().rowIndex( this );
		var aData = pagosTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			pagosText = pagosTable.cell( idx, i ).data();
			pagosArray.push(pagosText);
			// console.log(pagosText);
		};
    $("#editarPago_modal").modal("show");
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
		$('#editarPago_idPago').val(pagosArray[0]);
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


		

    if (pagosArray[18]) {
		  document.getElementById('enlaceComprobante').setAttribute('href', pagosArray[18]);

      document.getElementById("comprobanteDiv").setAttribute('style', 'display:none !important');
      // document.getElementById("guardarComprobante").style.display = "none";
      document.getElementById("enlaceComprobante").style.display = "block";
    }else{
      document.getElementById("comprobanteDiv").setAttribute('style', 'display:flex !important');
      // document.getElementById("guardarComprobante").style.display = "block";
      document.getElementById("enlaceComprobante").style.display = "none";
    }
		if (pagosArray[20]) {
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

	
  var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'backend/home/calendario/load.php',
    selectable:true,
    selectHelper:true,


    select: function(start, end, allDay)  {
      if(start.toISOString().length>11){
        $('#ModalAdd #start').val(start.toISOString());
      }else{
        $('#ModalAdd #start').val(start.toISOString()+"T00:00:00");
      }
      if(start.toISOString().length>11){
        $('#ModalAdd #end').val(end.toISOString());
      }else{
        $('#ModalAdd #end').val(end.toISOString()+"T00:00:00");
      }
      $('#ModalAdd').modal('show');

      $(document).on('click', '.addEvent', function(){
        var titulo = document.getElementById('titulo').value;
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        var notas = document.getElementById('notas').value;
        var tipoEvento = document.getElementById('tipoEvento').value;

        
        var form = document.getElementById('crearEvento_modal_Form');
        var required=0;
        var validity=true;
        for(var i=0; i < form.elements.length; i++){
          if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
            required++;
          }
          if(form.elements[i].validity.valid==false){
            validity=false;
          }
        };
	      if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
          $.ajax({
            url:"backend/home/calendario/insert.php",
            type:"POST",
            data:{
              titulo:titulo,
              start:start,
              end:end,
              notas:notas,
              tipoEvento:tipoEvento
            },
            success: function(jsonresult){
              var json = $.parseJSON(jsonresult);
              if(json.response.status == 'success') {
                calendar.fullCalendar('refetchEvents');
                Swal.fire({
                  icon: 'success',
                  title: json.response.message,
                  showConfirmButton: false,
                  timer: 1500
                });
                $('#ModalAdd').modal('hide');
                document.getElementById('titulo').value="";
                document.getElementById('start').value="";
                document.getElementById('end').value="";
                document.getElementById('notas').value="";
                document.getElementById('tipoEvento').value="";
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: json.response.message
                })
              }
            }
          })
          
        }else if(validity==false){
          enableActionButtons();
          new PNotify({
            text: 'Llena correctamente los campos.',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
      });
    },


    editable:true,
    eventResize:function(event)  {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"backend/home/calendario/updatedrop.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success: function(jsonresult){
          var json = $.parseJSON(jsonresult);
          if(json.response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: json.response.message,
              showConfirmButton: false,
              timer: 1500
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: json.response.message
            })
          }
        }
      })
    },

    eventDrop:function(event)  {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"backend/home/calendario/updatedrop.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success: function(jsonresult){
          var json = $.parseJSON(jsonresult);
          if(json.response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: json.response.message,
              showConfirmButton: false,
              timer: 1500
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: json.response.message
            })
          }
        }
      });
    },

    eventClick:function(event)  {
      if(event.start.toISOString().length>11){
        $('#ModalEdit #editstart').val(event.start.toISOString());
      }else{
        $('#ModalEdit #editstart').val(event.start.toISOString()+"T00:00:00");
      }
      if(event.end.toISOString().length>11){
        $('#ModalEdit #editend').val(event.end.toISOString());
      }else{
        $('#ModalEdit #editend').val(event.end.toISOString()+"T00:00:00");
      }
      
      $('#ModalEdit #edittitulo').val(event.titulo)
      $('#ModalEdit #editnotas').val(event.notas)
      $('#ModalEdit #edittipoEvento').val(event.tipoEvento)
      $('#ModalEdit').modal('show');
      // 

      $(document).on('click', '.editEvent', function(){
        var id = event.id;
        var titulo = document.getElementById('edittitulo').value;
        var start = document.getElementById('editstart').value;
        var end = document.getElementById('editend').value;
        var notas = document.getElementById('editnotas').value;
        var tipoEvento = document.getElementById('edittipoEvento').value;

        var form = document.getElementById('editarEvento_modal_Form');
        var required=0;
        var validity=true;
        for(var i=0; i < form.elements.length; i++){
          if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
            required++;
          }
          if(form.elements[i].validity.valid==false){
            validity=false;
          }
        };
	      if (required==0 && validity==true) {
          
          $.ajax({
            url:"backend/home/calendario/update.php",
            type:"POST",
            data:{
              titulo:titulo,
              start:start,
              end:end,
              notas:notas,
              id:id,
              tipoEvento:tipoEvento
            },
            success: function(jsonresult){
              var json = $.parseJSON(jsonresult);
              if(json.response.status == 'success') {
                calendar.fullCalendar('refetchEvents');
                Swal.fire({
                  icon: 'success',
                  title: json.response.message,
                  showConfirmButton: false,
                  timer: 1500
                });
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: json.response.message
                })
              }
            }
          })
        }else if(validity==false){
          enableActionButtons();
          new PNotify({
            text: 'Llena correctamente los campos.',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
      });

      $(document).on('click', '.borrarEvent', function(){

        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Seguro que deseas eliminar el evento?',
          text: "No se podrán deshacer los cambios!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar!',
          cancelButtonText: 'No, cancelar!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            var id = event.id;
            $.ajax({
              url:"backend/home/calendario/delete.php",
              type:"POST",
              data:{id:id},
              success: function(jsonresult){
                var json = $.parseJSON(jsonresult);
                if(json.response.status == 'success') {
                  calendar.fullCalendar('refetchEvents');
                  Swal.fire({
                    icon: 'success',
                    title: json.response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: json.response.message
                  })
                }
              }
            });

            $('#ModalEdit').modal('hide');
            document.getElementById('edittitulo').value="";
            document.getElementById('editstart').value="";
            document.getElementById('editstartHour').value="";
            document.getElementById('editend').value="";
            document.getElementById('editendHour').value="";
            document.getElementById('editnotas').value="";
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'El evento no se ha eliminado',
              'error'
            )
          }
        })
      });
    }
  });
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

$(document).on('click', '.registrarAlumno', function(){
	$("#registrarAlumno_modal").modal("toggle");
});

$(document).on('click', '.crearAlumno_guardarCambios', function(){
  var nombre = document.getElementById('crearAlumno_nombre').value;
  var apellidoPaterno = document.getElementById('crearAlumno_apellidoPaterno').value;
  var apellidoMaterno = document.getElementById('crearAlumno_apellidoMaterno').value;
  var matricula = document.getElementById('crearAlumno_matricula').value;
  var referencia = document.getElementById('crearAlumno_referencia').value;
  var idGrupo = document.getElementById('crearAlumno_idGrupo').value;
  var medicoFamiliar = document.getElementById('crearAlumno_medicoFamiliar').value;
  var telefonoMF = document.getElementById('crearAlumno_telefonoMF').value;
  var enCasoDeEmergencia = document.getElementById('crearAlumno_enCasoDeEmergencia').value;
  var alergias = document.getElementById('crearAlumno_alergias').value;
  var cuidadosEspeciales = document.getElementById('crearAlumno_cuidadosEspeciales').value;
  var curp = document.getElementById('crearAlumno_curp').value;
  var noSeguro = document.getElementById('crearAlumno_noSeguro').value;
  var fechaNacimiento = document.getElementById('crearAlumno_fechaNacimiento').value;
  var lugarNacimiento = document.getElementById('crearAlumno_lugarNacimiento').value;
  var nacionalidad = document.getElementById('crearAlumno_nacionalidad').value;
  var religion = document.getElementById('crearAlumno_religion').value;
  var tipoSangre = document.getElementById('crearAlumno_tipoSangre').value;
  var peso = document.getElementById('crearAlumno_peso').value;
  var talla = document.getElementById('crearAlumno_talla').value;
  var calle = document.getElementById('crearAlumno_calle').value;
  var numero = document.getElementById('crearAlumno_numero').value;
  var colonia = document.getElementById('crearAlumno_colonia').value;
  var codigoPostal = document.getElementById('crearAlumno_codigoPostal').value;
  var localidad = document.getElementById('crearAlumno_localidad').value;
  var ciudad = document.getElementById('crearAlumno_ciudad').value;
  var estado = document.getElementById('crearAlumno_estado').value;
  crearAlumno(nombre,apellidoPaterno,apellidoMaterno,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado);
});

$(document).on('click', '.registrarSaldoAlumnos', function(){
	$("#saldoAlumno_modal").modal("toggle");
});
$(document).on('click', '.registrarSaldoTrabajadores', function(){
	$("#saldoTrabajador_modal").modal("toggle");
});

$(document).on('click', '.devolverSaldoAlumno', function(){
	$("#devolucion_saldoAlumno_modal").modal("toggle");
});
$(document).on('click', '.devolverSaldoTrabajador', function(){
	$("#devolucion_saldoTrabajador_modal").modal("toggle");
});


// Agregar saldo a alumno
function reply_click(clicked_val){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
	if (clicked_val!="otraCantidad") {
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas añadir $'+clicked_val+' pesos?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, añadir!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var idPersona = document.getElementById('saldo_idPersona').value;
				var idAlumno = document.getElementById('saldo_nombreAlumnoCompleto').value;
				var saldo = document.getElementById('saldo_saldo').value;
				$.ajax({
					url:"backend/home/saldoUpdateAlumno.php",
					type:"POST",
					data:{idAlumno:idAlumno,saldo:saldo,idPersona:idPersona,cantidad:clicked_val},
					success: function(jsonresult){
            recargasSaldoTable.ajax.reload();

						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
              //Pregunta si se quiere imprimir un tiket
              const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Desea imprimir el ticket?',
                text: "No se podrá imprimir después!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, imprimir!',
                cancelButtonText: 'No, continuar!',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  // Imprimir ticket
                  $.ajax({
                    url: '../build/ImpresionTermica/ticket.php',
                    type: 'POST',
                    data:{
                      idAlumno:idAlumno,
                      idPersona:idPersona,
                      saldo:saldo,
                      cantidad:clicked_val,
                      tipoPago:"saldoAlumno",
                      nombre_impresora:getSelectedPrinter()},
                    success: function(response){
                      // alert(response)
                      // if(response==1){
                      // 		alert('Imprimiendo....');
                      // }else{
                      // 		alert('Error');
                      // }
                    }
                  });
                  Swal.fire({
                    icon: 'success',
                    title: json.response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  Swal.fire({
                    icon: 'success',
                    title: json.response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                }
              })

							$('#saldo_nombreAlumnoCompleto').val("");
							$('#saldo_nivelEscolarDisabled').val("");
							$('#saldo_nivelEscolar').val("");
							$('#saldo_gradoyGrupoDisabled').val("");
							$('#saldo_gradoyGrupo').val("");
							$('#saldo_saldoDisabled').val("");
							$('#saldo_saldo').val("");
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				switchery["update_altaBaja"].setPosition(true);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
		
	}else{
    var idPersona = document.getElementById('saldo_idPersona').value;
    var idAlumno = document.getElementById('saldo_nombreAlumnoCompleto').value;
    var saldo = document.getElementById('saldo_saldo').value;

    // VALIDATE THE FORM BEFORE SEND TO THE SERVER
    var form = document.getElementById('saldoForm');

    var required=0;
    var validity=true;

    for(var i=0; i < form.elements.length; i++){
      if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
        required++;
      }
      if(form.elements[i].validity.valid==false){
        validity=false;
      }
    };

    if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
      Swal.fire({
        title: 'Ingresar otra cantidad.',
        html: `<input type="number" id="cantidad" class="swal2-input" placeholder="Cantidad">`,
        confirmButtonText: 'Continuar',
        focusConfirm: false,
        preConfirm: () => {
          const cantidad = Swal.getPopup().querySelector('#cantidad').value
          if (!cantidad) {
            Swal.showValidationMessage(`Por favor, ingrese una cantidad`)
          }
          return { cantidad: cantidad }
        }
      }).then((cantidadIngresada) => {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Seguro que deseas añadir la cantidad ingresada?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, continuar!',
          cancelButtonText: 'No, cancelar!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url:"backend/home/saldoUpdateAlumno.php",
              type:"POST",
              data:{
                idAlumno:idAlumno,
                idPersona:idPersona,
                cantidad:cantidadIngresada.value.cantidad,
                saldo:saldo
              },
              success: function(jsonresult){
                recargasSaldoTable.ajax.reload();

                var json = $.parseJSON(jsonresult);
                if(json.response.status == 'success') {
                  //Pregunta si se quiere imprimir un tiket
                  const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success',
                      cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                  })

                  swalWithBootstrapButtons.fire({
                    title: 'Desea imprimir el ticket?',
                    text: "No se podrá imprimir después!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, imprimir!',
                    cancelButtonText: 'No, continuar!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // Imprimir ticket
                      $.ajax({
                        url: '../build/ImpresionTermica/ticket.php',
                        type: 'POST',
                        data:{
                          idAlumno:idAlumno,
                          idPersona:idPersona,
                          saldo:saldo,
                          cantidad:cantidadIngresada.value.cantidad,
                          tipoPago:"saldoAlumno",
                          nombre_impresora:getSelectedPrinter()},
                        success: function(response){
                          // alert(response)
                          // if(response==1){
                          // 		alert('Imprimiendo....');
                          // }else{
                          // 		alert('Error');
                          // }
                        }
                      }); 
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    }
                  })

                  $('#saldo_nombreAlumnoCompleto').val("");
                  $('#saldo_nivelEscolarDisabled').val("");
                  $('#saldo_nivelEscolar').val("");
                  $('#saldo_gradoyGrupoDisabled').val("");
                  $('#saldo_gradoyGrupo').val("");
                  $('#saldo_saldoDisabled').val("");
                  $('#saldo_saldo').val("");

                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: json.response.message
                  })
                }
              }
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Acción cancelada.',
              'error'
            )
          }
        })
      })
    }else if(required>0){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Por favor, llena todos los campos.'
      })
    }else if(validity==false){
      new PNotify({
        text: 'Llena correctamente los campos.',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
	}
}

// Agregar saldo a trabajador
function reply_click_trabajador(clicked_val){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
	if (clicked_val!="otraCantidad") {
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas añadir $'+clicked_val+' pesos?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, añadir!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				var idTrabajador = document.getElementById('saldo_nombreTrabajadorCompleto').value;
				var idPersona = document.getElementById('saldo_idPersona_trabajador').value;
				var saldo = document.getElementById('saldo_trabajador').value;
				$.ajax({
					url:"backend/home/saldoUpdateTrabajador.php",
					type:"POST",
					data:{idTrabajador:idTrabajador,idPersona:idPersona,saldo:saldo,cantidad:clicked_val},
					success: function(jsonresult){
            recargasSaldoTable.ajax.reload();

						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
              //Pregunta si se quiere imprimir un tiket
              const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Desea imprimir el ticket?',
                text: "No se podrá imprimir después!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, imprimir!',
                cancelButtonText: 'No, continuar!',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                  // Imprimir ticket
                  $.ajax({
                    url: '../build/ImpresionTermica/ticket.php',
                    type: 'POST',
                    data:{
                      idTrabajador:idTrabajador,
                      idPersona:idPersona,
                      saldo:saldo,
                      cantidad:clicked_val,
                      tipoPago:"saldoTrabajador",
                      nombre_impresora:getSelectedPrinter()},
                    success: function(response){
                      // alert(response)
                      // if(response==1){
                      // 		alert('Imprimiendo....');
                      // }else{
                      // 		alert('Error');
                      // }
                    }
                  }); 
                  Swal.fire({
                    icon: 'success',
                    title: json.response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  Swal.fire({
                    icon: 'success',
                    title: json.response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                }
              })
							$('#saldo_nombreTrabajadorCompleto').val("");
							$('#saldo_idPersona_trabajador').val("");
							$('#saldo_saldo_trabajador').val("");
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				switchery["update_altaBaja"].setPosition(true);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
		
	}else{
		
  var idPersona = document.getElementById('saldo_idPersona_trabajador').value;
  var idTrabajador = document.getElementById('saldo_nombreTrabajadorCompleto').value;
	var saldo = document.getElementById('saldo_trabajador').value;

	// VALIDATE THE FORM BEFORE SEND TO THE SERVER
	var form = document.getElementById('saldoTrabajadorForm');

	var required=0;
	var validity=true;

	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};

	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		Swal.fire({
			title: 'Ingresar otra cantidad.',
			html: `<input type="number" id="cantidad" class="swal2-input" placeholder="Cantidad">`,
			confirmButtonText: 'Continuar',
			focusConfirm: false,
			preConfirm: () => {
				const cantidad = Swal.getPopup().querySelector('#cantidad').value
				if (!cantidad) {
					Swal.showValidationMessage(`Por favor, ingrese una cantidad`)
				}
				return { cantidad: cantidad }
			}
		}).then((cantidadIngresada) => {
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Seguro que deseas añadir la cantidad ingresada?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Sí, continuar!',
				cancelButtonText: 'No, cancelar!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url:"backend/home/saldoUpdateTrabajador.php",
						type:"POST",
						data:{
							cantidad:cantidadIngresada.value.cantidad,
							idTrabajador:idTrabajador,
							idPersona:idPersona,
							saldo:saldo
						},
						success: function(jsonresult){
              recargasSaldoTable.ajax.reload();

							var json = $.parseJSON(jsonresult);
							if(json.response.status == 'success') {
                //Pregunta si se quiere imprimir un tiket
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                  buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Desea imprimir el ticket?',
                  text: "No se podrá imprimir después!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Sí, imprimir!',
                  cancelButtonText: 'No, continuar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                    // Imprimir ticket
                    $.ajax({
                      url: '../build/ImpresionTermica/ticket.php',
                      type: 'POST',
                      data:{
                        idTrabajador:idTrabajador,
                        idPersona:idPersona,
                        saldo:saldo,
                        cantidad:cantidadIngresada.value.cantidad,
                        tipoPago:"saldoTrabajador",
                        nombre_impresora:getSelectedPrinter()},
                      success: function(response){
                        // alert(response)
                        // if(response==1){
                        // 		alert('Imprimiendo....');
                        // }else{
                        // 		alert('Error');
                        // }
                      }
                    }); 
                    Swal.fire({
                      icon: 'success',
                      title: json.response.message,
                      showConfirmButton: false,
                      timer: 1500
                    });
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    Swal.fire({
                      icon: 'success',
                      title: json.response.message,
                      showConfirmButton: false,
                      timer: 1500
                    });
                  }
                })

								$('#saldo_idPersona_trabajador').val("");
								$('#saldo_nombreTrabajadorCompleto').val("");
								$('#saldo_saldo_trabajador').val("");
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: json.response.message
								})
							}
						}
					});
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Cancelado',
						'Acción cancelada.',
						'error'
					)
				}
			})
		})
	}else if(required>0){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Por favor, llena todos los campos.'
		})
	}else if(validity==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
	}
}



// Devolución saldo a alumno
function devolucionSaldoAlumno(clicked_val){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
  var idPersona = document.getElementById('devolucion_saldo_idPersona').value;
  var idAlumno = document.getElementById('devolucion_saldo_nombreAlumnoCompleto').value;
  var saldo = document.getElementById('devolucion_saldo_saldo').value;

  // VALIDATE THE FORM BEFORE SEND TO THE SERVER
  var form = document.getElementById('devolucion_saldoForm');

  var required=0;
  var validity=true;

  for(var i=0; i < form.elements.length; i++){
    if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
      required++;
    }
    if(form.elements[i].validity.valid==false){
      validity=false;
    }
  };

  if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
    Swal.fire({
      title: 'Ingresar otra cantidad.',
      html: `<input type="number" id="cantidad" class="swal2-input" placeholder="Cantidad" min="0">`,
      confirmButtonText: 'Continuar',
      focusConfirm: false,
      preConfirm: () => {
        const cantidad = Swal.getPopup().querySelector('#cantidad').value
        if (!cantidad) {
          Swal.showValidationMessage(`Por favor, ingrese una cantidad`)
        }
        return { cantidad: cantidad }
      }
    }).then((cantidadIngresada) => {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Seguro que deseas devolver la cantidad ingresada?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          if (parseFloat(cantidadIngresada.value.cantidad)>parseFloat(saldo)) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: "No se puede devolver más saldo de lo que el alumno cuenta actualmente."
            })
          } else {
            $.ajax({
              url:"backend/home/saldoUpdateAlumno.php",
              type:"POST",
              data:{
                idAlumno:idAlumno,
                idPersona:idPersona,
                cantidad:cantidadIngresada.value.cantidad*-1,
                saldo:saldo
              },
              success: function(jsonresult){
                recargasSaldoTable.ajax.reload();
  
                var json = $.parseJSON(jsonresult);
                if(json.response.status == 'success') {
                  //Pregunta si se quiere imprimir un tiket
                  const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success',
                      cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                  })

                  swalWithBootstrapButtons.fire({
                    title: 'Desea imprimir el ticket?',
                    text: "No se podrá imprimir después!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, imprimir!',
                    cancelButtonText: 'No, continuar!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // Imprimir ticket
                      $.ajax({
                        url: '../build/ImpresionTermica/ticket.php',
                        type: 'POST',
                        data:{
                          idAlumno:idAlumno,
                          idPersona:idPersona,
                          saldo:saldo,
                          cantidad:cantidadIngresada.value.cantidad*-1,
                          tipoPago:"saldoDevoluAlumno",
                          nombre_impresora:getSelectedPrinter()},
                        success: function(response){
                          // alert(response)
                          // if(response==1){
                          // 		alert('Imprimiendo....');
                          // }else{
                          // 		alert('Error');
                          // }
                        }
                      }); 
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    }
                  })
                  $('#devolucion_saldo_nombreAlumnoCompleto').val("");
                  $('#devolucion_saldo_nivelEscolarDisabled').val("");
                  $('#devolucion_saldo_nivelEscolar').val("");
                  $('#devolucion_saldo_gradoyGrupoDisabled').val("");
                  $('#devolucion_saldo_gradoyGrupo').val("");
                  $('#devolucion_saldo_saldoDisabled').val("");
                  $('#devolucion_saldo_saldo').val("");
  
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: json.response.message
                  })
                }
              }
            });
          }
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'Acción cancelada.',
            'error'
          )
        }
      })
    })
  }else if(required>0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Por favor, llena todos los campos.'
    })
  }else if(validity==false){
    new PNotify({
      text: 'Llena correctamente los campos.',
      type: 'error',
      styling: 'bootstrap3'
    });
  }
}
// Devolución saldo a trabajador
function devolucionSaldoTrabajador(clicked_val){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
		
  var idPersona = document.getElementById('devolucion_saldo_idPersona_trabajador').value;
  var idTrabajador = document.getElementById('devolucion_saldo_nombreTrabajadorCompleto').value;
	var saldo = document.getElementById('devolucion_saldo_trabajador').value;

	// VALIDATE THE FORM BEFORE SEND TO THE SERVER
	var form = document.getElementById('devolucion_saldoTrabajadorForm');

	var required=0;
	var validity=true;

	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};

	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		Swal.fire({
			title: 'Ingresar otra cantidad.',
			html: `<input type="number" id="cantidad" class="swal2-input" placeholder="Cantidad">`,
			confirmButtonText: 'Continuar',
			focusConfirm: false,
			preConfirm: () => {
				const cantidad = Swal.getPopup().querySelector('#cantidad').value
				if (!cantidad) {
					Swal.showValidationMessage(`Por favor, ingrese una cantidad`)
				}
				return { cantidad: cantidad }
			}
		}).then((cantidadIngresada) => {
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Seguro que deseas devolver la cantidad ingresada?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Sí, continuar!',
				cancelButtonText: 'No, cancelar!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
          if (parseFloat(cantidadIngresada.value.cantidad)>parseFloat(saldo)) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: "No se puede devolver más saldo de lo que el trabajador cuenta actualmente."
            })
          } else {
            $.ajax({
              url:"backend/home/saldoUpdateTrabajador.php",
              type:"POST",
              data:{
                idTrabajador:idTrabajador,
                idPersona:idPersona,
                cantidad:cantidadIngresada.value.cantidad*-1,
                saldo:saldo
              },
              success: function(jsonresult){
                recargasSaldoTable.ajax.reload();

                var json = $.parseJSON(jsonresult);
                if(json.response.status == 'success') {
                  //Pregunta si se quiere imprimir un tiket
                  const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success',
                      cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                  })

                  swalWithBootstrapButtons.fire({
                    title: 'Desea imprimir el ticket?',
                    text: "No se podrá imprimir después!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, imprimir!',
                    cancelButtonText: 'No, continuar!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // Imprimir ticket
                      $.ajax({
                        url: '../build/ImpresionTermica/ticket.php',
                        type: 'POST',
                        data:{
                          idTrabajador:idTrabajador,
                          idPersona:idPersona,
                          saldo:saldo,
                          cantidad:cantidadIngresada.value.cantidad*-1,
                          tipoPago:"saldoDevoluTrabajador",
                          nombre_impresora:getSelectedPrinter()},
                        success: function(response){
                          // alert(response)
                          // if(response==1){
                          // 		alert('Imprimiendo....');
                          // }else{
                          // 		alert('Error');
                          // }
                        }
                      }); 
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      Swal.fire({
                        icon: 'success',
                        title: json.response.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                    }
                  })
                  $('#devolucion_saldo_idPersona_trabajador').val("");
                  $('#devolucion_saldo_nombreTrabajadorCompleto').val("");
                  $('#devolucion_saldo_saldo_trabajador').val("");
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: json.response.message
                  })
                }
              }
            });
          }
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Cancelado',
						'Acción cancelada.',
						'error'
					)
				}
			})
		})
	}else if(required>0){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Por favor, llena todos los campos.'
		})
	}else if(validity==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}
