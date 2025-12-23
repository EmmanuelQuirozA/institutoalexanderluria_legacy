// BUSQUEDA AJAX DE TRABAJADOR
$("#crearMaterialeducativo_idGrupo").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/materialeducativo/fetchGrupo.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#idGrupoDrop_show_list").html(response);
			},
		});
	} else {
		$("#idGrupoDrop_show_list").html("");
	}
});
$(document).on("click", ".personaSearch", function () {
	$("#crearMaterialeducativo_idGrupo").val($(this).text());
	$("#idGrupoDrop_show_list").html("");
  const str = ($(this).text());

  const idGrupo = str.substring(0, str.indexOf('-'));
  $.ajax({
    url:"backend/materialeducativo/fetchGrupoData.php",
    type:"POST",
    data:{idGrupo:idGrupo},
    success: function(jsonresult){
      var json = $.parseJSON(jsonresult);
      $('#crearMaterialeducativo_idTrabajador').val(json.response.docente);
      $('#crearMaterialeducativo_idTrabajadorDisabled').val(json.response.docente);
      $('#crearMaterialeducativo_generacion').val(json.response.generacion);
      $('#crearMaterialeducativo_nivelEscolar').val(json.response.nivelEscolar);
      $('#crearMaterialeducativo_gradoyGrupo').val(json.response.gradoyGrupo);
    }
  });
});

//---------------------------------------------------------------------------------------------MATERIAS---------------------------------------------------------------------------------
var materialeducativoTable;
var arrayMaterialeducativo = [];
var textMaterialeducativo;
var path;
$(document).ready(function(){
  materialeducativoTable = $('#materialeducativoTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 0,1,2,11 ],
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
				url:'backend/materialeducativo_read.php'
		},
		columns: [
			{ data: 'idMaterialEducativo' },
			{ data: 'idGrupo' },
			{ data: 'idTrabajador' },
			{ data: 'generacion' },
			{ data: 'nivelEscolar' },
			{ data: 'gradoyGrupo' },
			{ data: 'nombreCompleto' },
			{ data: 'titulo' },
			{ data: 'descripcion' },
			{ data: 'tipoDocumento' },
			{ data: 'fechaSubido' },
			{ data: 'path' }
		]
	});
	var materialeducativonumCols = materialeducativoTable.init().columns.length;

	materialeducativoTable.on("dblclick", "tr",function(){
		arrayMaterialeducativo.length=0;
		var materialeducativoidx = materialeducativoTable.fixedColumns().rowIndex( this );
		var aData = materialeducativoTable.row( materialeducativoidx ).data();
		for(var i=0;i<materialeducativonumCols;i++){
			textMaterialeducativo = materialeducativoTable.cell( materialeducativoidx, i ).data();
			arrayMaterialeducativo.push(textMaterialeducativo);
			// console.log(arrayMaterialeducativo);
		};

		$("#editarMaterialeducativo_modal").modal("show");
    
    var idMaterialEducativo = arrayMaterialeducativo[0];
    var idGrupo = arrayMaterialeducativo[1];
    var idTrabajador = arrayMaterialeducativo[2];
    var nivelEscolar = arrayMaterialeducativo[3];
    var generacion = arrayMaterialeducativo[4];
    var gradoyGrupo = arrayMaterialeducativo[5];
    var nombreCompleto = arrayMaterialeducativo[6];
    var titulo = arrayMaterialeducativo[7];
    var descripcion = arrayMaterialeducativo[8];
    var tipoDocumento = arrayMaterialeducativo[9];
    var fechaSubido = arrayMaterialeducativo[10];
    // var path = arrayMaterialeducativo[11];
    path = arrayMaterialeducativo[11];
    $('#editarMaterialeducativo_idMaterialEducativo').val(idMaterialEducativo);
    $('#editarMaterialeducativo_idGrupo').val(idGrupo+" - "+generacion+" - "+nivelEscolar+" / "+gradoyGrupo);
    $('#editarMaterialeducativo_idTrabajador').val(nombreCompleto);
    $('#editarMaterialeducativo_generacion').val(generacion);
    $('#editarMaterialeducativo_nivelEscolar').val(nivelEscolar);
    $('#editarMaterialeducativo_gradoyGrupo').val(gradoyGrupo);
    $('#editarMaterialeducativo_titulo').val(titulo);
    $('#editarMaterialeducativo_descripcion').val(descripcion);
    document.getElementById('enlaceMaterialeducativo').setAttribute('href', path);
	});
});


// REGISTRAR UN MATERIA-------------------------------------------------
$(document).on('click', '.registrarMaterial', function(){
	$("#crearMaterialeducativo_modal").modal("toggle");
});
$(document).on('click', '.crearMaterialeducativo_guardarCambios', function(){
	var idGrupo = document.getElementById('crearMaterialeducativo_idGrupo').value;
	var idTrabajador = document.getElementById('crearMaterialeducativo_idTrabajador').value;
	var titulo = document.getElementById('crearMaterialeducativo_titulo').value;
	var descripcion = document.getElementById('crearMaterialeducativo_descripcion').value;
	var path = document.getElementById('crearMaterialeducativo_path').value;
	crearMaterialEducativo(idGrupo,idTrabajador,titulo,descripcion,path);
});

// EDITAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarMaterialeducativo_guardarCambios', function(){
	var idMaterialEducativo = document.getElementById('editarMaterialeducativo_idMaterialEducativo').value;
	var descripcion = document.getElementById('editarMaterialeducativo_descripcion').value;
	editarMaterialEducativo(idMaterialEducativo,descripcion);
});

// ELIMINAR UN REGISTRO DE MATERIA-------------------------------------------------
$(document).on('click', '.editarMaterialeducativo_borrarRegistro', function(){
	var idMaterialEducativo = document.getElementById('editarMaterialeducativo_idMaterialEducativo').value;
	// var path = document.getElementById('crearMaterialeducativo_path').value;
	eliminarMaterialEducativo(idMaterialEducativo,path);
});