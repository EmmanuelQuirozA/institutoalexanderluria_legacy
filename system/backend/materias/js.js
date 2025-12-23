//---------------------------------------------------------------------------------------------MATERIAS---------------------------------------------------------------------------------
var materiasTable;
var arrayMaterias = [];
var textMaterias;
$(document).ready(function(){
  materiasTable = $('#materiasTable').DataTable({
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
				url:'backend/materias_read.php'
		},
		columns: [
			{ data: 'idMateria' },
			{ data: 'clave' },
			{ data: 'materia' },
			{ data: 'nivelEscolar' },
			{ data: 'grado' }
		]
	});
	var materiasnumCols = materiasTable.init().columns.length;

	materiasTable.on("dblclick", "tr",function(){
		arrayMaterias.length=0;
		var materiasidx = materiasTable.fixedColumns().rowIndex( this );
		var aData = materiasTable.row( materiasidx ).data();
		for(var i=0;i<materiasnumCols;i++){
			textMaterias = materiasTable.cell( materiasidx, i ).data();
			arrayMaterias.push(textMaterias);
			// console.log(arrayMaterias);
		};

		$("#editarMateria_modal").modal("show");
    
    $('#editarMateria_idMateria').val(arrayMaterias[0]);
    $('#editarMateria_clave').val(arrayMaterias[1]);
    $('#editarMateria_materia').val(arrayMaterias[2]);
    $('#editarMateria_nivelEscolar').val(arrayMaterias[3]);
    $('#editarMateria_grado').val(arrayMaterias[4]);
	});
});


// REGISTRAR UN MATERIA-------------------------------------------------
$(document).on('click', '.registrarMateria', function(){
	$("#registrarMateria_modal").modal("toggle");
});
$(document).on('click', '.crearMateria_guardarCambios', function(){
	var clave = document.getElementById('crearMateria_clave').value;
	var materia = document.getElementById('crearMateria_materia').value;
	var nivelEscolar = document.getElementById('crearMateria_nivelEscolar').value;
	var grado = document.getElementById('crearMateria_grado').value;
	crearMateria(clave,materia,nivelEscolar,grado);
});

// EDITAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.Materia_editRegistro', function(){
  var idMateria = document.getElementById('editarMateria_idMateria').value;
	var clave = document.getElementById('editarMateria_clave').value;
	var materia = document.getElementById('editarMateria_materia').value;
	var nivelEscolar = document.getElementById('editarMateria_nivelEscolar').value;
	var grado = document.getElementById('editarMateria_grado').value;
	editarMateria(idMateria,clave,materia,nivelEscolar,grado);
});

// ELIMINAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.Materia_borrarRegistro', function(){
	var idMateria = document.getElementById('editarMateria_idMateria').value;
	borrarMateria(idMateria);
});