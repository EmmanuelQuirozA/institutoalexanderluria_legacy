//---------------------------------------------------------------------------------------------GRUPOS---------------------------------------------------------------------------------
var gruposTable;
var arrayGrupos = [];
var textGrupos;
var estatusGrupo;

var mySwitch = new Switchery($('#editarGrupo_cambiarEstado')[0], {
  size:"small",
  color: 'green'
});

$(document).ready(function(){
	cargarGrupos();
	cargarGeneracion();

  gruposTable = $('#gruposTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
		columnDefs: [{
			targets: [ 0,1,2,3 ],
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
				url:'backend/grupos_read.php'
		},
		columns: [
			{ data: 'idGrupo' },
			{ data: 'idTrabajador' },
			{ data: 'grado' },
			{ data: 'grupo' },
			{ data: 'nombreCompleto' },
			{ data: 'generacion' },
			{ data: 'nivelEscolar' },
			{ data: 'gradoyGrupo' },
			{ data: 'salon' },
      { data: 'estadoGrupo' }
		],
		"rowCallback": function( row, data, index ) {
			if (data.estadoGrupo == "Inactivo") {
				$('td', row).css('background-color', '#ffd8d8');
			}
		}
	});
	var gruposnumCols = gruposTable.init().columns.length;

	gruposTable.on("dblclick", "tr",function(){
		arrayGrupos.length=0;
		var gruposidx = gruposTable.fixedColumns().rowIndex( this );
		var aData = gruposTable.row( gruposidx ).data();
		for(var i=0;i<gruposnumCols;i++){
			textGrupos = gruposTable.cell( gruposidx, i ).data();
			arrayGrupos.push(textGrupos);
			// console.log(arrayGrupos);
		};

		$("#editarGrupo_modal").modal("show");


    $('#editarGrupo_idGrupo').val(arrayGrupos[0]);
    // $('#').val(arrayGrupos[1]);
    $('#editarGrupo_grado').val(arrayGrupos[2]);
    $('#editarGrupo_grupo').val(arrayGrupos[3]);
    $('#editarGrupo_idTrabajador').val(arrayGrupos[4]);
    $('#editarGrupo_generacion').val(arrayGrupos[5]);
    $('#editarGrupo_nivelEscolar').val(arrayGrupos[6]);
    // $('#editarGrupo_gradoyGrupo').val(arrayGrupos[7]);
    $('#editarGrupo_salon').val(arrayGrupos[8]);
		estatusGrupo=arrayGrupos[9];
		if(estatusGrupo=="Activo"){
      setSwitchery(mySwitch, true);
		}else{
      setSwitchery(mySwitch, false);
    };
		

	});
});

function setSwitchery(switchElement, checkedBool) {
  if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
      switchElement.setPosition(true);
  }
}

var gruposMateriasTable;
var arraygruposMaterias = [];
var textgruposMaterias;

/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
  gruposMateriasTable = $('#gruposMateriasTable').DataTable({
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
			url:'backend/materiasGrupos_read.php'
			,
			type:"POST",
      'data': function(data){
        // Read values}
        var searchBygeneracion = $('#searchBygeneracion').val();
        var searchBynivelEscolar = $('#searchBynivelEscolar').val();
        var searchBygradoyGrupo = $('#searchBygradoyGrupo').val();
        // Append to data}
        data.searchBygeneracion=searchBygeneracion;
        data.searchBynivelEscolar=searchBynivelEscolar;
        data.searchBygradoyGrupo=searchBygradoyGrupo;
      }
		},

		columns: [
      { data: 'idHorario' },
      { data: 'generacion' },
      { data: 'nivelEscolar' },
      { data: 'gradoyGrupo' },
      { data: 'horas' },
      { data: 'Lunes' },
      { data: 'Martes' },
      { data: 'Miercoles' },
      { data: 'Jueves' },
      { data: 'Viernes' },
      { data: 'Sabado' }
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
        sheetName: 'Tabla exportada de gruposMaterias',
        title: 'Tabla gruposMaterias'
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de gruposMaterias',
        title: 'Tabla gruposMaterias'
      }
    ]
  });

	$('#searchBynivelEscolar').change(function(){
		gruposMateriasTable.draw();
	});
	$('#searchBygradoyGrupo').change(function(){
		gruposMateriasTable.draw();
	});
	$('#searchBygeneracion').change(function(){
		gruposMateriasTable.draw();
	});
	
	var numCols = gruposMateriasTable.init().columns.length;
	
	gruposMateriasTable.on("dblclick", "tr",function(){
		arraygruposMaterias.length=0;
		var idx = gruposMateriasTable.fixedColumns().rowIndex( this );
		var aData = gruposMateriasTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			textgruposMaterias = gruposMateriasTable.cell( idx, i ).data();
			arraygruposMaterias.push(textgruposMaterias);
		};
		$("#borrarHorario_modal").modal("show");
		//--------------------PAGO MODAL----------------------
		//--------------------PAGO MODAL----------------------
		document.getElementById('Horario').innerHTML = arraygruposMaterias[4];
		document.getElementById('Lunes').innerHTML = arraygruposMaterias[5];
		document.getElementById('Martes').innerHTML = arraygruposMaterias[6];
		document.getElementById('Miércoles').innerHTML = arraygruposMaterias[7];
		document.getElementById('Jueves').innerHTML = arraygruposMaterias[8];
		document.getElementById('Viernes').innerHTML = arraygruposMaterias[9];
		document.getElementById('Sábado').innerHTML = arraygruposMaterias[10];

		horaInicio=arraygruposMaterias[4].substring(0, 5);
		horaFin=arraygruposMaterias[4].substring(8);
		
	});
});


// BUSQUEDA AJAX DE TRABAJADOR
$("#crearGrupo_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/grupos/fetchDocente.php",
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
	$("#crearGrupo_idTrabajador").val($(this).text());
	$("#personaDrop_show_list").html("");
});

// BUSQUEDA AJAX DE TRABAJADOR
$("#editarGrupo_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/grupos/fetchDocente.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#editarpersonaDrop_show_list").html(response);
			},
		});
	} else {
		$("#editarpersonaDrop_show_list").html("");
	}
});
$(document).on("click", ".personaSearch", function () {
	$("#editarGrupo_idTrabajador").val($(this).text());
	$("#editarpersonaDrop_show_list").html("");
});

// BUSQUEDA AJAX DE TRABAJADOR
$("#relacionarMateria_idTrabajador").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/grupos/fetchDocente.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#relacionarMateriaDrop_show_list").html(response);
			},
		});
	} else {
		$("#relacionarMateriaDrop_show_list").html("");
	}
});
$(document).on("click", ".personaSearch", function () {
	$("#relacionarMateria_idTrabajador").val($(this).text());
	$("#relacionarMateriaDrop_show_list").html("");
});

// REGISTRAR UN GRUPO-------------------------------------------------
$(document).on('click', '.registrarGrupo', function(){
	$("#registrarGrupo_modal").modal("toggle");
});
$(document).on('click', '.crearGrupo_guardarCambios', function(){
	var idTrabajador = document.getElementById('crearGrupo_idTrabajador').value;
	var generacion = document.getElementById('crearGrupo_generacion').value;
	var nivelEscolar = document.getElementById('crearGrupo_nivelEscolar').value;
	var grado = document.getElementById('crearGrupo_grado').value;
	var grupo = document.getElementById('crearGrupo_grupo').value;
	var salon = document.getElementById('crearGrupo_salon').value;
	crearGrupo(idTrabajador,generacion,nivelEscolar,grado,grupo,salon);
	cargarGrupos();
	cargarGeneracion();
});

// EDITAR UN REGISTRO DE GRUPO-------------------------------------------------
$(document).on('click', '.Grupo_editRegistro', function(){
  var idGrupo = document.getElementById('editarGrupo_idGrupo').value;
	var grado = document.getElementById('editarGrupo_grado').value;
	var grupo = document.getElementById('editarGrupo_grupo').value;
	var idTrabajador = document.getElementById('editarGrupo_idTrabajador').value;
	var generacion = document.getElementById('editarGrupo_generacion').value;
	var nivelEscolar = document.getElementById('editarGrupo_nivelEscolar').value;
	var salon = document.getElementById('editarGrupo_salon').value;
	editarGrupo(idGrupo,grado,grupo,idTrabajador,generacion,nivelEscolar,salon);
	cargarGrupos();
	cargarGeneracion();
});

// ELIMINAR UN REGISTRO DE GRUPO-------------------------------------------------
$(document).on('click', '.Grupo_borrarRegistro', function(){
	var idGrupo = document.getElementById('editarGrupo_idGrupo').value;
	borrarGrupo(idGrupo);
	cargarGrupos();
	cargarGeneracion();
});



$(document).on('click', '.editarGrupo_relacionarMateria', function(){
	var nivelEscolar = document.getElementById('editarGrupo_nivelEscolar').value;
	var grado = document.getElementById('editarGrupo_grado').value;

	$.ajax({
		type: 'post',
		url: 'backend/grupos/fetchMaterias.php',
		data: {
			nivelEscolar: nivelEscolar,
			grado: grado
		},
		success: function (response) {
			document.getElementById("relacionarMateria_idMateria").innerHTML=response; 
		}
	});

	$("#relacionarMateria_modal").modal("toggle");
});


$(document).on('click', '.relacionarMateria_guardarCambios', function(){
  var idGrupo = document.getElementById('editarGrupo_idGrupo').value;
  var idTrabajador = document.getElementById('relacionarMateria_idTrabajador').value;
  var idMateria = document.getElementById('relacionarMateria_idMateria').value;
  var horaInicio = document.getElementById('relacionarMateria_horaInicio').value;
  var horaFin = document.getElementById('relacionarMateria_horaFin').value;
  var dia = document.getElementById('relacionarMateria_dia').value;
	relacionarMateria_Grupo(idGrupo,idTrabajador,idMateria,horaInicio,horaFin,dia)
});

$(document).on('click', '.Horario_borrarRegistro', function(){
	borrarHorario(horaInicio,horaFin);
});

$("#editarGrupo_cambiarEstado").change(function(){
  var idGrupo = document.getElementById('editarGrupo_idGrupo').value;
  cambiarEstatusGrupo(idGrupo,estatusGrupo);
	cargarGrupos();
	cargarGeneracion();
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