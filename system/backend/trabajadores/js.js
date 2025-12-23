//---------------------------------------------------------------------------------------------TRABAJADORES---------------------------------------------------------------------------------
var trabajadoresTable;
var arrayTrabajadores = [];
var textTrabajadores;
//---------------------------------------------------------------------------------------------USUARIOS---------------------------------------------------------------------------------
var usuariosTable;
var personasTable;
var arrayUsuarios = [];
var textUsuarios;
$(document).ready(function(){
  trabajadoresTable = $('#trabajadoresTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 
				0,1,2,3,4,6,7,8,9,10,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34
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
				url:'backend/trabajadores_read.php'
		},
		columns: [
			{ data: 'idTrabajador' },
			{ data: 'idPersona' },
			{ data: 'nombre' },
			{ data: 'apellidoPaterno' },
			{ data: 'apellidoMaterno' },
			{ data: 'nombreCompleto' },
			{ data: 'noTrabajador' },
			{ data: 'referencia' },
			{ data: 'curp' },
			{ data: 'rfc' },
			{ data: 'noSeguro' },
			{ data: 'fechaNacimiento' },
			{ data: 'lugarNacimiento' },
			{ data: 'puesto' },
			{ data: 'sueldo' },
			{ data: 'banco' },
			{ data: 'noCuenta' },
			{ data: 'numeroCel' },
			{ data: 'fechaInicioLabores' },
			{ data: 'fechaFinLabores' },
			{ data: 'estadoCivil' },
			{ data: 'hijos' },
			{ data: 'calle' },
			{ data: 'numero' },
			{ data: 'colonia' },
			{ data: 'codigoPostal' },
			{ data: 'localidad' },
			{ data: 'estado' },
			{ data: 'egresadoDe' },
			{ data: 'universidad' },
			{ data: 'fechaEgreso' },
			{ data: 'maestria' },
			{ data: 'fechaEgresoMaestria' },
			{ data: 'aniosExperienciaLaboral' },
			{ data: 'saldo' }
		]
	});
	var trabajadoresnumCols = trabajadoresTable.init().columns.length;

	trabajadoresTable.on("dblclick", "tr",function(){
		arrayTrabajadores.length=0;
		var trabajadoresidx = trabajadoresTable.fixedColumns().rowIndex( this );
		var aData = trabajadoresTable.row( trabajadoresidx ).data();
		for(var i=0;i<trabajadoresnumCols;i++){
			textTrabajadores = trabajadoresTable.cell( trabajadoresidx, i ).data();
			arrayTrabajadores.push(textTrabajadores);
			// console.log(arrayTrabajadores);
		};

		$("#editarTrabajador_modal").modal("show");
		
		$('#crearUsuario_idPersona').val(arrayTrabajadores[1] + " - " +arrayTrabajadores[5]);

		$('#editarTrabajador_idTrabajador').val(arrayTrabajadores[0]);
		$('#editarTrabajador_idPersona').val(arrayTrabajadores[1]);
    
    nombreTrabajador=arrayTrabajadores[2];
    apellidoPaternoTrabajador=arrayTrabajadores[3];
    apellidoMaternoTrabajador=arrayTrabajadores[4];

		$('#editarTrabajador_nombre').val(arrayTrabajadores[2]);
		$('#editarTrabajador_apellidoPaterno').val(arrayTrabajadores[3]);
		$('#editarTrabajador_apellidoMaterno').val(arrayTrabajadores[4]);
		
		$('#editarTrabajador_noTrabajador').val(arrayTrabajadores[6]);
		$('#editarTrabajador_referencia').val(arrayTrabajadores[7]);
		$('#editarTrabajador_curp').val(arrayTrabajadores[8]);
		$('#editarTrabajador_rfc').val(arrayTrabajadores[9]);
		$('#editarTrabajador_noSeguro').val(arrayTrabajadores[10]);
		$('#editarTrabajador_fechaNacimiento').val(arrayTrabajadores[11]);
		$('#editarTrabajador_lugarNacimiento').val(arrayTrabajadores[12]);
		$('#editarTrabajador_puesto').val(arrayTrabajadores[13]);
		$('#editarTrabajador_sueldo').val(arrayTrabajadores[14]);
		$('#editarTrabajador_banco').val(arrayTrabajadores[15]);
		$('#editarTrabajador_noCuenta').val(arrayTrabajadores[16]);
		$('#editarTrabajador_numeroCel').val(arrayTrabajadores[17]);
		$('#editarTrabajador_fechaInicioLabores').val(arrayTrabajadores[18]);
		$('#editarTrabajador_fechaFinLabores').val(arrayTrabajadores[19]);
		$('#editarTrabajador_estadoCivil').val(arrayTrabajadores[20]);
		$('#editarTrabajador_hijos').val(arrayTrabajadores[21]);
		$('#editarTrabajador_calle').val(arrayTrabajadores[22]);
		$('#editarTrabajador_numero').val(arrayTrabajadores[23]);
		$('#editarTrabajador_colonia').val(arrayTrabajadores[24]);
		$('#editarTrabajador_codigoPostal').val(arrayTrabajadores[25]);
		$('#editarTrabajador_localidad').val(arrayTrabajadores[26]);
		$('#editarTrabajador_estado').val(arrayTrabajadores[27]);
		$('#editarTrabajador_egresadoDe').val(arrayTrabajadores[28]);
		$('#editarTrabajador_universidad').val(arrayTrabajadores[29]);
		$('#editarTrabajador_fechaEgreso').val(arrayTrabajadores[30]);
		$('#editarTrabajador_maestria').val(arrayTrabajadores[31]);
		$('#editarTrabajador_fechaEgresoMaestria').val(arrayTrabajadores[32]);
		$('#editarTrabajador_aniosExperienciaLaboral').val(arrayTrabajadores[33]);
	});


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
				url:'backend/usuariosTrabajadores_read.php'
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
});

// BUSQUEDA AJAX DE PERSONA
$("#crearUsuario_idPersona").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/trabajadores/fetchPersona.php",
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

// REGISTRAR UN TRABAJADOR-------------------------------------------------
$(document).on('click', '.registrarTrabajador', function(){
	$("#registrarTrabajador_modal").modal("toggle");
});

$(document).on('click', '.crearTrabajador_guardarCambios', function(){
	var nombre = document.getElementById('crearTrabajador_nombre').value;
	var apellidoPaterno = document.getElementById('crearTrabajador_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('crearTrabajador_apellidoMaterno').value;
	var noTrabajador = document.getElementById('crearTrabajador_noTrabajador').value;
	var fechaInicioLabores = document.getElementById('crearTrabajador_fechaInicioLabores').value;
	var fechaFinLabores = document.getElementById('crearTrabajador_fechaFinLabores').value;
	var puesto = document.getElementById('crearTrabajador_puesto').value;
	var sueldo = document.getElementById('crearTrabajador_sueldo').value;
	var banco = document.getElementById('crearTrabajador_banco').value;
	var noCuenta = document.getElementById('crearTrabajador_noCuenta').value;
	var referencia = document.getElementById('crearTrabajador_referencia').value;
	var curp = document.getElementById('crearTrabajador_curp').value;
	var rfc = document.getElementById('crearTrabajador_rfc').value;
	var noSeguro = document.getElementById('crearTrabajador_noSeguro').value;
	var fechaNacimiento = document.getElementById('crearTrabajador_fechaNacimiento').value;
	var lugarNacimiento = document.getElementById('crearTrabajador_lugarNacimiento').value;
	var estadoCivil = document.getElementById('crearTrabajador_estadoCivil').value;
	var hijos = document.getElementById('crearTrabajador_hijos').value;
	var numeroCel = document.getElementById('crearTrabajador_numeroCel').value;
	var calle = document.getElementById('crearTrabajador_calle').value;
	var numero = document.getElementById('crearTrabajador_numero').value;
	var colonia = document.getElementById('crearTrabajador_colonia').value;
	var codigoPostal = document.getElementById('crearTrabajador_codigoPostal').value;
	var localidad = document.getElementById('crearTrabajador_localidad').value;
	var estado = document.getElementById('crearTrabajador_estado').value;
	var egresadoDe = document.getElementById('crearTrabajador_egresadoDe').value;
	var universidad = document.getElementById('crearTrabajador_universidad').value;
	var fechaEgreso = document.getElementById('crearTrabajador_fechaEgreso').value;
	var maestria = document.getElementById('crearTrabajador_maestria').value;
	var fechaEgresoMaestria = document.getElementById('crearTrabajador_fechaEgresoMaestria').value;
	var aniosExperienciaLaboral = document.getElementById('crearTrabajador_aniosExperienciaLaboral').value;
	crearTrabajador(nombre,apellidoPaterno,apellidoMaterno,noTrabajador,fechaInicioLabores,fechaFinLabores,puesto,sueldo,banco,noCuenta,referencia,curp,rfc,noSeguro,fechaNacimiento,lugarNacimiento,estadoCivil,hijos,numeroCel,calle,numero,colonia,codigoPostal,localidad,estado,egresadoDe,universidad,fechaEgreso,maestria,fechaEgresoMaestria,aniosExperienciaLaboral);
});

// EDITAR UN TRABAJADOR-------------------------------------------------
$(document).on('click', '.editarTrabajador_guardarCambios', function(){
	var idTrabajador = document.getElementById('editarTrabajador_idTrabajador').value;
	var idPersona = document.getElementById('editarTrabajador_idPersona').value;
	var nombre = document.getElementById('editarTrabajador_nombre').value;
	var apellidoPaterno = document.getElementById('editarTrabajador_apellidoPaterno').value;
	var apellidoMaterno = document.getElementById('editarTrabajador_apellidoMaterno').value;
	var noTrabajador = document.getElementById('editarTrabajador_noTrabajador').value;
	var referencia = document.getElementById('editarTrabajador_referencia').value;
	var curp = document.getElementById('editarTrabajador_curp').value;
	var rfc = document.getElementById('editarTrabajador_rfc').value;
	var noSeguro = document.getElementById('editarTrabajador_noSeguro').value;
	var fechaNacimiento = document.getElementById('editarTrabajador_fechaNacimiento').value;
	var lugarNacimiento = document.getElementById('editarTrabajador_lugarNacimiento').value;
	var puesto = document.getElementById('editarTrabajador_puesto').value;
	var sueldo = document.getElementById('editarTrabajador_sueldo').value;
	var banco = document.getElementById('editarTrabajador_banco').value;
	var noCuenta = document.getElementById('editarTrabajador_noCuenta').value;
	var numeroCel = document.getElementById('editarTrabajador_numeroCel').value;
	var fechaInicioLabores = document.getElementById('editarTrabajador_fechaInicioLabores').value;
	var fechaFinLabores = document.getElementById('editarTrabajador_fechaFinLabores').value;
	var estadoCivil = document.getElementById('editarTrabajador_estadoCivil').value;
	var hijos = document.getElementById('editarTrabajador_hijos').value;
	var calle = document.getElementById('editarTrabajador_calle').value;
	var numero = document.getElementById('editarTrabajador_numero').value;
	var colonia = document.getElementById('editarTrabajador_colonia').value;
	var codigoPostal = document.getElementById('editarTrabajador_codigoPostal').value;
	var localidad = document.getElementById('editarTrabajador_localidad').value;
	var estado = document.getElementById('editarTrabajador_estado').value;
	var egresadoDe = document.getElementById('editarTrabajador_egresadoDe').value;
	var universidad = document.getElementById('editarTrabajador_universidad').value;
	var fechaEgreso = document.getElementById('editarTrabajador_fechaEgreso').value;
	var maestria = document.getElementById('editarTrabajador_maestria').value;
	var fechaEgresoMaestria = document.getElementById('editarTrabajador_fechaEgresoMaestria').value;
	var aniosExperienciaLaboral = document.getElementById('editarTrabajador_aniosExperienciaLaboral').value;
	editarTrabajador(idTrabajador,idPersona,nombre,apellidoPaterno,apellidoMaterno,noTrabajador,referencia,curp,rfc,noSeguro,fechaNacimiento,lugarNacimiento,puesto,sueldo,banco,noCuenta,numeroCel,fechaInicioLabores,fechaFinLabores,estadoCivil,hijos,calle,numero,colonia,codigoPostal,localidad,estado,egresadoDe,universidad,fechaEgreso,maestria,fechaEgresoMaestria,aniosExperienciaLaboral,nombreTrabajador,apellidoPaternoTrabajador,apellidoMaternoTrabajador);
});

$(document).on('click', '.editarTrabajador_borrarRegistro', function(){
	var idPersona = document.getElementById('editarTrabajador_idPersona').value;
	borrarTrabajador(idPersona);
});

// REGISTRAR UN USUARIO-------------------------------------------------
$(document).on('click', '.registrarUsuario', function(){
	$("#editarTrabajador_modal").modal("hide");
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