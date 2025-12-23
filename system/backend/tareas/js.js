// BUSQUEDA AJAX DE TRABAJADOR
$("#crearTarea_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/tareas/fetchDocente.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#personaDrop_show_list").html(response);
			},
		});
	} else {
		$("#personaDrop_show_list").html("");
	}
});
$(document).on("click", ".docenteSearch", function () {
	$("#crearTarea_idTrabajador").val($(this).text());
	$("#personaDrop_show_list").html("");
});

var tareasTable;
var tareasArray = [];
var tareasText;

var idsTareas = [ 
  '#searchBynombreCompletoDocente',
  '#searchBymateria',
  '#searchBytitulo',
  '#searchBydescripcion',
  '#searchByfechaInicio',
  '#searchByfechaEntrega',
  '#searchBydiasParaEntrega'
];
/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
	cargarGrupos();
	cargarGeneracion();
  // -----------------------------------------------------------------------------------------------------TABLA DE RECARGAS DE PAGOS-----------------------------------------------------------------------------------------------------
  tareasTable = $('#tareasTable').DataTable({
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
			url:'backend/tareas_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBygeneracion = $('#searchBygeneracion').val();
        var searchBynivelEscolar = $('#searchBynivelEscolar').val();
        var searchBygradoyGrupo = $('#searchBygradoyGrupo').val();
        var searchBynombreCompletoDocente = $('#searchBynombreCompletoDocente').val();
        var searchBymateria = $('#searchBymateria').val();
        var searchBytitulo = $('#searchBytitulo').val();
        var searchBydescripcion = $('#searchBydescripcion').val();
        var searchByfechaInicio = $('#searchByfechaInicio').val();
        var searchByfechaEntrega = $('#searchByfechaEntrega').val();
        var searchBydiasParaEntrega = $('#searchBydiasParaEntrega').val();
        // Append to data
        data.searchBygeneracion=searchBygeneracion;
        data.searchBynivelEscolar=searchBynivelEscolar;
        data.searchBygradoyGrupo=searchBygradoyGrupo;
        data.searchBynombreCompletoDocente=searchBynombreCompletoDocente;
        data.searchBymateria=searchBymateria;
        data.searchBytitulo=searchBytitulo;
        data.searchBydescripcion=searchBydescripcion;
        data.searchByfechaInicio=searchByfechaInicio;
        data.searchByfechaEntrega=searchByfechaEntrega;
        data.searchBydiasParaEntrega=searchBydiasParaEntrega;
      }
		},

		columns: [
      { data: 'idTarea' },
      { data: 'generacion' },
      { data: 'nivelEscolar' },
      { data: 'gradoyGrupo' },
      { data: 'nombreCompletoDocente' },
      { data: 'materia' },
      { data: 'titulo' },
      { data: 'descripcion' },
      { data: 'fechaInicio' },
      { data: 'fechaEntrega' },
      { data: 'diasParaEntrega' }
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
        sheetName: 'Tabla exportada de tareas',
        title: 'Tabla tareas'
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de tareas',
        title: 'Tabla tareas'
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.diasParaEntrega == "Entrega vencida") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  idsTareas.forEach(function(id) {
    $(id).keyup(function(){
      tareasTable.draw();
    });
  });
  $('#searchBygeneracion').change(function(){
		tareasTable.draw();
	});
  $('#searchBynivelEscolar').change(function(){
		tareasTable.draw();
	});
	$('#searchBygradoyGrupo').change(function(){
		tareasTable.draw();
	});
	var numColsTareas = tareasTable.init().columns.length;
	
	tareasTable.on("dblclick", "tr",function(){
		tareasArray.length=0;
		var idx = tareasTable.fixedColumns().rowIndex( this );
		var aData = tareasTable.row( idx ).data();
		for(var i=0;i<numColsTareas;i++){
			tareasText = tareasTable.cell( idx, i ).data();
			tareasArray.push(tareasText);
			// console.log(tareasText);
		};
    $("#editarTarea_modal").modal("show");

		$('#editarTarea_idTarea').val(tareasArray[0]);
		$('#editarTarea_generacion').val(tareasArray[1]);
		$('#editarTarea_nivelEscolar').val(tareasArray[2]);
		$('#editarTarea_gradoyGrupo').val(tareasArray[3]);
		$('#editarTarea_nombreCompletoDocente').val(tareasArray[4]);
		$('#editarTarea_materia').val(tareasArray[5]);
		$('#editarTarea_titulo').val(tareasArray[6]);
		$('#editarTarea_descripcion').val(tareasArray[7]);
		$('#editarTarea_fechaInicio').val(tareasArray[8]);
		$('#editarTarea_fechaEntrega').val(tareasArray[9]);
    // $('#diasParaEntrega').val(tareasArray[10]);
	});

  
});




// REGISTRAR UN TAREA-------------------------------------------------
$(document).on('click', '.registrarTarea', function(){
	$("#registrarTarea_modal").modal("toggle");
});

$(document).on('click', '.crearTarea_guardarCambios', function(){
	var idGrupo = document.getElementById('crearTarea_idGrupo').value;
	var idMateria = document.getElementById('crearTarea_idMateria').value;
	var idTrabajador = document.getElementById('crearTarea_idTrabajador').value;
	var titulo = document.getElementById('crearTarea_titulo').value;
	var descripcion = document.getElementById('crearTarea_descripcion').value;
	var fechaInicio = document.getElementById('crearTarea_fechaInicio').value;
	var fechaEntrega = document.getElementById('crearTarea_fechaEntrega').value;

  if (fechaInicio>fechaEntrega) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "La fecha de entrega no puede ser menor a la fecha de inicio."
    });
    return;
  } else {
    registrarTarea(idGrupo,idMateria,idTrabajador,titulo,descripcion,fechaInicio,fechaEntrega);
  }
});


$(document).on('click', '.Tarea_editRegistro', function(){
	var idTarea = document.getElementById('editarTarea_idTarea').value;
	var titulo = document.getElementById('editarTarea_titulo').value;
	var descripcion = document.getElementById('editarTarea_descripcion').value;
	var fechaInicio = document.getElementById('editarTarea_fechaInicio').value;
	var fechaEntrega = document.getElementById('editarTarea_fechaEntrega').value;
  
	if (fechaInicio>fechaEntrega) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "La fecha de entrega no puede ser menor a la fecha de inicio."
    });
    return;
  } else {
    editarTarea(idTarea,titulo,descripcion,fechaInicio,fechaEntrega);
  }
});

$(document).on('click', '.Tarea_borrarRegistro', function(){
	var idTarea = document.getElementById('editarTarea_idTarea').value;
  borrarTarea(idTarea);
});



function cargarGrupos() {
	$.ajax({
		type: 'post',
		url: 'backend/grupos/fetchGrupos.php',
		success: function (response) {
			document.getElementById("searchBygradoyGrupo").innerHTML=response; 
		}
	});	
}
function cargarGeneracion() {
	$.ajax({
		type: 'post',
		url: 'backend/grupos/fetchGeneracion.php',
		success: function (response) {
			document.getElementById("searchBygeneracion").innerHTML=response; 
		}
	});	
}

function fetchMateria(idGrupo) {
	$.ajax({
		type: 'post',
		url: 'backend/tareas/fetchMaterias.php',
		data: {
			idGrupo: idGrupo
		},
		success: function (response) {
			document.getElementById("crearTarea_idMateria").innerHTML=response; 
		}
	});	
}