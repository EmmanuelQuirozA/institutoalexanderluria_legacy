//---------------------------------------------------------------------------------------------CONFIGURACION---------------------------------------------------------------------------------
var idRol;
var rolesTable;
var modulosTable;
$(document).ready(function(){
  var arrayRoles = [];
  var textRoles;
  rolesTable = $('#rolesTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 0,2 ],
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
				url:'backend/roles_read.php'
		},
		columns: [
			{ data: 'idRol' },
			{ data: 'nombreRol' },
			{ data: 'descripcion' }
		]
	});
	var numCols = rolesTable.init().columns.length;

	rolesTable.on("dblclick", "tr",function(){
		arrayRoles.length=0;
		var idx = rolesTable.fixedColumns().rowIndex( this );
		var aData = rolesTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			textRoles = rolesTable.cell( idx, i ).data();
			arrayRoles.push(textRoles);
			// console.log(textRoles);
		};


		$("#editarRol_modal").modal("show");
    $('#editarRol_idRol').val(arrayRoles[0]);
		idRol=arrayRoles[0];

		$.ajax({
			url: "backend/configuracion/fetchPermisos.php",
			method: "post",
			data: {
				idRol:idRol
			},
			success: function (response) {
				$("#modulosTabla").html(response);
			}
		});

	});



	// -----------------------------------------------------------------------------------------------------------------------------------------------------------------
  var arrayModulos = [];
  var textModulos;
  modulosTable = $('#modulosTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 0,2 ],
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
				url:'backend/modulos_read.php'
		},
		columns: [
			{ data: 'idModulo' },
			{ data: 'nombre' },
			{ data: 'descripcion' }
		]
	});
	var numCols = modulosTable.init().columns.length;

	modulosTable.on("dblclick", "tr",function(){
		arrayModulos.length=0;
		var idx = modulosTable.fixedColumns().rowIndex( this );
		var aData = modulosTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			textModulos = modulosTable.cell( idx, i ).data();
			arrayModulos.push(textModulos);
			// console.log(textModulos);
		};

		$("#editarModulo_modal").modal("show");
    $('#editarModulo_idModulo').val(arrayModulos[0]);
    $('#editarModulo_nombre').val(arrayModulos[1]);
    $('#editarModulo_descripcion').val(arrayModulos[2]);
	});

	var arrayCiclosEscolares = [];
  var textCiclosEscolares;
  ciclosEscolaresTable = $('#ciclosEscolaresTable').DataTable({
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
				url:'backend/ciclosEscolares_read.php'
		},
		columns: [
			{ data: 'idCicloEscolar' },
			{ data: 'cicloEscolar' },
			{ data: 'fechaInicio' },
			{ data: 'fechaFin' }
		]
	});
	var numColsCiclosEscolares = ciclosEscolaresTable.init().columns.length;

	ciclosEscolaresTable.on("dblclick", "tr",function(){
		arrayCiclosEscolares.length=0;
		var idx = ciclosEscolaresTable.fixedColumns().rowIndex( this );
		var aData = ciclosEscolaresTable.row( idx ).data();
		for(var i=0;i<numColsCiclosEscolares;i++){
			textCiclosEscolares = ciclosEscolaresTable.cell( idx, i ).data();
			arrayCiclosEscolares.push(textCiclosEscolares);
			// console.log(textCiclosEscolares);
		};
	});
	
});




// ----------------------------------------------------------------------------------------------------Roles----------------------------------------------------------------------------------------------------
$(document).on('click', '.editarRol_guardarCambios', function(){
	editarRol();
});

$(document).on('click', '.crearRol', function(){
	$("#crearRol_modal").modal("toggle");
});

$(document).on('click', '.editarRol_relacionarModulo', function(){
	$("#relacionarModulo_modal").modal("toggle");
});

$(document).on('click', '.crearRol_guardarCambios', function(){
	var nombreRol = document.getElementById('crearRol_nombreRol').value;
	var descripcion = document.getElementById('crearRol_descripcion').value;
	crearRol(nombreRol,descripcion);
});

$(document).on('click', '.relacionarModulo_guardarCambios', function(){
	var idRol = document.getElementById('editarRol_idRol').value;
	var idModulo = document.getElementById('relacionarModulo_modulo').value;
	relacionarModulo(idRol,idModulo);
});

$(document).on('click', '.editarRol_borrarRegistro', function(){
	var idRol = document.getElementById('editarRol_idRol').value;
	borrarRol(idRol);
});
// ----------------------------------------------------------------------------------------------------Roles----------------------------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------------------------Modulos----------------------------------------------------------------------------------------------------
$(document).on('click', '.crearModulo', function(){
	$("#crearModulo_modal").modal("toggle");
});

$(document).on('click', '.crearModulo_guardarCambios', function(){
	var nombre = document.getElementById('crearModulo_nombre').value;
	var descripcion = document.getElementById('crearModulo_descripcion').value;
  crearModulo(nombre,descripcion);
});

$(document).on('click', '.editarModulo_guardarCambios', function(){
	var idModulo = document.getElementById('editarModulo_idModulo').value;
	var nombre = document.getElementById('editarModulo_nombre').value;
	var descripcion = document.getElementById('editarModulo_descripcion').value;
	editarModulo(idModulo,nombre,descripcion);
});

$(document).on('click', '.editarModulo_borrarRegistro', function(){
	var idModulo = document.getElementById('editarModulo_idModulo').value;
	borrarModulo(idModulo);
});



// ----------------------------------------------------------------------------------------------------CICLO ESCOLAR----------------------------------------------------------------------------------------------------
$(document).on('click', '.crearCicloEscolar', function(){
	$("#crearCicloEscolar_modal").modal("toggle");
});


$("#crearCicloEscolar_fechaInicio").change(function(){
	fechaInicio = document.getElementById('crearCicloEscolar_fechaInicio').value;
	$('#crearCicloEscolar_cicloEscolar').val(fechaInicio.substring(0,4)+"-"+fechaFin.substring(0,4));
	$('#crearCicloEscolar_cicloEscolarDisabled').val(fechaInicio.substring(0,4)+"-"+fechaFin.substring(0,4));
});
$("#crearCicloEscolar_fechaFin").change(function(){
	fechaFin = document.getElementById('crearCicloEscolar_fechaFin').value;
	$('#crearCicloEscolar_cicloEscolar').val(fechaInicio.substring(0,4)+"-"+fechaFin.substring(0,4));
	$('#crearCicloEscolar_cicloEscolarDisabled').val(fechaInicio.substring(0,4)+"-"+fechaFin.substring(0,4));
});

$(document).on('click', '.crearCicloEscolar_guardarCambios', function(){
	var cicloEscolar = document.getElementById('crearCicloEscolar_cicloEscolar').value;
	var fechaInicio = document.getElementById('crearCicloEscolar_fechaInicio').value;
	var fechaFin = document.getElementById('crearCicloEscolar_fechaFin').value;
	crearCicloEscolar(cicloEscolar,fechaInicio,fechaFin);
});