

// BUSQUEDA AJAX DE ALUMNO
$("#crearNotaAlumno_idAlumno").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/notasAlumnos/fetchAlumno.php",
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
	$("#crearNotaAlumno_idAlumno").val($(this).text());
	$("#alumnoDrop_show_list").html("");
});

//---------------------------------------------------------------------------------------------MATERIAS---------------------------------------------------------------------------------
var notasAlumnosTable;
var arrayNotasAlumnos = [];
var textNotasAlumnos;
var fechaVisto;
$(document).ready(function(){
  notasAlumnosTable = $('#notasAlumnosTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
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
				url:'backend/notasAlumnos_read.php'
		},
		columns: [
			{ data: 'idNotaAlumno' },
			{ data: 'nombreCompletoDocente' },
			{ data: 'nombreCompletoAlumno' },
			{ data: 'titulo' },
			{ data: 'texto' },
			{ data: 'fechaEnviado' },
			{ data: 'fechaVisto' }
		],
		"rowCallback": function( row, data, index ) {
			if (data.fechaVisto == "" || data.fechaVisto==null) {
				$('td', row).css('background-color', 'lightyellow');
			}
		}
	});
	var notasAlumnosnumCols = notasAlumnosTable.init().columns.length;

	notasAlumnosTable.on("dblclick", "tr",function(){
		arrayNotasAlumnos.length=0;
		var notasAlumnosidx = notasAlumnosTable.fixedColumns().rowIndex( this );
		var aData = notasAlumnosTable.row( notasAlumnosidx ).data();
		for(var i=0;i<notasAlumnosnumCols;i++){
			textNotasAlumnos = notasAlumnosTable.cell( notasAlumnosidx, i ).data();
			arrayNotasAlumnos.push(textNotasAlumnos);
			// console.log(arrayNotasAlumnos);
		};

		$("#editarNotaAlumno_modal").modal("show");
    
    $('#editarNotaAlumno_idNotaAlumno').val(arrayNotasAlumnos[0]);
    // $('#').val(arrayNotasAlumnos[1]);
    $('#editarNotaAlumno_idAlumno').val(arrayNotasAlumnos[2]);
    $('#editarNotaAlumno_titulo').val(arrayNotasAlumnos[3]);
    $('#editarNotaAlumno_texto').val(arrayNotasAlumnos[4]);
    fechaVisto=arrayNotasAlumnos[6];

    if (fechaVisto == "" || fechaVisto==null) {
      document.getElementById("editarBtn").style.display = "block";
      document.getElementById("borrarBtn").style.display = "block";
    }else{
      document.getElementById("editarBtn").style.display = "none";
      document.getElementById("borrarBtn").style.display = "none";
    }
	});
});


// REGISTRAR UN MATERIA-------------------------------------------------
$(document).on('click', '.registrarNota', function(){
	$("#registrarNotaAlumno_modal").modal("toggle");
});
$(document).on('click', '.crearNotaAlumno_guardarCambios', function(){
	var idAlumno = document.getElementById('crearNotaAlumno_idAlumno').value;
	var titulo = document.getElementById('crearNotaAlumno_titulo').value;
	var texto = document.getElementById('crearNotaAlumno_texto').value;
	crearNota(idAlumno,titulo,texto);
});

// EDITAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarNotaAlumno_guardarCambios', function(){
	var idNotaAlumno = document.getElementById('editarNotaAlumno_idNotaAlumno').value;
	var titulo = document.getElementById('editarNotaAlumno_titulo').value;
	var texto = document.getElementById('editarNotaAlumno_texto').value;

  if (!(fechaVisto == "" || fechaVisto==null)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "Esta nota ya no se puede modificar."
    })
    return;
  }
	editarNotaAlumno(idNotaAlumno,titulo,texto);
});

// ELIMINAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarNotaAlumno_borrarRegistro', function(){
	var idNotaAlumno = document.getElementById('editarNotaAlumno_idNotaAlumno').value;

  if (!(fechaVisto == "" || fechaVisto==null)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "Esta nota ya no se puede modificar."
    })
    return;
  }
	borrarNotaAlumno(idNotaAlumno);
});