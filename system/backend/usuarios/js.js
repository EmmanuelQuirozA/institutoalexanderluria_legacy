//---------------------------------------------------------------------------------------------USUARIOS---------------------------------------------------------------------------------
var usuariosTable;
var personasTable;
var arrayUsuarios = [];
var textUsuarios;
$(document).ready(function(){
  usuariosTable = $('#usuariosTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
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
				url:'backend/usuarios_read.php'
		},
		columns: [
			{ data: 'idUsuario' },
			{ data: 'idRol' },
			{ data: 'idPersona' },
			{ data: 'username' },
			{ data: 'nombreCompleto' },
			{ data: 'nombreRol' },
			{ data: 'correoElectronico' }
		]
	});
	var usuariosnumCols = usuariosTable.init().columns.length;

	usuariosTable.on("dblclick", "tr",function(){
		arrayUsuarios.length=0;
		var usuariosidx = usuariosTable.fixedColumns().rowIndex( this );
		var aData = usuariosTable.row( usuariosidx ).data();
		for(var i=0;i<usuariosnumCols;i++){
			textUsuarios = usuariosTable.cell( usuariosidx, i ).data();
			arrayUsuarios.push(textUsuarios);
			// console.log(arrayUsuarios);
		};

		$("#editarUsuario_modal").modal("show");

		$('#editarUsuario_idUsuario').val(arrayUsuarios[0]);
    $('#editarUsuario_username').val(arrayUsuarios[3]);
    $('#editarUsuario_idRol').val(arrayUsuarios[1]);
    $('#editarUsuario_correoElectronico').val(arrayUsuarios[6]);
	});


  var arrayPersonas = [];
  var textPersonas;
  personasTable = $('#personasTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 0,2,3,4 ],
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
				url:'backend/personas_read.php'
		},
		columns: [
			{ data: 'idPersona' },
			{ data: 'nombreCompleto' },
			{ data: 'nombre' },
			{ data: 'apellidoPaterno' },
			{ data: 'apellidoMaterno' }
		]
	});
	var personasnumCols = personasTable.init().columns.length;

	personasTable.on("dblclick", "tr",function(){
		arrayPersonas.length=0;
		var personasidx = personasTable.fixedColumns().rowIndex( this );
		var aData = personasTable.row( personasidx ).data();
		for(var i=0;i<personasnumCols;i++){
			textPersonas = personasTable.cell( personasidx, i ).data();
			arrayPersonas.push(textPersonas);
			// // console.log(textPersonas);
		};

		$("#editarPersona_modal").modal("show");

		$('#editarPersona_idPersona').val(arrayPersonas[0]);
    $('#editarPersona_nombre').val(arrayPersonas[2]);
    $('#editarPersona_apellidoPaterno').val(arrayPersonas[3]);
    $('#editarPersona_apellidoMaterno').val(arrayPersonas[4]);
	});
});

// BUSQUEDA AJAX DE PERSONA
$("#crearUsuario_idPersona").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/usuarios/fetchPersona.php",
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


// REGISTRAR UN USUARIO-------------------------------------------------
$(document).on('click', '.registrarUsuario', function(){
	$("#registrarUsuario_modal").modal("toggle");
});
$(document).on('click', '.crearUsuario_guardarCambios', function(){
  var idPersona = document.getElementById('crearUsuario_idPersona').value;
	var username = document.getElementById('crearUsuario_username').value;
	var correoElectronico = document.getElementById('crearUsuario_correoElectronico').value;
	var idRol = document.getElementById('crearUsuario_idRol').value;
	var password = document.getElementById('crearUsuario_password').value;
	var passwordConfirm = document.getElementById('crearUsuario_passwordConfirm').value;
	crearUsuario(idPersona,username,correoElectronico,idRol,password,passwordConfirm);
});

// EDITAR UN REGISTRO DE USUARIO-------------------------------------------------
$(document).on('click', '.Usuario_editRegistro', function(){
  var idUsuario = document.getElementById('editarUsuario_idUsuario').value;
	var idRol = document.getElementById('editarUsuario_idRol').value;
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

// REGISTRAR PERSONA-------------------------------------------------
$(document).on('click', '.registrarPersona', function(){
	$("#crearPersona_modal").modal("toggle");
});
$(document).on('click', '.crearPersona_guardarCambios', function(){
  var nombre = document.getElementById('crearPersona_nombre').value;
	var apellidoPaterno = document.getElementById('crearPersona_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('crearPersona_apellidoMaterno').value;
	crearPersona(nombre,apellidoPaterno,apellidoMaterno);
});

// EDITAR UN REGISTRO DE PERSONA-------------------------------------------------
$(document).on('click', '.Persona_editRegistro', function(){
  var idPersona = document.getElementById('editarPersona_idPersona').value;
	var nombre = document.getElementById('editarPersona_nombre').value;
	var apellidoPaterno = document.getElementById('editarPersona_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('editarPersona_apellidoMaterno').value;
	editarPersona(idPersona,nombre,apellidoPaterno,apellidoMaterno);
});

// ELIMINAR UN REGISTRO DE PERSONA-------------------------------------------------
$(document).on('click', '.Persona_borrarRegistro', function(){
	var idPersona = document.getElementById('editarPersona_idPersona').value;
	borrarPersona(idPersona);
});