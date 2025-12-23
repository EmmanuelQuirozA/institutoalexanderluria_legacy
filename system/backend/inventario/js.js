var inventarioTable;
var arrayInventario = [];
var textInventario;

var entradasTable;
var arrayEntradas = [];
var textEntradas;

var salidasTable;
var arraySalidas = [];
var textSalidas;


var idsInventario = [ 
  '#searchBydescripcion',
  '#searchByexistencia',
  '#searchByunidad',
  '#searchByprecioCompra',
  '#searchByprecioSugerido',
  '#searchByfechaAlta',
  '#searchByusername'
];

var idsEntradas = [ 
  '#entrada_searchBydescripcion',
  '#entrada_searchByunidad',
  '#entrada_searchByfechaEntrada',
  '#entrada_searchBycantidad',
  '#entrada_searchBycostoUnitario',
  '#entrada_searchBytotal',
  '#entrada_searchByproveedor',
  '#entrada_searchByobservaciones',
  '#entrada_searchByusername'
];

var idsSalidas = [ 
  '#salida_searchBydescripcion',
  '#salida_searchByunidad',
  '#salida_searchByfechaSalida',
  '#salida_searchBycantidad',
  '#salida_searchBycostoUnitario',
  '#salida_searchBytotal',
  '#salida_searchBynombreCompleto',
  '#salida_searchByobservaciones',
  '#salida_searchByusername'
];


$(document).ready(function(){
  inventarioTable = $('#inventarioTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,1 ],
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
			url:'backend/inventario_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBydescripcion = $('#searchBydescripcion').val();
        var searchByexistencia = $('#searchByexistencia').val();
        var searchByunidad = $('#searchByunidad').val();
        var searchByprecioCompra = $('#searchByprecioCompra').val();
        var searchByprecioSugerido = $('#searchByprecioSugerido').val();
        var searchByfechaAlta = $('#searchByfechaAlta').val();
        var searchByusername = $('#searchByusername').val();
        // Append to data
        data.searchBydescripcion=searchBydescripcion;
        data.searchByexistencia=searchByexistencia;
        data.searchByunidad=searchByunidad;
        data.searchByprecioCompra=searchByprecioCompra;
        data.searchByprecioSugerido=searchByprecioSugerido;
        data.searchByfechaAlta=searchByfechaAlta;
        data.searchByusername=searchByusername;
      }
		},

		columns: [
      { data: 'idInventario' },
      { data: 'idUsuario' },
      { data: 'descripcion' },
      { data: 'existencia' },
      { data: 'unidad' },
      { data: 'precioCompra' },
      { data: 'precioSugerido' },
      { data: 'fechaAlta' },
      { data: 'username' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        text: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [ 2,3,4,5,6,7,8 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de inventario',
        title: 'Tabla inventario',
        exportOptions: {
          columns: [ 2,3,4,5,6,7,8 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de inventario',
        title: 'Tabla inventario',
        exportOptions: {
          columns: [ 2,3,4,5,6,7,8 ]
        }
      }
    ]
  });

  idsInventario.forEach(function(id) {
    $(id).keyup(function(){
      inventarioTable.draw();
    });
  });

	var numColsInventario = inventarioTable.init().columns.length;
	
	inventarioTable.on("dblclick", "tr",function(){
		arrayInventario.length=0;
		var idx = inventarioTable.fixedColumns().rowIndex( this );
		var aData = inventarioTable.row( idx ).data();
		for(var i=0;i<numColsInventario;i++){
			textEntradas = inventarioTable.cell( idx, i ).data();
			arrayInventario.push(textEntradas);
			// console.log(textEntradas);
		};
		$("#editInventario_modal").modal("show");

    var idInventario = arrayInventario[0];
    var idUsuario = arrayInventario[1];
    var descripcion = arrayInventario[2];
    var existencia = arrayInventario[3];
    var unidad = arrayInventario[4];
    var precioCompra = arrayInventario[5];
    var precioSugerido = arrayInventario[6];
    var fechaAlta = arrayInventario[7];
    var username = arrayInventario[8];
    
    $('#editInventario_idInventario').val(idInventario);
    $('#editInventario_descripcion').val(descripcion);
    $('#editInventario_unidad').val(unidad);
    $('#editInventario_precioCompra').val(precioCompra);
    $('#editInventario_precioSugerido').val(precioSugerido);
	});



  
  entradasTable = $('#entradasTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
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
			url:'backend/entradas_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBydescripcion = $('#entrada_searchBydescripcion').val();
        var searchByunidad = $('#entrada_searchByunidad').val();
        var searchByfechaEntrada = $('#entrada_searchByfechaEntrada').val();
        var searchBycantidad = $('#entrada_searchBycantidad').val();
        var searchBycostoUnitario = $('#entrada_searchBycostoUnitario').val();
        var searchBytotal = $('#entrada_searchBytotal').val();
        var searchByproveedor = $('#entrada_searchByproveedor').val();
        var searchByobservaciones = $('#entrada_searchByobservaciones').val();
        var searchByusername = $('#entrada_searchByusername').val();
        // Append to data
        data.searchBydescripcion=searchBydescripcion;
        data.searchByunidad=searchByunidad;
        data.searchByfechaEntrada=searchByfechaEntrada;
        data.searchBycantidad=searchBycantidad;
        data.searchBycostoUnitario=searchBycostoUnitario;
        data.searchBytotal=searchBytotal;
        data.searchByproveedor=searchByproveedor;
        data.searchByobservaciones=searchByobservaciones;
        data.searchByusername=searchByusername;
      }
		},

		columns: [
      { data: 'idEntrada' },
      { data: 'idInventario' },
      { data: 'idEgreso' },
      { data: 'idUsuario' },
      { data: 'descripcion' },
      { data: 'unidad' },
      { data: 'fechaEntrada' },
      { data: 'cantidad' },
      { data: 'costoUnitario' },
      { data: 'total' },
      { data: 'proveedor' },
      { data: 'observaciones' },
      { data: 'username' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        text: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de entradas',
        title: 'Tabla entradas',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de entradas',
        title: 'Tabla entradas',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      }
    ]
  });

  idsEntradas.forEach(function(id) {
    $(id).keyup(function(){
      entradasTable.draw();
    });
  });

	var numColsEntradas = entradasTable.init().columns.length;
	
	entradasTable.on("dblclick", "tr",function(){
		arrayEntradas.length=0;
		var idx = entradasTable.fixedColumns().rowIndex( this );
		var aData = entradasTable.row( idx ).data();
		for(var i=0;i<numColsEntradas;i++){
			textEntradas = entradasTable.cell( idx, i ).data();
			arrayEntradas.push(textEntradas);
			// console.log(textEntradas);
		};
		$("#editEntrada_modal").modal("show");

    var idEntrada = arrayEntradas[0];
    var idInventario = arrayEntradas[1];
    var idEgreso = arrayEntradas[2];
    var idUsuario = arrayEntradas[3];
    var descripcion = arrayEntradas[4];
    var unidad = arrayEntradas[5];
    var fechaEntrada = arrayEntradas[6];
    var cantidad = arrayEntradas[7];
    var costoUnitario = arrayEntradas[8];
    var total = arrayEntradas[9];
    var proveedor = arrayEntradas[10];
    var observaciones = arrayEntradas[11];
    var username = arrayEntradas[12];
    
    $('#editEntrada_idEntrada').val(idEntrada);
    $('#editEntrada_idInventario').val(idInventario);
    $('#editEntrada_descripcion').val(descripcion);
    $('#editEntrada_cantidad').val(cantidad);
    $('#editEntrada_costoUnitario').val(costoUnitario);
    $('#editEntrada_proveedor').val(proveedor);
    $('#editEntrada_observaciones').val(observaciones);
	});



  
  salidasTable = $('#salidasTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
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
			url:'backend/salidas_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBydescripcion = $('#salida_searchBydescripcion').val();
        var searchByunidad = $('#salida_searchByunidad').val();
        var searchByfechaSalida = $('#salida_searchByfechaSalida').val();
        var searchBycantidad = $('#salida_searchBycantidad').val();
        var searchBycostoUnitario = $('#salida_searchBycostoUnitario').val();
        var searchBytotal = $('#salida_searchBytotal').val();
        var searchBynombreCompleto = $('#salida_searchBynombreCompleto').val();
        var searchByobservaciones = $('#salida_searchByobservaciones').val();
        var searchByusername = $('#salida_searchByusername').val();
        // Append to data
        data.searchBydescripcion=searchBydescripcion;
        data.searchByunidad=searchByunidad;
        data.searchByfechaSalida=searchByfechaSalida;
        data.searchBycantidad=searchBycantidad;
        data.searchBycostoUnitario=searchBycostoUnitario;
        data.searchBytotal=searchBytotal;
        data.searchBynombreCompleto=searchBynombreCompleto;
        data.searchByobservaciones=searchByobservaciones;
        data.searchByusername=searchByusername;
      }
		},

		columns: [
      { data: 'idSalida' },
      { data: 'idInventario' },
      { data: 'idUsuario' },
      { data: 'idAlumno' },
      { data: 'descripcion' },
      { data: 'unidad' },
      { data: 'fechaSalida' },
      { data: 'cantidad' },
      { data: 'costoUnitario' },
      { data: 'total' },
      { data: 'nombreCompleto' },
      { data: 'observaciones' },
      { data: 'username' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        text: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de salidas',
        title: 'Tabla salidas',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de salidas',
        title: 'Tabla salidas',
        exportOptions: {
          columns: [ 4,5,6,7,8,9,10,11,12 ]
        }
      }
    ]
  });

  idsSalidas.forEach(function(id) {
    $(id).keyup(function(){
      salidasTable.draw();
    });
  });

	var numColsSalidas = salidasTable.init().columns.length;
	
	salidasTable.on("dblclick", "tr",function(){
		arraySalidas.length=0;
		var idx = salidasTable.fixedColumns().rowIndex( this );
		var aData = salidasTable.row( idx ).data();
		for(var i=0;i<numColsSalidas;i++){
			textSalidas = salidasTable.cell( idx, i ).data();
			arraySalidas.push(textSalidas);
			// console.log(textSalidas);
		};
		$("#editSalida_modal").modal("show");

    var idSalida = arraySalidas[0];
    var idInventario = arraySalidas[1];
    var idUsuario = arraySalidas[2];
    var idAlumno = arraySalidas[3];
    var descripcion = arraySalidas[4];
    var unidad = arraySalidas[5];
    var fechaSalida = arraySalidas[6];
    var cantidad = arraySalidas[7];
    var costoUnitario = arraySalidas[8];
    var total = arraySalidas[9];
    var nombreCompleto = arraySalidas[10];
    var observaciones = arraySalidas[11];
    var username = arraySalidas[12];

    $('#editSalida_idSalida').val(idSalida);
    $('#editSalida_idInventario').val(idInventario);
    $('#editSalida_descripcion').val(descripcion);
    $('#editSalida_idAlumno').val(nombreCompleto);
    $('#editSalida_cantidad').val(cantidad);
    $('#editSalida_costoUnitario').val(costoUnitario);
    $('#editSalida_observaciones').val(observaciones);
	});
});


$(document).on('click', '.registrarInventario', function(){
	$("#registrarInventario_modal").modal("toggle");
});
$(document).on('click', '.registrarEntrada', function(){
	$("#registrarEntrada_modal").modal("toggle");
});
$(document).on('click', '.registrarSalida', function(){
	$("#registrarSalida_modal").modal("toggle");
});


$(document).on('click', '.crearInventario_guardarCambios', function(){
  var descripcion = document.getElementById('crearInventario_descripcion').value;
  var unidad = document.getElementById('crearInventario_unidad').value;
  var precioCompra = document.getElementById('crearInventario_precioCompra').value;
  var precioSugerido = document.getElementById('crearInventario_precioSugerido').value;
  crearInventario(descripcion,unidad,precioCompra,precioSugerido);
});
$(document).on('click', '.crearEntrada_guardarCambios', function(){
  var idInventario = document.getElementById('crearEntrada_idInventario').value;
  var cantidad = document.getElementById('crearEntrada_cantidad').value;
  var costoUnitario = document.getElementById('crearEntrada_costoUnitario').value;
  var proveedor = document.getElementById('crearEntrada_proveedor').value;
  var observaciones = document.getElementById('crearEntrada_observaciones').value;
  crearEntrada(idInventario,cantidad,costoUnitario,proveedor,observaciones);
});
$(document).on('click', '.crearSalida_guardarCambios', function(){
  var idInventario = document.getElementById('crearSalida_idInventario').value;
  var idAlumno = document.getElementById('crearSalida_idAlumno').value;
  var cantidad = document.getElementById('crearSalida_cantidad').value;
  var costoUnitario = document.getElementById('crearSalida_costoUnitario').value;
  var observaciones = document.getElementById('crearSalida_observaciones').value;
  crearSalida(idInventario,idAlumno,cantidad,costoUnitario,observaciones);
});

$(document).on('click', '.editInventario_guardarCambios', function(){
  var idInventario = document.getElementById('editInventario_idInventario').value;
  var descripcion = document.getElementById('editInventario_descripcion').value;
  var unidad = document.getElementById('editInventario_unidad').value;
  var precioCompra = document.getElementById('editInventario_precioCompra').value;
  var precioSugerido = document.getElementById('editInventario_precioSugerido').value;
  editarInventario(idInventario,descripcion,unidad,precioCompra,precioSugerido)
});
$(document).on('click', '.editEntrada_guardarCambios', function(){
  var idEntrada = document.getElementById('editEntrada_idEntrada').value;
  var idInventario = document.getElementById('editEntrada_idInventario').value;
  var costoUnitario = document.getElementById('editEntrada_costoUnitario').value;
  var proveedor = document.getElementById('editEntrada_proveedor').value;
  var observaciones = document.getElementById('editEntrada_observaciones').value;
  editarEntrada(idEntrada,idInventario,costoUnitario,proveedor,observaciones);
});
$(document).on('click', '.editSalida_guardarCambios', function(){
  var idSalida = document.getElementById('editSalida_idSalida').value;
  var idInventario = document.getElementById('editSalida_idInventario').value;
  var costoUnitario = document.getElementById('editSalida_costoUnitario').value;
  var observaciones = document.getElementById('editSalida_observaciones').value;
  editarSalida(idSalida,idInventario,costoUnitario,observaciones);
});


$(document).on('click', '.Inventario_borrarRegistro', function(){
  var idInventario = document.getElementById('editInventario_idInventario').value;
  borrarInventario(idInventario);
});
$(document).on('click', '.Entrada_borrarRegistro', function(){
  var idEntrada = document.getElementById('editEntrada_idEntrada').value;
  var idInventario = document.getElementById('editEntrada_idInventario').value;
  borrarEntrada(idEntrada,idInventario);
});
$(document).on('click', '.Salida_borrarRegistro', function(){
  var idSalida = document.getElementById('editSalida_idSalida').value;
  var idInventario = document.getElementById('editSalida_idInventario').value;
  borrarSalida(idSalida,idInventario);
});





// BUSQUEDA AJAX DE ENTRADA
$("#crearEntrada_idInventario").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/inventario/fetchInventarioEntrada.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#Entrada_idInventarioDrop_show_list").html(response);
			},
		});
	} else {
		$("#Entrada_idInventarioDrop_show_list").html("");
	}
});
$(document).on("click", ".entradaInventarioSearch", function () {
	$("#crearEntrada_idInventario").val($(this).text());
	$("#Entrada_idInventarioDrop_show_list").html("");
});


// BUSQUEDA AJAX DE SALIDA
$("#crearSalida_idInventario").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/inventario/fetchInventarioSalida.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#Salida_idInventarioDrop_show_list").html(response);
			},
		});
	} else {
		$("#Salida_idInventarioDrop_show_list").html("");
	}
});
$(document).on("click", ".salidaInventarioSearch", function () {
	$("#crearSalida_idInventario").val($(this).text());
	$("#Salida_idInventarioDrop_show_list").html("");
});


// BUSQUEDA AJAX DE ALUMNO
$("#crearSalida_idAlumno").keyup(function () {
	let searchText = $(this).val();
	if (searchText != "") {
		$.ajax({
			url: "backend/inventario/fetchAlumno.php",
			method: "post",
			data: {
				codigo_query: searchText,
			},
			success: function (response) {
				$("#idAlumnoDrop_show_list").html(response);
			},
		});
	} else {
		$("#idAlumnoDrop_show_list").html("");
	}
});
$(document).on("click", ".alumnoSearch", function () {
	$("#crearSalida_idAlumno").val($(this).text());
	$("#idAlumnoDrop_show_list").html("");
});