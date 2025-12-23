var alumnosTable;
var array = [];
var textAlumnos;
var estatusAlumno;

var nombreAlumno;
var apellidoPaternoAlumno;
var apellidoMaternoAlumno;

var usuariosTable;
var arrayUsuarios = [];
var textUsuarios;
/*--------------------------------DAR DE BAJA--------------------------------*/
// var elem = document.querySelector('.js-switch');
// var init = new Switchery(elem);

var mySwitch = new Switchery($('#editarAlumno_cambiarEstado')[0], {
  size:"small",
  color: 'green'
});

var ids = [ 
  '#searchBynombreCompleto',
  '#searchBymatricula',
  '#searchByreferencia',
  '#searchBygeneracion',
  '#searchBynivelEscolar',
  '#searchBygradoyGrupo',
  '#searchBycurp',
  '#searchBynoSeguro',
  '#searchByfechaNacimiento',
  '#searchBylugarNacimiento',
  '#searchBynacionalidad',
  '#searchByreligion',
  '#searchBytipoSangre',
  '#searchBypeso',
  '#searchBytalla',
  '#searchByalergias',
  '#searchBycuidadosEspeciales',
  '#searchBycalle',
  '#searchBynumero',
  '#searchBycolonia',
  '#searchBycodigoPostal',
  '#searchBylocalidad',
  '#searchByciudad',
  '#searchByestado',
  '#searchBymedicoFamiliar',
  '#searchBytelefonoMF',
  '#searchByenCasoDeEmergencia',
  '#searchByestatusAlumno'
];

/*--------------------------------READ--------------------------------*/
// DATATABLES JS
$(document).ready(function(){
  alumnosTable = $('#alumnosTable').DataTable({
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
    orderCellsTop: true,
		order: [[ 0, "desc" ]],
		// fixedColumns:{
		// 	leftColumns: 2
		// },
		columnDefs: [{
			targets: [ 0,1,2,3,4,33 ],
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
			url:'backend/alumnos_read.php',
			type:"POST",
      'data': function(data){
        // Read values
        var searchBynombreCompleto = $('#searchBynombreCompleto').val();
        var searchBymatricula = $('#searchBymatricula').val();
        var searchByreferencia = $('#searchByreferencia').val();
        var searchBygeneracion = $('#searchBygeneracion').val();
        var searchBynivelEscolar = $('#searchBynivelEscolar').val();
        var searchBygradoyGrupo = $('#searchBygradoyGrupo').val();
        var searchBycurp = $('#searchBycurp').val();
        var searchBynoSeguro = $('#searchBynoSeguro').val();
        var searchByfechaNacimiento = $('#searchByfechaNacimiento').val();
        var searchBylugarNacimiento = $('#searchBylugarNacimiento').val();
        var searchBynacionalidad = $('#searchBynacionalidad').val();
        var searchByreligion = $('#searchByreligion').val();
        var searchBytipoSangre = $('#searchBytipoSangre').val();
        var searchBypeso = $('#searchBypeso').val();
        var searchBytalla = $('#searchBytalla').val();
        var searchByalergias = $('#searchByalergias').val();
        var searchBycuidadosEspeciales = $('#searchBycuidadosEspeciales').val();
        var searchBycalle = $('#searchBycalle').val();
        var searchBynumero = $('#searchBynumero').val();
        var searchBycolonia = $('#searchBycolonia').val();
        var searchBycodigoPostal = $('#searchBycodigoPostal').val();
        var searchBylocalidad = $('#searchBylocalidad').val();
        var searchByciudad = $('#searchByciudad').val();
        var searchByestado = $('#searchByestado').val();
        var searchBymedicoFamiliar = $('#searchBymedicoFamiliar').val();
        var searchBytelefonoMF = $('#searchBytelefonoMF').val();
        var searchByenCasoDeEmergencia = $('#searchByenCasoDeEmergencia').val();
        var searchByestatusAlumno = $('#searchByestatusAlumno').val();
        // Append to data
        data.searchBynombreCompleto=searchBynombreCompleto;
        data.searchBymatricula=searchBymatricula;
        data.searchByreferencia=searchByreferencia;
        data.searchBygeneracion=searchBygeneracion;
        data.searchBynivelEscolar=searchBynivelEscolar;
        data.searchBygradoyGrupo=searchBygradoyGrupo;
        data.searchBycurp=searchBycurp;
        data.searchBynoSeguro=searchBynoSeguro;
        data.searchByfechaNacimiento=searchByfechaNacimiento;
        data.searchBylugarNacimiento=searchBylugarNacimiento;
        data.searchBynacionalidad=searchBynacionalidad;
        data.searchByreligion=searchByreligion;
        data.searchBytipoSangre=searchBytipoSangre;
        data.searchBypeso=searchBypeso;
        data.searchBytalla=searchBytalla;
        data.searchByalergias=searchByalergias;
        data.searchBycuidadosEspeciales=searchBycuidadosEspeciales;
        data.searchBycalle=searchBycalle;
        data.searchBynumero=searchBynumero;
        data.searchBycolonia=searchBycolonia;
        data.searchBycodigoPostal=searchBycodigoPostal;
        data.searchBylocalidad=searchBylocalidad;
        data.searchByciudad=searchByciudad;
        data.searchByestado=searchByestado;
        data.searchBymedicoFamiliar=searchBymedicoFamiliar;
        data.searchBytelefonoMF=searchBytelefonoMF;
        data.searchByenCasoDeEmergencia=searchByenCasoDeEmergencia;
        data.searchByestatusAlumno=searchByestatusAlumno;
      }
		},

		columns: [
      { data: 'idAlumno' },
      { data: 'idPersona' },
      { data: 'nombre' },
      { data: 'apellidoPaterno' },
      { data: 'apellidoMaterno' },
      { data: 'nombreCompleto' },
      { data: 'matricula' },
      { data: 'referencia' },
      { data: 'generacion' },
      { data: 'nivelEscolar' },
      { data: 'gradoyGrupo' },
      { data: 'curp' },
      { data: 'noSeguro' },
      { data: 'fechaNacimiento' },
      { data: 'lugarNacimiento' },
      { data: 'nacionalidad' },
      { data: 'religion' },
      { data: 'tipoSangre' },
      { data: 'peso' },
      { data: 'talla' },
      { data: 'alergias' },
      { data: 'cuidadosEspeciales' },
      { data: 'calle' },
      { data: 'numero' },
      { data: 'colonia' },
      { data: 'codigoPostal' },
      { data: 'localidad' },
      { data: 'ciudad' },
      { data: 'estado' },
      { data: 'medicoFamiliar' },
      { data: 'telefonoMF' },
      { data: 'enCasoDeEmergencia' },
      { data: 'estatusAlumno' },
      { data: 'idGrupo' }
		],
    dom: 'Blfrtip',
    buttons: [
      {
        textAlumnos: 'Copiar',
        className: 'btn btn-info',
        extend: 'copy',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28 ]
        }
      },
      {
        extend: 'csv',
        className: 'btn btn-info',
        sheetName: 'Tabla exportada de alumnos',
        title: 'Tabla alumnos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28 ]
        }
      },
      {
        extend: 'excel',
        className: 'btn btn-info',
        autoFilter: true,
        sheetName: 'Tabla exportada de alumnos',
        title: 'Tabla alumnos',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28 ]
        }
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
      alumnosTable.draw();
    });
  });

	var numCols = alumnosTable.init().columns.length;
	
	alumnosTable.on("dblclick", "tr",function(){
		array.length=0;
		var idx = alumnosTable.fixedColumns().rowIndex( this );
		var aData = alumnosTable.row( idx ).data();
		for(var i=0;i<numCols;i++){
			textAlumnos = alumnosTable.cell( idx, i ).data();
			array.push(textAlumnos);
			// console.log(textAlumnos);
		};
		$("#editarAlumno_modal").modal("show");
		//--------------------PAGO MODAL----------------------
		//--------------------PAGO MODAL----------------------
		$('#editarAlumno_idAlumno').val(array[0]);
    $('#editarAlumno_idPersona').val(array[1]);
    
    nombreAlumno=array[2];
    apellidoPaternoAlumno=array[3];
    apellidoMaternoAlumno=array[4];

    $('#editarAlumno_nombre').val(array[2]);
    $('#editarAlumno_apellidoPaterno').val(array[3]);
    $('#editarAlumno_apellidoMaterno').val(array[4]);
    // $('#editarAlumno_nombreCompleto').val(array[5]);
    $('#editarAlumno_matricula').val(array[6]);
    $('#editarAlumno_referencia').val(array[7]);
    $('#editarAlumno_generacion').val(array[8]);
    $('#editarAlumno_nivelEscolar').val(array[9]);
    $('#editarAlumno_gradoyGrupo').val(array[10]);
    $('#editarAlumno_curp').val(array[11]);
    $('#editarAlumno_noSeguro').val(array[12]);
    $('#editarAlumno_fechaNacimiento').val(array[13]);
    $('#editarAlumno_lugarNacimiento').val(array[14]);
    $('#editarAlumno_nacionalidad').val(array[15]);
    $('#editarAlumno_religion').val(array[16]);
    $('#editarAlumno_tipoSangre').val(array[17]);
    $('#editarAlumno_peso').val(array[18]);
    $('#editarAlumno_talla').val(array[19]);
    $('#editarAlumno_alergias').val(array[20]);
    $('#editarAlumno_cuidadosEspeciales').val(array[21]);
    $('#editarAlumno_calle').val(array[22]);
    $('#editarAlumno_numero').val(array[23]);
    $('#editarAlumno_colonia').val(array[24]);
    $('#editarAlumno_codigoPostal').val(array[25]);
    $('#editarAlumno_localidad').val(array[26]);
    $('#editarAlumno_ciudad').val(array[27]);
    $('#editarAlumno_estado').val(array[28]);
    $('#editarAlumno_medicoFamiliar').val(array[29]);
    $('#editarAlumno_telefonoMF').val(array[30]);
    $('#editarAlumno_enCasoDeEmergencia').val(array[31]);
    // $('#editarAlumno_estatusAlumno').val(array[32]);
    $('#editarAlumno_idGrupo').val(array[33]);

		estatusAlumno=array[32];

    if(estatusAlumno==="Alta"){
      setSwitchery(mySwitch, true);
		}else{
      setSwitchery(mySwitch, false);
    };
		$('#crearUsuario_idPersona').val(array[1] + " - " +array[5]);
		
	
	});


  usuariosTable = $('#usuariosTable').DataTable({
		order: [[ 0, "desc" ]],
		fixedColumns:   {
			leftColumns: 1
		},
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
				url:'backend/usuariosAlumnos_read.php'
		},
		columns: [
			{ data: 'idUsuario' },
			{ data: 'idPersona' },
			{ data: 'username' },
			{ data: 'nombreCompleto' },
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
    $('#editarUsuario_username').val(arrayUsuarios[2]);
    $('#editarUsuario_correoElectronico').val(arrayUsuarios[4]);
	});
});

function setSwitchery(switchElement, checkedBool) {
  if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
      switchElement.setPosition(true);
  }
}

$(document).on('click', '.registrarAlumno', function(){
	$("#registrarAlumno_modal").modal("toggle");
});

$(document).on('click', '.crearAlumno_guardarCambios', function(){
  var nombre = document.getElementById('crearAlumno_nombre').value;
  var apellidoPaterno = document.getElementById('crearAlumno_apellidoPaterno').value;
  var apellidoMaterno = document.getElementById('crearAlumno_apellidoMaterno').value;
  var matricula = document.getElementById('crearAlumno_matricula').value;
  var referencia = document.getElementById('crearAlumno_referencia').value;
  var idGrupo = document.getElementById('crearAlumno_idGrupo').value;
  var medicoFamiliar = document.getElementById('crearAlumno_medicoFamiliar').value;
  var telefonoMF = document.getElementById('crearAlumno_telefonoMF').value;
  var enCasoDeEmergencia = document.getElementById('crearAlumno_enCasoDeEmergencia').value;
  var alergias = document.getElementById('crearAlumno_alergias').value;
  var cuidadosEspeciales = document.getElementById('crearAlumno_cuidadosEspeciales').value;
  var curp = document.getElementById('crearAlumno_curp').value;
  var noSeguro = document.getElementById('crearAlumno_noSeguro').value;
  var fechaNacimiento = document.getElementById('crearAlumno_fechaNacimiento').value;
  var lugarNacimiento = document.getElementById('crearAlumno_lugarNacimiento').value;
  var nacionalidad = document.getElementById('crearAlumno_nacionalidad').value;
  var religion = document.getElementById('crearAlumno_religion').value;
  var tipoSangre = document.getElementById('crearAlumno_tipoSangre').value;
  var peso = document.getElementById('crearAlumno_peso').value;
  var talla = document.getElementById('crearAlumno_talla').value;
  var calle = document.getElementById('crearAlumno_calle').value;
  var numero = document.getElementById('crearAlumno_numero').value;
  var colonia = document.getElementById('crearAlumno_colonia').value;
  var codigoPostal = document.getElementById('crearAlumno_codigoPostal').value;
  var localidad = document.getElementById('crearAlumno_localidad').value;
  var ciudad = document.getElementById('crearAlumno_ciudad').value;
  var estado = document.getElementById('crearAlumno_estado').value;
  crearAlumno(nombre,apellidoPaterno,apellidoMaterno,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado);
});

$(document).on('click', '.editarAlumno_guardarCambios', function(){
  var idAlumno = document.getElementById('editarAlumno_idAlumno').value;
  var idPersona = document.getElementById('editarAlumno_idPersona').value;
  var nombre = document.getElementById('editarAlumno_nombre').value;
  var apellidoPaterno = document.getElementById('editarAlumno_apellidoPaterno').value;
  var apellidoMaterno = document.getElementById('editarAlumno_apellidoMaterno').value;
  var matricula = document.getElementById('editarAlumno_matricula').value;
  var referencia = document.getElementById('editarAlumno_referencia').value;
  var idGrupo = document.getElementById('editarAlumno_idGrupo').value;
  var medicoFamiliar = document.getElementById('editarAlumno_medicoFamiliar').value;
  var telefonoMF = document.getElementById('editarAlumno_telefonoMF').value;
  var enCasoDeEmergencia = document.getElementById('editarAlumno_enCasoDeEmergencia').value;
  var alergias = document.getElementById('editarAlumno_alergias').value;
  var cuidadosEspeciales = document.getElementById('editarAlumno_cuidadosEspeciales').value;
  var curp = document.getElementById('editarAlumno_curp').value;
  var noSeguro = document.getElementById('editarAlumno_noSeguro').value;
  var fechaNacimiento = document.getElementById('editarAlumno_fechaNacimiento').value;
  var lugarNacimiento = document.getElementById('editarAlumno_lugarNacimiento').value;
  var nacionalidad = document.getElementById('editarAlumno_nacionalidad').value;
  var religion = document.getElementById('editarAlumno_religion').value;
  var tipoSangre = document.getElementById('editarAlumno_tipoSangre').value;
  var peso = document.getElementById('editarAlumno_peso').value;
  var talla = document.getElementById('editarAlumno_talla').value;
  var calle = document.getElementById('editarAlumno_calle').value;
  var numero = document.getElementById('editarAlumno_numero').value;
  var colonia = document.getElementById('editarAlumno_colonia').value;
  var codigoPostal = document.getElementById('editarAlumno_codigoPostal').value;
  var localidad = document.getElementById('editarAlumno_localidad').value;
  var ciudad = document.getElementById('editarAlumno_ciudad').value;
  var estado = document.getElementById('editarAlumno_estado').value;
  editarAlumno(idAlumno,idPersona,nombre,apellidoPaterno,apellidoMaterno,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado,nombreAlumno,apellidoPaternoAlumno,apellidoMaternoAlumno);

});

$("#editarAlumno_cambiarEstado").change(function(){
  var idAlumno = document.getElementById('editarAlumno_idAlumno').value;
  darAltaBajaAlumno(idAlumno,estatusAlumno);
});

$(document).on('click', '.editarAlumno_borrarRegistro', function(){
  var idPersona = document.getElementById('editarAlumno_idPersona').value;
  borrarAlumno(idPersona);
});




$(document).on('click', '.registrarUsuario', function(){
	$("#editarAlumno_modal").modal("hide");
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