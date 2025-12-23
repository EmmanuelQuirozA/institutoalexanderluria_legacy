//---------------------------------------------------------------------------------------------TUTORES---------------------------------------------------------------------------------
var tutoresTable;
var arrayTutores = [];
var textTutores;
//---------------------------------------------------------------------------------------------USUARIOS---------------------------------------------------------------------------------
var usuariosTable;
var personasTable;
var arrayUsuarios = [];
var textUsuarios;

//---------------------------------------------------------------------------------------------RELACIONES---------------------------------------------------------------------------------
var relacionesTable;
var arrayRelaciones = [];
var textRelaciones;

var ids = [ 
  '#searchBynombreCompletoTutor',
  '#searchBynombreCompletoAlumno',
  '#searchBytipoRelacion',
  '#searchByestatusAlumno'
];

$(document).ready(function(){
  tutoresTable = $('#tutoresTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 
				0,1,2,3,4,6,10,11
			 ],
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
				url:'backend/tutores_read.php'
		},
		columns: [
			{ data: 'idTutor' },
			{ data: 'idPersona' },
			{ data: 'nombre' },
			{ data: 'apellidoPaterno' },
			{ data: 'apellidoMaterno' },
			{ data: 'nombreCompleto' },
			{ data: 'lugarNacimiento' },
			{ data: 'numeroCel' },
			{ data: 'numeroTrabajo' },
			{ data: 'numeroCasa' },
			{ data: 'correoElectronico' },
			{ data: 'religion' }
		]
	});
	var tutoresnumCols = tutoresTable.init().columns.length;

	tutoresTable.on("dblclick", "tr",function(){
		arrayTutores.length=0;
		var tutoresidx = tutoresTable.fixedColumns().rowIndex( this );
		var aData = tutoresTable.row( tutoresidx ).data();
		for(var i=0;i<tutoresnumCols;i++){
			textTutores = tutoresTable.cell( tutoresidx, i ).data();
			arrayTutores.push(textTutores);
			// console.log(arrayTutores);
		};
		$("#editarTutor_modal").modal("show");
	
		$('#crearUsuario_idPersona').val(arrayTutores[1] + " - " +arrayTutores[5]);

		$('#editarTutor_idTutor').val(arrayTutores[0]);
		$('#editarTutor_idPersona').val(arrayTutores[1]);

		nombreTutor=arrayTutores[2];
		apellidoPaternoTutor=arrayTutores[3];
		apellidoMaternoTutor=arrayTutores[4];

		$('#editarTutor_nombre').val(arrayTutores[2]);
		$('#editarTutor_apellidoPaterno').val(arrayTutores[3]);
		$('#editarTutor_apellidoMaterno').val(arrayTutores[4]);

		$('#editarTutor_lugarNacimiento').val(arrayTutores[6]);
		$('#editarTutor_numeroCel').val(arrayTutores[7]);
		$('#editarTutor_numeroTrabajo').val(arrayTutores[8]);
		$('#editarTutor_numeroCasa').val(arrayTutores[9]);
		$('#editarTutor_correoElectronico').val(arrayTutores[10]);
		$('#editarTutor_religion').val(arrayTutores[11]);
		
	});


	// usuariosTable = $('#usuariosTable').DataTable({
	// 	order: [[ 0, "desc" ]],
	// 	fixedColumns:   {
	// 		leftColumns: 1
	// 	},
	// 	columnDefs: [{
	// 		targets: [ 0,1 ],
	// 		visible: false
	// 	}],
	// 	scrollX: true,
	// 	processing: true,
	// 	serverSide: true,
	// 	language: {
	// 		lengthMenu: "Mostrar _MENU_ registros",
	// 		zeroRecords: "No se encontraron resultados",
	// 		info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	// 		infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
	// 		infoFiltered: "(filtrado de un total de _MAX_ registros)",
	// 		sSearch: "Buscar:",
	// 		oPaginate: {
	// 			sFirst: "Primero",
	// 			sLast:"Último",
	// 			sNext:"Siguiente",
	// 			sPrevious: "Anterior"
	// 		},
	// 		sProcessing:"Procesando...",
	// 	}
	// 	,
	// 	serverMethod: 'post',
	// 	ajax: {
	// 			url:'backend/usuariosTutores_read.php'
	// 	},
	// 	columns: [
	// 		{ data: 'idUsuario' },
	// 		{ data: 'idPersona' },
	// 		{ data: 'username' },
	// 		{ data: 'nombreCompleto' },
	// 		{ data: 'correoElectronico' }
	// 	]
	// });
	// var usuariosnumCols = usuariosTable.init().columns.length;

	// usuariosTable.on("dblclick", "tr",function(){
	// 	arrayUsuarios.length=0;
	// 	var usuariosidx = usuariosTable.fixedColumns().rowIndex( this );
	// 	var aData = usuariosTable.row( usuariosidx ).data();
	// 	for(var i=0;i<usuariosnumCols;i++){
	// 		textUsuarios = usuariosTable.cell( usuariosidx, i ).data();
	// 		arrayUsuarios.push(textUsuarios);
	// 		// console.log(arrayUsuarios);
	// 	};

	// 	$("#editarUsuario_modal").modal("show");

	// 	$('#editarUsuario_idUsuario').val(arrayUsuarios[0]);
  //   $('#editarUsuario_username').val(arrayUsuarios[2]);
  //   $('#editarUsuario_correoElectronico').val(arrayUsuarios[4]);
	// });

	relacionesTable = $('#relacionesTable').DataTable({
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
			url:'backend/relaciones_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBynombreCompletoTutor = $('#searchBynombreCompletoTutor').val();
        var searchBynombreCompletoAlumno = $('#searchBynombreCompletoAlumno').val();
        var searchBytipoRelacion = $('#searchBytipoRelacion').val();
        var searchByestatusAlumno = $('#searchByestatusAlumno').val();
        // Append to data
        data.searchBynombreCompletoTutor=searchBynombreCompletoTutor;
        data.searchBynombreCompletoAlumno=searchBynombreCompletoAlumno;
        data.searchBytipoRelacion=searchBytipoRelacion;
        data.searchByestatusAlumno=searchByestatusAlumno;
      }
		},

		columns: [
      { data: 'idR_tutor_alumno' },
      { data: 'idTutor' },
      { data: 'idAlumno' },
      { data: 'nombreCompletoTutor' },
      { data: 'nombreCompletoAlumno' },
      { data: 'tipoRelacion' },
      { data: 'estatusAlumno' }
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
        sheetName: 'Tabla exportada de relaciones alumno-tutor',
        title: 'Tabla relaciones alumno-tutor'
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de relaciones alumno-tutor',
        title: 'Tabla relaciones alumno-tutor'
      }
    ],
		"rowCallback": function( row, data, index ) {
			if (data.estatusAlumno == "Baja") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
  });

  ids.forEach(function(id) {
    $(id).keyup(function(){
      relacionesTable.draw();
    });
  });

	var numCols = relacionesTable.init().columns.length;
	
	relacionesTable.on("dblclick", "tr",function(){
		arrayRelaciones.length=0;
		var idx = relacionesTable.fixedColumns().rowIndex( this );
		var aData = relacionesTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			text = relacionesTable.cell( idx, i ).data();
			arrayRelaciones.push(text);
			// console.log(text);
		};
		$("#editarRelacion_modal").modal("show");
		//--------------------PAGO MODAL----------------------
		//--------------------PAGO MODAL----------------------
		$('#editarRelacion_idR_tutor_alumno').val(arrayRelaciones[0]);
    $('#editarRelacion_idTutor').val(arrayRelaciones[3]);
    $('#editarRelacion_idAlumno').val(arrayRelaciones[4]);
    $('#editarRelacion_tipoRelacion').val(arrayRelaciones[5]);
	
	});




});

// BUSQUEDA AJAX DE PERSONA
$("#crearUsuario_idPersona").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/tutores/fetchPersona.php",
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
$(document).on("click", ".personaSearch", function () {
	$("#crearUsuario_idPersona").val($(this).text());
	$("#personaDrop_show_list").html("");
});

// REGISTRAR UN ALUMNO-------------------------------------------------
$(document).on('click', '.registrarTutor', function(){
	$("#registrarTutor_modal").modal("toggle");
});

$(document).on('click', '.crearTutor_guardarCambios', function(){
	var nombre = document.getElementById('crearTutor_nombre').value;
	var apellidoPaterno = document.getElementById('crearTutor_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('crearTutor_apellidoMaterno').value;
	var lugarNacimiento = document.getElementById('crearTutor_lugarNacimiento').value;
	var numeroCel = document.getElementById('crearTutor_numeroCel').value;
	var numeroTrabajo = document.getElementById('crearTutor_numeroTrabajo').value;
	var numeroCasa = document.getElementById('crearTutor_numeroCasa').value;
	var correoElectronico = document.getElementById('crearTutor_correoElectronico').value;
	var religion = document.getElementById('crearTutor_religion').value;
	crearTutor(nombre,apellidoPaterno,apellidoMaterno,lugarNacimiento,numeroCel,numeroTrabajo,numeroCasa,correoElectronico,religion);
});

// EDITAR UN TUTOR-------------------------------------------------
$(document).on('click', '.editarTutor_guardarCambios', function(){
	var idTutor = document.getElementById('editarTutor_idTutor').value;
	var idPersona = document.getElementById('editarTutor_idPersona').value;
	var nombre = document.getElementById('editarTutor_nombre').value;
	var apellidoPaterno = document.getElementById('editarTutor_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('editarTutor_apellidoMaterno').value;
	var lugarNacimiento = document.getElementById('editarTutor_lugarNacimiento').value;
	var numeroCel = document.getElementById('editarTutor_numeroCel').value;
	var numeroTrabajo = document.getElementById('editarTutor_numeroTrabajo').value;
	var numeroCasa = document.getElementById('editarTutor_numeroCasa').value;
	var correoElectronico = document.getElementById('editarTutor_correoElectronico').value;
	var religion = document.getElementById('editarTutor_religion').value;
	editarTutor(idTutor,idPersona,nombre,apellidoPaterno,apellidoMaterno,lugarNacimiento,numeroCel,numeroTrabajo,numeroCasa,correoElectronico,religion,nombreTutor,apellidoPaternoTutor,apellidoMaternoTutor);
});

$(document).on('click', '.editarTutor_borrarRegistro', function(){
	var idPersona = document.getElementById('editarTutor_idPersona').value;
	borrarTutor(idPersona);
});

$(document).on('click', '.registrarUsuario', function(){
	$("#editarTutor_modal").modal("hide");
	$("#registrarUsuario_modal").modal("toggle");
});

$(document).on('click', '.crearUsuario_guardarCambios', function(){
  var idPersona = document.getElementById('crearUsuario_idPersona').value;
	var username = document.getElementById('crearUsuario_username').value;
	var correoElectronico = document.getElementById('crearUsuario_correoElectronico').value;
	var idRol = "15";
	var password = document.getElementById('crearUsuario_password').value;
	var passwordConfirm = document.getElementById('crearUsuario_passwordConfirm').value;
	crearUsuario(idPersona,username,correoElectronico,idRol,password,passwordConfirm);
});

// EDITAR UN REGISTRO DE USUARIO-------------------------------------------------
$(document).on('click', '.Usuario_editRegistro', function(){
  var idUsuario = document.getElementById('editarUsuario_idUsuario').value;
	var idRol = "15";
	var correoElectronico = document.getElementById('editarUsuario_correoElectronico').value;
	var password = document.getElementById('editarUsuario_password').value;
	var passwordConfirm = document.getElementById('editarUsuario_passwordConfirm').value;
	editarUsuario(idUsuario,idRol,correoElectronico,password,passwordConfirm);
});

// ELIMINAR UN REGISTRO DE USUARIO-------------------------------------------------
$(document).on('click', '.Usuario_borrarRegistro', function(){
	var idUsuario = document.getElementById('editarUsuario_idUsuario').value;
	borrarUsuario(idUsuario);
});



$(document).on('click', '.registrarRelacionTutorAlumno', function(){
	$("#registrarRelacion_modal").modal("toggle");
});
$(document).on('click', '.crearRelacion_guardarCambios', function(){
	var idTutor = document.getElementById('crearRelacion_idTutor').value;
	var idAlumno = document.getElementById('crearRelacion_idAlumno').value;
	var tipoRelacion = document.getElementById('crearRelacion_tipoRelacion').value;
	crearRelacion(idTutor,idAlumno,tipoRelacion);
});

$(document).on('click', '.editarRelacion_guardarCambios', function(){
	var idR_tutor_alumno = document.getElementById('editarRelacion_idR_tutor_alumno').value;
	var tipoRelacion = document.getElementById('editarRelacion_tipoRelacion').value;
	editarRelacion(idR_tutor_alumno,tipoRelacion);
});

$(document).on('click', '.editarRelacion_borrarRegistro', function(){
	var idR_tutor_alumno = document.getElementById('editarRelacion_idR_tutor_alumno').value;
	borrarRelacion(idR_tutor_alumno);
});


// BUSQUEDA AJAX DE TRABAJADOR
$("#crearRelacion_idTutor").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/tutores/fetchTutor.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#tutorDrop_show_list").html(response);
			},
		});
	} else {
		$("#tutorDrop_show_list").html("");
	}
});
$(document).on("click", ".tutorSearch", function () {
	$("#crearRelacion_idTutor").val($(this).text());
	$("#tutorDrop_show_list").html("");
});

// BUSQUEDA AJAX DE ALUMNO
$("#crearRelacion_idAlumno").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/tutores/fetchAlumno.php",
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
	$("#crearRelacion_idAlumno").val($(this).text());
	$("#alumnoDrop_show_list").html("");
});