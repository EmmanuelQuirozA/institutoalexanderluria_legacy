// BUSQUEDA AJAX DE TRABAJADOR
$("#crearCalificacion_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/calificaciones/fetchDocente.php",
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
	$("#crearCalificacion_idTrabajador").val($(this).text());
	$("#personaDrop_show_list").html("");
});

// BUSQUEDA AJAX DE ALUMNO
$("#crearCalificacion_alumno").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/calificaciones/fetchAlumno.php",
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
$(document).on("click", ".alumnoCalifSearch", function () {
	$("#crearCalificacion_alumno").val($(this).text());
	$("#alumnoDrop_show_list").html("");
  alumno=($(this).text());

  $.ajax({
    url:"backend/calificaciones/fetchAlumnoData.php",
    type:"POST",
    data:{alumno:alumno},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#crearCalificacion_nivelEscolar').val(json.response.nivelEscolar);
      $('#crearCalificacion_nivelEscolarDisabled').val(json.response.nivelEscolar);
      $('#crearCalificacion_gradoyGrupo').val(json.response.gradoyGrupo);
      $('#crearCalificacion_gradoyGrupoDisabled').val(json.response.gradoyGrupo);
      $.ajax({
        type: 'post',
        url: 'backend/grupos/fetchMaterias.php',
        data: {
          nivelEscolar: json.response.nivelEscolar,
          grado: json.response.gradoyGrupo
        },
        success: function (response) {
          document.getElementById("crearCalificacion_idMateria").innerHTML=response; 
        }
      });
    }
  });
});


var calificacionesTable;
var calificacionesArray = [];
var calificacionesText;

var idsCalificaciones = [ 
  '#searchBymateria',
  '#searchBynombreCompletoDocente',
  '#searchBynombreCompletoAlumno',
  '#searchBycicloEscolar',
  '#searchByperiodo'
];
/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
	cargarGrupos();
  // -----------------------------------------------------------------------------------------------------TABLA DE RECARGAS DE PAGOS-----------------------------------------------------------------------------------------------------
  calificacionesTable = $('#calificacionesTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,9,10,11,12 ],
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
			url:'backend/calificaciones_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBynivelEscolar = $('#searchBynivelEscolar').val();
        var searchBygradoyGrupo = $('#searchBygradoyGrupo').val();
        var searchBymateria = $('#searchBymateria').val();
        var searchBynombreCompletoDocente = $('#searchBynombreCompletoDocente').val();
        var searchBynombreCompletoAlumno = $('#searchBynombreCompletoAlumno').val();
        var searchBycicloEscolar = $('#searchBycicloEscolar').val();
        var searchByperiodo = $('#searchByperiodo').val();
        // Append to data
        data.searchBynivelEscolar=searchBynivelEscolar;
        data.searchBygradoyGrupo=searchBygradoyGrupo;
        data.searchBymateria=searchBymateria;
        data.searchBynombreCompletoDocente=searchBynombreCompletoDocente;
        data.searchBynombreCompletoAlumno=searchBynombreCompletoAlumno;
        data.searchBycicloEscolar=searchBycicloEscolar;
        data.searchByperiodo=searchByperiodo;
      }
		},

		columns: [
      { data: 'idCalificacion' },
      { data: 'nombreCompletoDocente' },
      { data: 'nombreCompletoAlumno' },
      { data: 'cicloEscolar' },
      { data: 'periodo' },
      { data: 'nivelEscolar' },
      { data: 'gradoyGrupo' },
      { data: 'materia' },
      { data: 'calificacion' },
      { data: 'idTrabajador' },
      { data: 'idAlumno' },
      { data: 'idMateria' },
      { data: 'idCicloEscolar' }
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
        sheetName: 'Tabla exportada de calificaciones',
        title: 'Tabla calificaciones'
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de calificaciones',
        title: 'Tabla calificaciones'
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.calificacion <= 6) {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  idsCalificaciones.forEach(function(id) {
    $(id).keyup(function(){
      calificacionesTable.draw();
    });
  });
  $('#searchBynivelEscolar').change(function(){
		calificacionesTable.draw();
	});
	$('#searchBygradoyGrupo').change(function(){
		calificacionesTable.draw();
	});
	var numColsCalificaciones = calificacionesTable.init().columns.length;
	
	calificacionesTable.on("dblclick", "tr",function(){
		calificacionesArray.length=0;
		var idx = calificacionesTable.fixedColumns().rowIndex( this );
		var aData = calificacionesTable.row( idx ).data();
		for(var i=0;i<numColsCalificaciones;i++){
			calificacionesText = calificacionesTable.cell( idx, i ).data();
			calificacionesArray.push(calificacionesText);
			// console.log(calificacionesText);
		};
    $("#editarCalificacion_modal").modal("show");

		$('#editarCalificacion_idCalificacion').val(calificacionesArray[0]);
    $('#editarCalificacion_idTrabajadorDisabled').val(calificacionesArray[1]);
    $('#editarCalificacion_idAlumnoDisabled').val(calificacionesArray[2]);
    $('#editarCalificacion_cicloEscolarDisabled').val(calificacionesArray[3]);
		$('#editarCalificacion_periodo').val(calificacionesArray[4]);
    $('#editarCalificacion_nivelEscolar').val(calificacionesArray[5]);
    $('#editarCalificacion_nivelEscolarDisabled').val(calificacionesArray[5]);
    $('#editarCalificacion_gradoyGrupo').val(calificacionesArray[6]);
    $('#editarCalificacion_gradoyGrupoDisabled').val(calificacionesArray[6]);
    $.ajax({
      type: 'post',
      url: 'backend/grupos/fetchMaterias.php',
      data: {
        nivelEscolar: calificacionesArray[5],
        grado: calificacionesArray[6]
      },
      success: function (response) {
        document.getElementById("editarCalificacion_idMateria").innerHTML=response; 
      }
    });
		$('#editarCalificacion_calificacion').val(calificacionesArray[8]);
	

    $('#editarCalificacion_idTrabajador').val(calificacionesArray[9]);
    $('#editarCalificacion_idAlumno').val(calificacionesArray[10]);
		$('#editarCalificacion_idMateria').val(calificacionesArray[11]);
    $('#editarCalificacion_cicloEscolar').val(calificacionesArray[12]);
	});

  
});




// REGISTRAR UN GRUPO-------------------------------------------------
$(document).on('click', '.registrarCalificacion', function(){
	$("#registrarCalificacion_modal").modal("toggle");
});

$(document).on('click', '.crearCalificacion_guardarCambios', function(){
	// var idTrabajador = document.getElementById('crearCalificacion_idTrabajador').value;
	var idAlumno = document.getElementById('crearCalificacion_alumno').value;
	var nivelEscolar = document.getElementById('crearCalificacion_nivelEscolar').value;
	var gradoyGrupo = document.getElementById('crearCalificacion_gradoyGrupo').value;
	var idMateria = document.getElementById('crearCalificacion_idMateria').value;
	var cicloEscolar = document.getElementById('crearCalificacion_cicloEscolar').value;
	var periodo = document.getElementById('crearCalificacion_periodo').value;
	var calificacion = document.getElementById('crearCalificacion_calificacion').value;
  
  registrarCalificacion(null,idAlumno,nivelEscolar,gradoyGrupo,idMateria,cicloEscolar,periodo,calificacion);
});


$(document).on('click', '.editarCalificacion_guardarCambios', function(){
	var idCalificacion = document.getElementById('editarCalificacion_idCalificacion').value;
	var idTrabajador = document.getElementById('editarCalificacion_idTrabajador').value;
	var idAlumno = document.getElementById('editarCalificacion_idAlumno').value;
	var cicloEscolar = document.getElementById('editarCalificacion_cicloEscolar').value;
	var nivelEscolar = document.getElementById('editarCalificacion_nivelEscolar').value;
	var gradoyGrupo = document.getElementById('editarCalificacion_gradoyGrupo').value;
	var periodo = document.getElementById('editarCalificacion_periodo').value;
	var idMateria = document.getElementById('editarCalificacion_idMateria').value;
	var calificacion = document.getElementById('editarCalificacion_calificacion').value;
  editarCalificacion(idCalificacion,null,idAlumno,cicloEscolar,nivelEscolar,gradoyGrupo,periodo,idMateria,calificacion);
});

$(document).on('click', '.editarCalificacion_borrarRegistro', function(){
	var idCalificacion = document.getElementById('editarCalificacion_idCalificacion').value;
  borrarCalificacion(idCalificacion);
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