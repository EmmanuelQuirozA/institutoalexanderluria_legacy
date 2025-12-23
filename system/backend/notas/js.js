// BUSQUEDA AJAX DE TRABAJADOR
$("#crearNotaAdmin_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/grupos/fetchDocente.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#docenteDrop_show_list").html(response);
			},
		});
	} else {
		$("#docenteDrop_show_list").html("");
	}
});
$(document).on("click", ".personaSearch", function () {
	$("#crearNotaAdmin_idTrabajador").val($(this).text());
	$("#docenteDrop_show_list").html("");
});

//---------------------------------------------------------------------------------------------MATERIAS---------------------------------------------------------------------------------
var notasAdminTable;
var arrayNotasAdmin = [];
var textNotasAdmin;
var fechaVisto;
$(document).ready(function(){
  notasAdminTable = $('#notasAdminTable').DataTable({
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
				url:'backend/notasAdmin_read.php'
		},
		columns: [
			{ data: 'idNotasAdmin' },
			{ data: 'nombreCompletoAdmin' },
			{ data: 'nombreCompletoDocente' },
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
	var notasAdminnumCols = notasAdminTable.init().columns.length;

	notasAdminTable.on("dblclick", "tr",function(){
		arrayNotasAdmin.length=0;
		var notasAdminidx = notasAdminTable.fixedColumns().rowIndex( this );
		var aData = notasAdminTable.row( notasAdminidx ).data();
		for(var i=0;i<notasAdminnumCols;i++){
			textNotasAdmin = notasAdminTable.cell( notasAdminidx, i ).data();
			arrayNotasAdmin.push(textNotasAdmin);
			// console.log(arrayNotasAdmin);
		};

		$("#editarNotaAdmin_modal").modal("show");
    
    $('#editarNotaAdmin_idNotasAdmin').val(arrayNotasAdmin[0]);
    // $('#').val(arrayNotasAdmin[1]);
    $('#editarNotaAdmin_idTrabajador').val(arrayNotasAdmin[2]);
    $('#editarNotaAdmin_titulo').val(arrayNotasAdmin[3]);
    $('#editarNotaAdmin_texto').val(arrayNotasAdmin[4]);
    fechaVisto=arrayNotasAdmin[6];

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
	$("#registrarNotaAdmin_modal").modal("toggle");
});
$(document).on('click', '.crearNotaAdmin_guardarCambios', function(){
	var idTrabajador = document.getElementById('crearNotaAdmin_idTrabajador').value;
	var titulo = document.getElementById('crearNotaAdmin_titulo').value;
	var texto = document.getElementById('crearNotaAdmin_texto').value;
	crearNotaAdmin(idTrabajador,titulo,texto);
});

// EDITAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarNotaAdmin_guardarCambios', function(){
	var idNotasAdmin = document.getElementById('editarNotaAdmin_idNotasAdmin').value;
	var titulo = document.getElementById('editarNotaAdmin_titulo').value;
	var texto = document.getElementById('editarNotaAdmin_texto').value;

  if (!(fechaVisto == "" || fechaVisto==null)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "Esta nota ya no se puede modificar."
    })
    return;
  }
	editarNotaAdmin(idNotasAdmin,titulo,texto);
});

// ELIMINAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarNotaAdmin_borrarRegistro', function(){
	var idNotasAdmin = document.getElementById('editarNotaAdmin_idNotasAdmin').value;

  if (!(fechaVisto == "" || fechaVisto==null)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "Esta nota ya no se puede modificar."
    })
    return;
  }
	borrarNotaAdmin(idNotasAdmin);
});