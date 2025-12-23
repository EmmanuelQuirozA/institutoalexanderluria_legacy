/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES
 */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$('a[data-toggle="tooltip"]').tooltip({
	container: 'body'
});
jQuery.extend(jQuery.validator.messages, {
  required: "Este campo es obligatorio.",
  remote: "Por favor, rellena este campo.",
  email: "Por favor, escribe una dirección de correo válida: texto@correo.com",
  url: "Por favor, escribe una URL válida.",
  date: "Por favor, escribe una fecha válida.",
  dateISO: "Por favor, escribe una fecha (ISO) válida.",
  number: "Por favor, escribe un número entero válido.",
  digits: "Por favor, escribe sólo dígitos.",
  creditcard: "Por favor, escribe un número de tarjeta válido.",
  equalTo: "Por favor, escribe el mismo valor de nuevo.",
  accept: "Por favor, escribe un valor con una extensión aceptada.",
  maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
  minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
  rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
  range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
  max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
  min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
});
var divsToHide = document.getElementsByClassName("loadingGif"); //Ocultar loadingGif
for(var i = 0; i < divsToHide.length; i++){
    divsToHide[i].style.display = "none";
}

function disableActionButtons(){
  // Se desactivan los botones de acción y se muestra el gif
	$(".actionBtn").prop('disabled', true);
	var divsToHide = document.getElementsByClassName("loadingGif"); //Ocultar loadingGif
	for(var i = 0; i < divsToHide.length; i++){
		divsToHide[i].style.display = "block";
	}
}
function enableActionButtons(){
  $(".actionBtn").prop('disabled', false);
  var divsToHide = document.getElementsByClassName("loadingGif"); //Ocultar loadingGif
  for(var i = 0; i < divsToHide.length; i++){
    divsToHide[i].style.display = "none";
  }
}


//---------------------------------------------------------------------------------------------LOGIN---------------------------------------------------------------------------------
$("#loginForm").validate({
  rules:{
    username:{required: true},
    password:{required: true}
  }
})

function login(){
  if($("#loginForm").valid()==false){
    return;
  } 
  // Si el formulario no es correcto, el return no permite que continúe el script
  event.preventDefault()
  let username=document.getElementById("username").value
  let password=document.getElementById("password").value

  $.ajax({
    url:"build/login.php",
    type:"POST",
    data:{
      username:username,
      password:password
    },
    success: function(jsonresult){

      var json = $.parseJSON(jsonresult);
      if(json.response.status == 'success') {let timerInterval
        Swal.fire({
          heightAuto: false,
          title: 'Bienvenido ' + json.response.nombreCompleto,
          html: 'Iniciando sesión.',
          timer: 500,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          if (result.dismiss == Swal.DismissReason.timer) {
            // SEND USER TO THE REQUIRED SYSTEM
						if(json.response.nombreRol=="Cocina"){
							window.location.replace("cocina/home.php");
						}else if(json.response.nombreRol=="Tutor"){
							window.location.replace("tutores/index.php");
						}else if(json.response.nombreRol=="Docente"){
							window.location.replace("docentes/index.php");
						}else if(json.response.nombreRol=="Alumno"){
							window.location.replace("alumnos/index.php");
						}else{
							window.location.replace("system/index.php");
						}
          }
        })
      }else{
        new PNotify({
          text: json.response.message,
          type: json.response.status,
          styling: 'bootstrap3'
        });
      }
    }
  });

}


//---------------------------------------------------------------------------------------------USUARIOS-USUARIOS---------------------------------------------------------------------------------
$("#editarUsuario_modal_Form").validate({
	rules:{
		correoElectronico:{required: true,email: true},
		rol:{required: true}
	}
})
$("#registrarUsuario_modal_Form").validate({
	rules:{
		idPersona:{required: true},
		username:{required: true},
		correoElectronico:{required: true,email: true},
		rol:{required: true},
		password:{required: true},
		passwordConfirm:{required: true}
	}
})
$("#editarcontrasena_modal_Form").validate({
	rules:{
		password:{required: true},
		passwordConfirm:{required: true}
	}
})

function crearUsuario(idPersona,username,correoElectronico,idRol,password,passwordConfirm){
  if($("#registrarUsuario_modal_Form").valid()==false){
    return;
  }

	if (password==passwordConfirm) {
		// Se desactivan los botones de acción y se muestra el gif
		disableActionButtons();
		$.ajax({
			url: "backend/usuarios.php",
			method: "post",
			data: {
				accion:"create",
				idPersona:idPersona,
				username:username,
				correoElectronico:correoElectronico,
				idRol:idRol,
				password:password,
				passwordConfirm:passwordConfirm
			},
			success: function(jsonresult){
				
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {

					// Se vuelve a activar los botones de acción y se oculta el gif
					enableActionButtons();
					usuariosTable.ajax.reload();
					$("#registrarUsuario_modal").modal("hide");
					$("#personaDrop_show_list").html("");
					$('#crearUsuario_idPersona').val("");
					$('#crearUsuario_username').val("");
					$('#crearUsuario_correoElectronico').val("");
					$('#crearUsuario_idRol').val("");
					$('#crearUsuario_password').val("");
					$('#crearUsuario_passwordConfirm').val("");
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{

					// Se vuelve a activar los botones de acción y se oculta el gif
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else{
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "Las contraseñas no coinciden."
		})
	}
}
function crearUsuarioAutomatico(idPersona,username,correoElectronico,password,passwordConfirm){
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/usuarios.php",
		method: "post",
		data: {
			accion:"createAlumnoUser",
			idPersona:idPersona,
			username:username,
			correoElectronico:correoElectronico,
			password:password,
			passwordConfirm:passwordConfirm
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				try {
					usuariosTable.ajax.reload();
				} catch (error) {
					
				}
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarUsuario(idUsuario,idRol,correoElectronico,password,passwordConfirm){
  if($("#editarUsuario_modal_Form").valid()==false){
    return;
  }
	if (password==passwordConfirm) {
		// Se desactivan los botones de acción y se muestra el gif
    disableActionButtons();
		$.ajax({
			url: "backend/usuarios.php",
			method: "post",
			data: {
				accion:"update",
				idUsuario:idUsuario,
				idRol:idRol,
				correoElectronico:correoElectronico,
				password:password,
				passwordConfirm:passwordConfirm
			},
			success: function(jsonresult){
				
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {

					// Se vuelve a activar los botones de acción y se oculta el gif
          enableActionButtons();
					usuariosTable.ajax.reload();
					$("#editarUsuario_modal").modal("hide");
					$('#editarUsuario_idUsuario').val("");
					$('#editarUsuario_username').val("");
					$('#editarUsuario_correoElectronico').val("");
					$('#editarUsuario_idRol').val("");
					$('#editarUsuario_password').val("");
					$('#editarUsuario_passwordConfirm').val("");
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{

					// Se vuelve a activar los botones de acción y se oculta el gif
          enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else{
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "Las contraseñas no coinciden."
		})
	}
}
function editarContrasena(password,passwordConfirm){
  if($("#editarcontrasena_modal_Form").valid()==false){
    return;
  }
	if (password==passwordConfirm) {
		// Se desactivan los botones de acción y se muestra el gif
    disableActionButtons();
		$.ajax({
			url: "backend/usuarios.php",
			method: "post",
			data: {
				accion:"updateContrasena",
				password:password,
				passwordConfirm:passwordConfirm
			},
			success: function(jsonresult){
				
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {

					// Se vuelve a activar los botones de acción y se oculta el gif
          enableActionButtons();
					$("#editarcontrasena_modal").modal("hide");

					$('#editarcontrasena_password').val("");
					$('#editarcontrasena_passwordConfirm').val("");
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{

					// Se vuelve a activar los botones de acción y se oculta el gif
          enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else{
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "Las contraseñas no coinciden."
		})

	}
}
function borrarUsuario(idUsuario){
  const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/usuarios.php",
				type:"POST",
				data:{accion:"delete",idUsuario:idUsuario},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						$("#editarUsuario_modal").modal("hide");
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						usuariosTable.ajax.reload();
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}


//---------------------------------------------------------------------------------------------USUARIOS-PERSONAS---------------------------------------------------------------------------------
$("#editarPersona_modal_Form").validate({
	rules:{
		nombre:{required: true},
		apellidoPaterno:{required: true},
		apellidoMaterno:{required: true}
	}
})
$("#crearPersona_modal_Form").validate({
	rules:{
		nombre:{required: true},
		apellidoPaterno:{required: true},
		apellidoMaterno:{required: true}
	}
})

function crearPersona(nombre,apellidoPaterno,apellidoMaterno){
  if($("#crearPersona_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/personas.php",
		method: "post",
		data: {
			accion:"create",
			nombre:nombre,
			apellidoPaterno:apellidoPaterno,
			apellidoMaterno:apellidoMaterno
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				personasTable.ajax.reload();
				$("#crearPersona_modal").modal("hide");
				$('#crearPersona_nombre').val("");
				$('#crearPersona_apellidoPaterno').val("");
				$('#crearPersona_apellidoMaterno').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}


function editarPersona(idPersona,nombre,apellidoPaterno,apellidoMaterno){
  if($("#editarPersona_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/personas.php",
		method: "post",
		data: {
			accion:"update",
			idPersona:idPersona,
			nombre:nombre,
			apellidoPaterno:apellidoPaterno,
			apellidoMaterno:apellidoMaterno
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				usuariosTable.ajax.reload();
				personasTable.ajax.reload();
				$("#editarPersona_modal").modal("hide");
				$('#editarPersona_idPersona').val("");
				$('#editarPersona_nombre').val("");
				$('#editarPersona_apellidoPaterno').val("");
				$('#editarPersona_apellidoMaterno').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarPersona(idPersona){
  const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/personas.php",
				type:"POST",
				data:{accion:"delete",idPersona:idPersona},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
						$("#editarPersona_modal").modal("hide");
            enableActionButtons();
						personasTable.ajax.reload();
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}


//---------------------------------------------------------------------------------------------CONFIGURACIÓN-ROLES---------------------------------------------------------------------------------
$("#crearRol_modal_Form").validate({
	rules:{
		crearRol_nombreRol:{required: true}
	}
})

function editarRol(){
	const permisosChecked = [];
	$('input:checkbox:checked', '#modulosPermisosTable').each(function() {
			// Se obtienen todos los checkbox que están checkeados de la tabla
			permisosChecked.push($(this).prop('value'));
	});
	disableActionButtons();
	
	// Se envía Ajax
	$.ajax({
		url: "backend/roles.php",
		method: "post",
		data: {
			accion:"update",idRol:idRol,permisosChecked:permisosChecked
		},
		success: function(jsonresult){

			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function crearRol(nombreRol,descripcion){
	
  if($("#crearRol_modal_Form").valid()==false){
    return;
  }
	disableActionButtons();
	$.ajax({
		url: "backend/roles.php",
		method: "post",
		data: {
			accion:"create",
			nombreRol:nombreRol,descripcion:descripcion
		},
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				rolesTable.ajax.reload();
				$("#crearRol_modal").modal("hide");
				$('#crearRol_nombreRol').val("");
				$('#crearRol_descripcion').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarRol(idRol){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/roles.php",
				type:"POST",
				data:{
					accion:"delete",
					idRol:idRol},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						rolesTable.ajax.reload();
						// Se oculta el modal
						$("#editarRol_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

function relacionarModulo(idRol,idModulo){
	disableActionButtons();
	// Se envía la solicitud al servidor
	$.ajax({
		url: "backend/roles.php",
		method: "post",
		data: {
			accion:"relacionarModulo",
			idRol:idRol,
			idModulo:idModulo
		},
		// Si la solicitud es exitosa se lee el json result
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			// Si el proceso interno es exitoso
			if(json.response.status == 'success') {
				enableActionButtons();
				// Se oculta el modal
				$("#relacionarModulo_modal").modal("hide");
				// $("#editarRol_modal").modal("toggle");
				// Se envía la solicitud al servidor de volver a leer los permisos del rol
				$.ajax({
					url: "backend/configuracion/fetchPermisos.php",
					method: "post",
					data: {idRol:idRol},
					success: function (response) {
						// Se vuelve a cargar los permisos en la tabla de permisos del rol
						$("#modulosTabla").html(response);
					}
				});

				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
//---------------------------------------------------------------------------------------------CONFIGURACIÓN-CICLO ESCOLAR---------------------------------------------------------------------------------
function crearCicloEscolar(cicloEscolar,fechaInicio,fechaFin) {
	// VALIDATE THE FORM BEFORE SEND TO THE SERVER
	var form = document.getElementById('crearCicloEscolar_modal_Form');

	var required=0;
	var validity=true;

	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};

	if (required==0 && validity==true && fechaInicio<fechaFin) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		Swal.fire({
			title: 'Ingrese sus credenciales para continuar',
			html: `<input type="text" id="login" class="swal2-input" placeholder="Usuario">
			<input type="password" id="password" class="swal2-input" placeholder="Contraseña">`,
			confirmButtonText: 'Continuar',
			focusConfirm: false,
			preConfirm: () => {
				const login = Swal.getPopup().querySelector('#login').value
				const password = Swal.getPopup().querySelector('#password').value
				if (!login || !password) {
					Swal.showValidationMessage(`Por favor, ingrese sus credenciales`)
				}
				return { login: login, password: password }
			}
		}).then((loginresult) => {
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Seguro que deseas añadir el ciclo escolar '+cicloEscolar+'?',
				text: "No podrás editar ni eliminar el registro!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Sí, continuar!',
				cancelButtonText: 'No, cancelar!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url:"backend/ciclosEscolares.php",
						type:"POST",
						data:{
							accion:"createCicloEscolar",
							username:loginresult.value.login,
							password:loginresult.value.password,
							cicloEscolar:cicloEscolar,
							fechaInicio:fechaInicio,
							fechaFin:fechaFin
						},
						success: function(jsonresult){

							var json = $.parseJSON(jsonresult);
							if(json.response.status == 'success') {
								enableActionButtons();
								ciclosEscolaresTable.ajax.reload();
								Swal.fire({
									icon: 'success',
									title: json.response.message,
									showConfirmButton: false,
									timer: 1500
								});
								// .then(function() {
								// 	window.location = "configuracion.php";
								// });
								
								// $('#create_cicloEscolar').val("");
								// $('#create_fechaInicio').val("");
								// $('#create_fechaFin').val("");
								// $('#cicloEscolar').val("");
							}else{
								enableActionButtons();
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: json.response.message
								})
							}
						}
					});
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					enableActionButtons();
					swalWithBootstrapButtons.fire(
						'Cancelado',
						'Acción cancelada.',
						'error'
					)
				}
			})
		})
	}else if(required>0){
		enableActionButtons();
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Por favor, llena todos los campos.'
		})
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}else if(fechaInicio>=fechaFin){
		enableActionButtons();
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Por favor, asegúrate de que la fecha inicial sea anterior a la final.'
		});
	}
};





//---------------------------------------------------------------------------------------------CONFIGURACIÓN-MODULOS---------------------------------------------------------------------------------
$("#editarModulo_modal_Form").validate({
	rules:{
		idModulo:{required: true},
		nombre:{required: true}
	}
})
$("#crearModulo_modal_Form").validate({
	rules:{
		crearModulo_nombre:{required: true}
	}
})

function crearModulo(nombre,descripcion){
	if($("#crearModulo_modal_Form").valid()==false){
    return;
  }
	disableActionButtons();
	$.ajax({
		url: "backend/modulos.php",
		method: "post",
		data: {
			accion:"create",
			nombre:nombre,
			descripcion:descripcion
		},
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				modulosTable.ajax.reload();
				$("#crearModulo_modal").modal("hide");
				$('#crearModulo_nombre').val("");
				$('#crearModulo_descripcion').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarModulo(idModulo,nombre,descripcion){
	disableActionButtons();
	$.ajax({
		url: "backend/modulos.php",
		method: "post",
		data: {
			accion:"update",
			idModulo:idModulo,
			nombre:nombre,
			descripcion:descripcion
		},
		success: function(jsonresult){

			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				modulosTable.ajax.reload();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarModulo(idModulo){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/modulos.php",
				type:"POST",
				data:{
					accion:"delete",
					idModulo:idModulo
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						modulosTable.ajax.reload();
						// Se oculta el modal
						$("#editarModulo_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------TRABAJADORES---------------------------------------------------------------------------------
$("#registrarTrabajador_modal_Form").validate({
	rules:{
		nombre:{required: true},
		apellidoPaterno:{required: true},
		apellidoMaterno:{required: true}
	}
})

function crearTrabajador(nombre,apellidoPaterno,apellidoMaterno,noTrabajador,fechaInicioLabores,fechaFinLabores,puesto,sueldo,banco,noCuenta,referencia,curp,rfc,noSeguro,fechaNacimiento,lugarNacimiento,estadoCivil,hijos,numeroCel,calle,numero,colonia,codigoPostal,localidad,estado,egresadoDe,universidad,fechaEgreso,maestria,fechaEgresoMaestria,aniosExperienciaLaboral){
	if($("#registrarTrabajador_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('registrarTrabajador_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/trabajadores.php",
			method: "post",
			data: {
				accion:"create",
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				noTrabajador:noTrabajador,
				fechaInicioLabores:fechaInicioLabores,
				fechaFinLabores:fechaFinLabores,
				puesto:puesto,
				sueldo:sueldo,
				banco:banco,
				noCuenta:noCuenta,
				referencia:referencia,
				curp:curp,
				rfc:rfc,
				noSeguro:noSeguro,
				fechaNacimiento:fechaNacimiento,
				lugarNacimiento:lugarNacimiento,
				estadoCivil:estadoCivil,
				hijos:hijos,
				numeroCel:numeroCel,
				calle:calle,
				numero:numero,
				colonia:colonia,
				codigoPostal:codigoPostal,
				localidad:localidad,
				estado:estado,
				egresadoDe:egresadoDe,
				universidad:universidad,
				fechaEgreso:fechaEgreso,
				maestria:maestria,
				fechaEgresoMaestria:fechaEgresoMaestria,
				aniosExperienciaLaboral:aniosExperienciaLaboral
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();

					trabajadoresTable.ajax.reload();
					$("#registrarTrabajador_modal").modal("hide");

					$('#crearTrabajador_nombre').val("");
					$('#crearTrabajador_apellidoPaterno').val("");
					$('#crearTrabajador_apellidoMaterno').val("");
					$('#crearTrabajador_noTrabajador').val("");
					$('#crearTrabajador_fechaInicioLabores').val("");
					$('#crearTrabajador_fechaFinLabores').val("");
					$('#crearTrabajador_puesto').val("");
					$('#crearTrabajador_sueldo').val("");
					$('#crearTrabajador_banco').val("");
					$('#crearTrabajador_noCuenta').val("");
					$('#crearTrabajador_referencia').val("");
					$('#crearTrabajador_curp').val("");
					$('#crearTrabajador_rfc').val("");
					$('#crearTrabajador_noSeguro').val("");
					$('#crearTrabajador_fechaNacimiento').val("");
					$('#crearTrabajador_lugarNacimiento').val("");
					$('#crearTrabajador_estadoCivil').val("");
					$('#crearTrabajador_hijos').val("");
					$('#crearTrabajador_numeroCel').val("");
					$('#crearTrabajador_calle').val("");
					$('#crearTrabajador_numero').val("");
					$('#crearTrabajador_colonia').val("");
					$('#crearTrabajador_codigoPostal').val("");
					$('#crearTrabajador_localidad').val("");
					$('#crearTrabajador_estado').val("");
					$('#crearTrabajador_egresadoDe').val("");
					$('#crearTrabajador_universidad').val("");
					$('#crearTrabajador_fechaEgreso').val("");
					$('#crearTrabajador_maestria').val("");
					$('#crearTrabajador_fechaEgresoMaestria').val("");
					$('#crearTrabajador_aniosExperienciaLaboral').val("");
					
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function editarTrabajador(idTrabajador,idPersona,nombre,apellidoPaterno,apellidoMaterno,noTrabajador,referencia,curp,rfc,noSeguro,fechaNacimiento,lugarNacimiento,puesto,sueldo,banco,noCuenta,numeroCel,fechaInicioLabores,fechaFinLabores,estadoCivil,hijos,calle,numero,colonia,codigoPostal,localidad,estado,egresadoDe,universidad,fechaEgreso,maestria,fechaEgresoMaestria,aniosExperienciaLaboral,nombreTrabajador,apellidoPaternoTrabajador,apellidoMaternoTrabajador) {
	if($("#editarTrabajador_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarTrabajador_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/trabajadores.php",
			method: "post",
			data: {
				accion:"update",
				nombreTrabajador:nombreTrabajador,
				apellidoPaternoTrabajador:apellidoPaternoTrabajador,
				apellidoMaternoTrabajador:apellidoMaternoTrabajador,
				idTrabajador:idTrabajador,
				idPersona:idPersona,
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				noTrabajador:noTrabajador,
				fechaInicioLabores:fechaInicioLabores,
				fechaFinLabores:fechaFinLabores,
				puesto:puesto,
				sueldo:sueldo,
				banco:banco,
				noCuenta:noCuenta,
				referencia:referencia,
				curp:curp,
				rfc:rfc,
				noSeguro:noSeguro,
				fechaNacimiento:fechaNacimiento,
				lugarNacimiento:lugarNacimiento,
				estadoCivil:estadoCivil,
				hijos:hijos,
				numeroCel:numeroCel,
				calle:calle,
				numero:numero,
				colonia:colonia,
				codigoPostal:codigoPostal,
				localidad:localidad,
				estado:estado,
				egresadoDe:egresadoDe,
				universidad:universidad,
				fechaEgreso:fechaEgreso,
				maestria:maestria,
				fechaEgresoMaestria:fechaEgresoMaestria,
				aniosExperienciaLaboral:aniosExperienciaLaboral
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					trabajadoresTable.ajax.reload();
					$("#editarTrabajador_modal").modal("hide");

					$('#editarTrabajador_idTrabajador').val("");
					$('#editarTrabajador_idPersona').val("");
					$('#editarTrabajador_nombre').val("");
					$('#editarTrabajador_apellidoPaterno').val("");
					$('#editarTrabajador_apellidoMaterno').val("");
					$('#editarTrabajador_noTrabajador').val("");
					$('#editarTrabajador_referencia').val("");
					$('#editarTrabajador_curp').val("");
					$('#editarTrabajador_rfc').val("");
					$('#editarTrabajador_noSeguro').val("");
					$('#editarTrabajador_fechaNacimiento').val("");
					$('#editarTrabajador_lugarNacimiento').val("");
					$('#editarTrabajador_puesto').val("");
					$('#editarTrabajador_sueldo').val("");
					$('#editarTrabajador_banco').val("");
					$('#editarTrabajador_noCuenta').val("");
					$('#editarTrabajador_numeroCel').val("");
					$('#editarTrabajador_fechaInicioLabores').val("");
					$('#editarTrabajador_fechaFinLabores').val("");
					$('#editarTrabajador_estadoCivil').val("");
					$('#editarTrabajador_hijos').val("");
					$('#editarTrabajador_calle').val("");
					$('#editarTrabajador_numero').val("");
					$('#editarTrabajador_colonia').val("");
					$('#editarTrabajador_codigoPostal').val("");
					$('#editarTrabajador_localidad').val("");
					$('#editarTrabajador_estado').val("");
					$('#editarTrabajador_egresadoDe').val("");
					$('#editarTrabajador_universidad').val("");
					$('#editarTrabajador_fechaEgreso').val("");
					$('#editarTrabajador_maestria').val("");
					$('#editarTrabajador_fechaEgresoMaestria').val("");
					$('#editarTrabajador_aniosExperienciaLaboral').val("");

					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function borrarTrabajador(idPersona){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/trabajadores.php",
				type:"POST",
				data:{
					accion:"delete",
					idPersona:idPersona
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						trabajadoresTable.ajax.reload();
						// Se oculta el modal
						$("#editarTrabajador_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------ALUMNOS---------------------------------------------------------------------------------
$("#registrarAlumno_modal_Form").validate({
	rules:{
		nombre:{required: true},
		apellidoPaterno:{required: true},
		apellidoMaterno:{required: true}
	}
})

function crearAlumno(nombre,apellidoPaterno,apellidoMaterno,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado){
	if($("#registrarAlumno_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('registrarAlumno_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/alumnos.php",
			method: "post",
			data: {
				accion:"create",
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				matricula:matricula,
				referencia:referencia,
				idGrupo:idGrupo,
				medicoFamiliar:medicoFamiliar,
				telefonoMF:telefonoMF,
				enCasoDeEmergencia:enCasoDeEmergencia,
				alergias:alergias,
				cuidadosEspeciales:cuidadosEspeciales,
				curp:curp,
				noSeguro:noSeguro,
				fechaNacimiento:fechaNacimiento,
				lugarNacimiento:lugarNacimiento,
				nacionalidad:nacionalidad,
				religion:religion,
				tipoSangre:tipoSangre,
				peso:peso,
				talla:talla,
				calle:calle,
				numero:numero,
				colonia:colonia,
				codigoPostal:codigoPostal,
				localidad:localidad,
				ciudad:ciudad,
				estado:estado
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {

					enableActionButtons();
					try {
						alumnosTable.ajax.reload();
					} catch (error) {
					}
					
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-success',
							cancelButton: 'btn btn-danger'
						},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: 'Registro guardado.',
						text: "Desea generar automáticamente un usuario para este alumno?",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Sí, crear!',
						cancelButtonText: 'No, lo haré después!',
						reverseButtons: true
					}).then((result) => {
						if (result.isConfirmed) {
							crearUsuarioAutomatico(json.response.idPersona,nombre+"SIAL"+referencia,referencia+"@ial.com",referencia,referencia);
						} else if (
							/* Read more about handling dismissals below */
							result.dismiss === Swal.DismissReason.cancel
						) {
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}
					})

					$("#registrarAlumno_modal").modal("hide");

					$('#crearAlumno_nombre').val("");
					$('#crearAlumno_apellidoPaterno').val("");
					$('#crearAlumno_apellidoMaterno').val("");
					$('#crearAlumno_matricula').val("");
					$('#crearAlumno_referencia').val("");
					$('#crearAlumno_idGrupo').val("");
					$('#crearAlumno_medicoFamiliar').val("");
					$('#crearAlumno_telefonoMF').val("");
					$('#crearAlumno_enCasoDeEmergencia').val("");
					$('#crearAlumno_alergias').val("");
					$('#crearAlumno_cuidadosEspeciales').val("");
					$('#crearAlumno_curp').val("");
					$('#crearAlumno_noSeguro').val("");
					$('#crearAlumno_fechaNacimiento').val("");
					$('#crearAlumno_lugarNacimiento').val("");
					$('#crearAlumno_nacionalidad').val("");
					$('#crearAlumno_religion').val("");
					$('#crearAlumno_tipoSangre').val("");
					$('#crearAlumno_peso').val("");
					$('#crearAlumno_talla').val("");
					$('#crearAlumno_calle').val("");
					$('#crearAlumno_numero').val("");
					$('#crearAlumno_colonia').val("");
					$('#crearAlumno_codigoPostal').val("");
					$('#crearAlumno_localidad').val("");
					$('#crearAlumno_ciudad').val("");
					$('#crearAlumno_estado').val("");
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}


function darAltaBajaAlumno(idAlumno,estatusAlumno){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
	if(estatusAlumno=="Alta"){
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas dar de baja al alumno?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, dar de baja!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				disableActionButtons();
				$.ajax({
					url:"backend/alumnos.php",
					type:"POST",
					data:{
						accion:"bajaAlta",
						idAlumno:idAlumno,
						nuevoEstatusAlumno:"Baja"
					},
					success: function(jsonresult){
						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
							enableActionButtons();
							$("#editarAlumno_modal").modal("hide");
							alumnosTable.ajax.reload();
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}else{
							enableActionButtons();
							setSwitchery(mySwitch, true);
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				enableActionButtons();
				setSwitchery(mySwitch, true);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
	}else{
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas dar de alta al alumno?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, dar de alta!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				disableActionButtons();
				$.ajax({
					url:"backend/alumnos.php",
					type:"POST",
					data:{
						accion:"bajaAlta",
						idAlumno:idAlumno,
						nuevoEstatusAlumno:"Alta"
					},
					success: function(jsonresult){
						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
							enableActionButtons();
							$("#editarAlumno_modal").modal("hide");
							alumnosTable.ajax.reload();
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}else{
							enableActionButtons();
							setSwitchery(mySwitch, false);
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				enableActionButtons();
				setSwitchery(mySwitch, false);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
	};
}

function editarAlumno(idAlumno,idPersona,nombre,apellidoPaterno,apellidoMaterno,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado,nombreAlumno,apellidoPaternoAlumno,apellidoMaternoAlumno){
	if($("#editarAlumno_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarAlumno_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/alumnos.php",
			method: "post",
			data: {
				accion:"update",
				nombreAlumno:nombreAlumno,
				apellidoPaternoAlumno:apellidoPaternoAlumno,
				apellidoMaternoAlumno:apellidoMaternoAlumno,
				idAlumno:idAlumno,
				idPersona:idPersona,
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				matricula:matricula,
				referencia:referencia,
				idGrupo:idGrupo,
				medicoFamiliar:medicoFamiliar,
				telefonoMF:telefonoMF,
				enCasoDeEmergencia:enCasoDeEmergencia,
				alergias:alergias,
				cuidadosEspeciales:cuidadosEspeciales,
				curp:curp,
				noSeguro:noSeguro,
				fechaNacimiento:fechaNacimiento,
				lugarNacimiento:lugarNacimiento,
				nacionalidad:nacionalidad,
				religion:religion,
				tipoSangre:tipoSangre,
				peso:peso,
				talla:talla,
				calle:calle,
				numero:numero,
				colonia:colonia,
				codigoPostal:codigoPostal,
				localidad:localidad,
				ciudad:ciudad,
				estado:estado
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					alumnosTable.ajax.reload();
					$("#editarAlumno_modal").modal("hide");

					$('#editarAlumno_idAlumno').val("");
					$('#editarAlumno_idPersona').val("");
					$('#editarAlumno_nombre').val("");
					$('#editarAlumno_apellidoPaterno').val("");
					$('#editarAlumno_apellidoMaterno').val("");
					$('#editarAlumno_matricula').val("");
					$('#editarAlumno_referencia').val("");
					$('#editarAlumno_idGrupo').val("");
					$('#editarAlumno_medicoFamiliar').val("");
					$('#editarAlumno_telefonoMF').val("");
					$('#editarAlumno_enCasoDeEmergencia').val("");
					$('#editarAlumno_alergias').val("");
					$('#editarAlumno_cuidadosEspeciales').val("");
					$('#editarAlumno_curp').val("");
					$('#editarAlumno_noSeguro').val("");
					$('#editarAlumno_fechaNacimiento').val("");
					$('#editarAlumno_lugarNacimiento').val("");
					$('#editarAlumno_nacionalidad').val("");
					$('#editarAlumno_religion').val("");
					$('#editarAlumno_tipoSangre').val("");
					$('#editarAlumno_peso').val("");
					$('#editarAlumno_talla').val("");
					$('#editarAlumno_calle').val("");
					$('#editarAlumno_numero').val("");
					$('#editarAlumno_colonia').val("");
					$('#editarAlumno_codigoPostal').val("");
					$('#editarAlumno_localidad').val("");
					$('#editarAlumno_ciudad').val("");
					$('#editarAlumno_estado').val("");

					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function borrarAlumno(idPersona) {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			disableActionButtons();
			$.ajax({
				url:"backend/alumnos.php",
				type:"POST",
				data:{
					accion:"delete",
					idPersona:idPersona
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						alumnosTable.ajax.reload();
						// Se oculta el modal
						$("#editarAlumno_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			enableActionButtons();
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------TUTORES---------------------------------------------------------------------------------
$("#registrarTutor_modal_Form").validate({
	rules:{
		nombre:{required: true},
		apellidoPaterno:{required: true},
		apellidoMaterno:{required: true}
	}
})

function crearTutor(nombre,apellidoPaterno,apellidoMaterno,lugarNacimiento,numeroCel,numeroTrabajo,numeroCasa,correoElectronico,religion) {
	if($("#registrarTutor_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('registrarTutor_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/tutores.php",
			method: "post",
			data: {
				accion:"create",
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				lugarNacimiento:lugarNacimiento,
				numeroCel:numeroCel,
				numeroTrabajo:numeroTrabajo,
				numeroCasa:numeroCasa,
				correoElectronico:correoElectronico,
				religion:religion
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					tutoresTable.ajax.reload();
					$("#registrarTutor_modal").modal("hide");

					$('#crearTutor_nombre').val("");
					$('#crearTutor_apellidoPaterno').val("");
					$('#crearTutor_apellidoMaterno').val("");
					$('#crearTutor_lugarNacimiento').val("");
					$('#crearTutor_numeroCel').val("");
					$('#crearTutor_numeroTrabajo').val("");
					$('#crearTutor_numeroCasa').val("");
					$('#crearTutor_correoElectronico').val("");
					$('#crearTutor_religion').val("");
					
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function editarTutor(idTutor,idPersona,nombre,apellidoPaterno,apellidoMaterno,lugarNacimiento,numeroCel,numeroTrabajo,numeroCasa,correoElectronico,religion,nombreTutor,apellidoPaternoTutor,apellidoMaternoTutor) {
	if($("#editarTutor_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarTutor_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/tutores.php",
			method: "post",
			data: {
				accion:"update",
				nombreTutor:nombreTutor,
				apellidoPaternoTutor:apellidoPaternoTutor,
				apellidoMaternoTutor:apellidoMaternoTutor,
				idTutor:idTutor,
				idPersona:idPersona,
				nombre:nombre,
				apellidoPaterno:apellidoPaterno,
				apellidoMaterno:apellidoMaterno,
				lugarNacimiento:lugarNacimiento,
				numeroCel:numeroCel,
				numeroTrabajo:numeroTrabajo,
				numeroCasa:numeroCasa,
				correoElectronico:correoElectronico,
				religion:religion
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					tutoresTable.ajax.reload();
					$("#editarTutor_modal").modal("hide");

					$('#editarTutor_idTutor').val("");
					$('#editarTutor_idPersona').val("");
					$('#editarTutor_nombre').val("");
					$('#editarTutor_apellidoPaterno').val("");
					$('#editarTutor_apellidoMaterno').val("");
					$('#editarTutor_lugarNacimiento').val("");
					$('#editarTutor_numeroCel').val("");
					$('#editarTutor_numeroTrabajo').val("");
					$('#editarTutor_numeroCasa').val("");
					$('#editarTutor_correoElectronico').val("");
					$('#editarTutor_religion').val("");

					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function borrarTutor(idPersona) {
	disableActionButtons();
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url:"backend/tutores.php",
				type:"POST",
				data:{
					accion:"delete",
					idPersona:idPersona
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						tutoresTable.ajax.reload();
						// Se oculta el modal
						$("#editarTutor_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			enableActionButtons();
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

function crearRelacion(idTutor,idAlumno,tipoRelacion){
	if($("#registrarRelacion_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('registrarRelacion_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/tutores.php",
			method: "post",
			data: {
				accion:"createRelacion",
				idTutor:idTutor,
				idAlumno:idAlumno,
				tipoRelacion:tipoRelacion
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					relacionesTable.ajax.reload();
					$("#registrarRelacion_modal").modal("hide");

					$('#crearRelacion_idTutor').val("");
					$('#crearRelacion_idAlumno').val("");
					$('#crearRelacion_tipoRelacion').val("");
					
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}
function editarRelacion(idR_tutor_alumno,tipoRelacion){
	if($("#editarRelacion_modal_Form").valid()==false){
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
    return;
  }
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarRelacion_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/tutores.php",
			method: "post",
			data: {
				accion:"updateRelacion",
				idR_tutor_alumno:idR_tutor_alumno,
				tipoRelacion:tipoRelacion
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					relacionesTable.ajax.reload();
					$("#editarRelacion_modal").modal("hide");

					$('#editarRelacion_idR_tutor_alumno').val("");
					$('#editarRelacion_idTutor').val("");
					$('#editarRelacion_idAlumno').val("");
					$('#editarRelacion_tipoRelacion').val("");

					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}
function borrarRelacion(idR_tutor_alumno){
	disableActionButtons();
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url:"backend/tutores.php",
				type:"POST",
				data:{
					accion:"deleteRelacion",
					idR_tutor_alumno:idR_tutor_alumno
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						relacionesTable.ajax.reload();
						// Se oculta el modal
						$("#editarRelacion_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			enableActionButtons();
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

//---------------------------------------------------------------------------------------------HOME---------------------------------------------------------------------------------
function crearPago(alumno,nivelEscolar,gradoyGrupo,concepto,cicloEscolar,mesColegiatura,referencia,monto,fechaPago,formaPago,folio,observaciones,estatusPago,comprobante) {
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('crearPago_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/home.php",
			method: "post",
			data: {
				accion:"createPago",
				alumno:alumno,
				nivelEscolar:nivelEscolar,
				gradoyGrupo:gradoyGrupo,
				concepto:concepto,
				cicloEscolar:cicloEscolar,
				mesColegiatura:mesColegiatura,
				referencia:referencia,
				monto:monto,
				fechaPago:fechaPago,
				formaPago:formaPago,
				folio:folio,
				observaciones:observaciones,
				estatusPago:estatusPago,
				comprobante:comprobante
			},
			success: function(jsonresult){
				enableActionButtons();
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {

					//Pregunta si se quiere imprimir un tiket
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-success',
							cancelButton: 'btn btn-danger'
						},
						buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: 'Desea imprimir el ticket?',
						text: "No se podrá imprimir después!",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Sí, imprimir!',
						cancelButtonText: 'No, continuar!',
						reverseButtons: true
					}).then((result) => {
						if (result.isConfirmed) {
							// Imprimir ticket
							$.ajax({
								url: '../build/ImpresionTermica/ticket.php',
								type: 'POST',
								data:{
									nivelEscolar:nivelEscolar,
									gradoyGrupo:gradoyGrupo,
									alumno:alumno,
									formaPago:formaPago,
									fechaPago:fechaPago,
									concepto:concepto,
									mesColegiatura:mesColegiatura,
									cicloEscolar:cicloEscolar,
									monto:monto,
									referencia:referencia,
									observaciones:observaciones,
									estatusPago:estatusPago,
									tipoPago:"pagoGeneral"
								},
								success: function(response){
										// if(response==1){
										// 		alert('Imprimiendo....');
										// }else{
										// 		alert('Error');
										// }
								}
							});

						} else if (
							/* Read more about handling dismissals below */
							result.dismiss === Swal.DismissReason.cancel
						) {
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}
					})
					 

					if(json.response.comprobanteNombre != '') {
						// SE GUARDA EL COMPROBANTE
						guardarComprobante(json.response.comprobanteNombre,'#crearPago_comprobante');
					}
					try {
						pagosTable.ajax.reload();
					} catch (error) {
					}
					$("#crearPago_modal").modal("hide");

					$('#crearPago_alumno').val("");
					$('#crearPago_nivelEscolar').val("");
					$('#disabled_crearPago_nivelEscolar').val("");
					$('#crearPago_gradoyGrupo').val("");
					$('#disabled_crearPago_gradoyGrupo').val("");
					$('#crearPago_concepto').val("");
					$('#crearPago_cicloEscolar').val("");
					$('#crearPago_mesColegiatura').val("");
					$('#crearPago_referencia').val("");
					$('#crearPago_monto').val("");
					$('#crearPago_fechaPago').val("");
					$('#crearPago_formaPago').val("");
					$('#crearPago_folio').val("");
					$('#crearPago_observaciones').val("");
					$('#crearPago_estatusPago').val("Sin aprobar");
					$('#crearPago_comprobante').val("");
					
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

// Esta función no está en uso
function editarPago(idPago,idAlumno,alumno,concepto,fechaRegistro,observaciones,estatusPago,comprobante){
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarPago_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
  	disableActionButtons();
		$.ajax({
			url: "backend/home.php",
			method: "post",
			data: {
				accion:"updatePago",
				idPago:idPago,
				idAlumno:idAlumno,
				alumno:alumno,
				concepto:concepto,
				fechaRegistro:fechaRegistro,
				observaciones:observaciones,
				estatusPago:estatusPago,
				comprobante:comprobante
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					if(json.response.comprobanteNombre != '') {
						// SE GUARDA EL COMPROBANTE
						guardarComprobante(json.response.comprobanteNombre,'#editarPago_comprobante');
					}else{
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
					pagosTable.ajax.reload();
					$("#editarPago_modal").modal("hide");

					$('#editarPago_idPago').val("");
					$('#editarPago_idAlumno').val("");
					$('#editarPago_alumno').val("");
					$('#editarPago_alumnoDisabled').val("");
					$('#editarPago_username').val("");
					$('#editarPago_nivelEscolar').val("");
					$('#editarPago_gradoyGrupo').val("");
					$('#editarPago_cicloEscolar').val("");
					$('#editarPago_fechaRegistro').val("");
					$('#editarPago_fechaRegistroDisabled').val("");
					$('#editarPago_referencia').val("");
					$('#editarPago_concepto').val("");
					$('#editarPago_conceptoDisabled').val("");
					$('#editarPago_monto').val("");
					$('#editarPago_fechaPago').val("");
					$('#editarPago_formaPago').val("");
					$('#editarPago_folio').val("");
					$('#editarPago_observaciones').val("");
					$('#editarPago_estatusPago').val("");
					$('#comprobanteDiv').val("");
					$('#editarPago_comprobante').val("");
					
				}else{
        	enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function editarPagoAdmin(idPago,idColegiatura,idAlumno,alumno,referencia,monto,fechaPago,formaPago,concepto,cicloEscolar,mesColegiatura,observaciones,fechaRegistro,folio,estatusPago,comprobante){
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarPago_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/pagos.php",
			method: "post",
			data: {
				accion:"updatePago",
				idPago:idPago,
				idColegiatura:idColegiatura,
				idAlumno:idAlumno,
				alumno:alumno,
				referencia:referencia,
				monto:monto,
				fechaPago:fechaPago,
				formaPago:formaPago,
				concepto:concepto,
				cicloEscolar:cicloEscolar,
				mesColegiatura:mesColegiatura,
				observaciones:observaciones,
				fechaRegistro:fechaRegistro,
				folio:folio,
				estatusPago:estatusPago,
				comprobante:comprobante
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					if(json.response.comprobanteNombre != '') {
						// SE GUARDA EL COMPROBANTE
						guardarComprobante(json.response.comprobanteNombre,'#editarPago_comprobante');
					}else{
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
					pagosTable.ajax.reload();
					$("#editarPago_modal").modal("hide");

					$('#editarPago_idPago').val("");
					$('#editarPago_idAlumno').val("");
					$('#editarPago_alumno').val("");
					$('#editarPago_alumnoDisabled').val("");
					$('#editarPago_username').val("");
					$('#editarPago_nivelEscolar').val("");
					$('#editarPago_gradoyGrupo').val("");
					$('#editarPago_cicloEscolar').val("");
					$('#editarPago_fechaRegistro').val("");
					$('#editarPago_fechaRegistroDisabled').val("");
					$('#editarPago_referencia').val("");
					$('#editarPago_concepto').val("");
					$('#editarPago_conceptoDisabled').val("");
					$('#editarPago_monto').val("");
					$('#editarPago_fechaPago').val("");
					$('#editarPago_formaPago').val("");
					$('#editarPago_folio').val("");
					$('#editarPago_observaciones').val("");
					$('#editarPago_estatusPago').val("");
					$('#comprobanteDiv').val("");
					$('#editarPago_comprobante').val("");
					
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function borrarRecargaSaldo(idRecargasSaldo,tipoPersona){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/pagos.php",
				type:"POST",
				data:{
					accion:"deleteRecargSaldo",
					idRecargasSaldo:idRecargasSaldo,
					tipoPersona:tipoPersona
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						recargasSaldoTable.ajax.reload();
						// Se oculta el modal
						$("#editarRecargaSaldo_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

function borrarPago(idPago,idAlumno,mesColegiatura,cicloEscolar) {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/pagos.php",
				type:"POST",
				data:{
					accion:"deletePago",
					idPago:idPago,
					idAlumno:idAlumno,
					mesColegiatura:mesColegiatura,
					cicloEscolar:cicloEscolar
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						pagosTable.ajax.reload();
						// Se oculta el modal
						$("#editarPago_modal").modal("hide");
						// Mensaje succes
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

function editarPagoComprobante(idPago,idAlumno,alumno,concepto,fechaRegistro,comprobante) {
	disableActionButtons();
	$.ajax({
		url: "backend/home.php",
		method: "post",
		data: {
			accion:"updatePagoComprobante",
			idPago:idPago,
			idAlumno:idAlumno,
			alumno:alumno,
			concepto:concepto,
			fechaRegistro:fechaRegistro,
			comprobante:comprobante
		},
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				if(json.response.comprobanteNombre != '') {
					// SE GUARDA EL COMPROBANTE
					guardarComprobante(json.response.comprobanteNombre,'#editarPago_comprobante');
				}else{
					Swal.fire({
						icon: 'success',
						title: json.response.message,
						showConfirmButton: false,
						timer: 1500
					});
				}
				pagosTable.ajax.reload();
				$("#editarPago_modal").modal("hide");

				$('#editarPago_alumnoDisabled').val("");
				$('#editarPago_nivelEscolar').val("");
				$('#editarPago_nivelEscolarDisabled').val("");
				$('#editarPago_gradoyGrupo').val("");
				$('#editarPago_gradoyGrupoDisabled').val("");
				$('#editarPago_cicloEscolar').val("");
				$('#editarPago_referencia').val("");
				$('#editarPago_concepto').val("");
				$('#editarPago_monto').val("");
				$('#editarPago_fechaPago').val("");
				$('#editarPago_formaPago').val("");
				$('#editarPago_folio').val("");
				$('#editarPago_observaciones').val("");
				$('#editarPago_comprobante').val("");
				
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
    $(input).val(''); //for clearing with Jquery
    Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "El tamaño del archivo excede los 2mb."
		})
  } else {
  }
}

function guardarComprobante(nombreComprobante,input) {
	var formData = new FormData();
	formData.append('file', $(input)[0].files[0]);
	formData.append('comprobanteNombre',nombreComprobante);
	disableActionButtons();
	
	$.ajax({
		url : 'backend/home/uploadComprobante.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		// success : function(data) {
		// 	console.log(data);
		// 	alert(data);
		// }
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'warning',
					title: "El registro se ha guardado en la base de datos, pero no se ha podido guardar el comprobante.",
					showConfirmButton: true,
					timer: 1500
				});
			}
		}
	});
}
function guardarMaterial(pathNombre,input) {
	var formData = new FormData();
	formData.append('file', $(input)[0].files[0]);
	formData.append('pathNombre',pathNombre);
	disableActionButtons();
	
	$.ajax({
		url : 'backend/materialeducativo/uploadMaterial.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		// success : function(data) {
		// 	console.log(data);
		// 	alert(data);
		// }
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'warning',
					title: "Registro guardado.",
					showConfirmButton: true,
					timer: 1500
				});
			}
		}
	});
}

function eliminarPath(path) {
	disableActionButtons();
	$.ajax({
		url:"backend/materialeducativo/deleteMaterial.php",
		type:"POST",
		data:{
			path:path
		},
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'warning',
					title: "El registro se ha eliminado de la base de datos, pero no se ha podido eliminar el archivo.",
					showConfirmButton: true,
					timer: 1500
				});
			}
		}
	});
}
function eliminarComprobante(comprobante) {
	disableActionButtons();
	$.ajax({
		url:"backend/home/deleteComprobante.php",
		type:"POST",
		data:{
			comprobanteNombre:comprobante
		},
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'warning',
					title: "El registro se ha eliminado de la base de datos, pero no se ha podido eliminar el comprobante.",
					showConfirmButton: true,
					timer: 1500
				});
			}
		}
	});
}

function fetch_select(val){
	$.ajax({
		type: 'post',
		url: 'backend/home/fetchCicloEscolardata.php',
		data: {
			get_option:val.substring(12,21)
		},
		success: function (response) {
			try {
				document.getElementById("crearPago_mesColegiatura").innerHTML=response; 
			} catch (error) {
				console.log(error)
			}
		}
	});
	if(val=="otro"){
		Swal.fire({
			title: 'Contacta a tu administrador',
			text: "Solicita a tu administrador que realice las configuraciones necesarias para continuar!",
			icon: 'warning'
		})
		$('#crearPago_cicloEscolar').val("")
  }
}

function conceptoValue(concepto) {
	if (concepto=="Colegiatura") {
		document.getElementById("crearPago_mesColegiaturaDiv").setAttribute('style', 'display:flex !important');
		document.getElementById("crearPago_mesColegiatura").required = true;
	} else {
		document.getElementById("crearPago_mesColegiaturaDiv").setAttribute('style', 'display:none !important');
		document.getElementById("crearPago_mesColegiatura").required = false;
		$('#crearPago_mesColegiatura').val("");
	}
}

//---------------------------------------------------------------------------------------------EGRESOS---------------------------------------------------------------------------------
function crearEgreso(referencia,receptor,concepto,tipoGasto,precioUnitario,cantidad,unidad,fechaPago,formaPago,observaciones,folio,estatusEgreso,comprobante){
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('crearEgreso_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};

	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/egresos.php",
			method: "post",
			data: {
				accion:"create",
				referencia:referencia,
				receptor:receptor,
				concepto:concepto,
				tipoGasto:tipoGasto,
				precioUnitario:precioUnitario,
				cantidad:cantidad,
				unidad:unidad,
				fechaPago:fechaPago,
				formaPago:formaPago,
				observaciones:observaciones,
				folio:folio,
				estatusEgreso:estatusEgreso,
				comprobante:comprobante
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					if(json.response.comprobanteNombre != '') {
						// SE GUARDA EL COMPROBANTE
						guardarComprobanteEgreso(json.response.comprobanteNombre,'#crearEgreso_comprobante');
					}else{
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
					egresosTable.ajax.reload();
					$("#crearEgreso_modal").modal("hide");

					$('#crearEgreso_referencia').val("");
					$('#crearEgreso_concepto').val("");
					$('#crearEgreso_tipoGasto').val("");
					$('#crearEgreso_precioUnitario').val("");
					$('#crearEgreso_cantidad').val("");
					$('#crearEgreso_unidad').val("");
					$('#crearEgreso_fechaPago').val("");
					$('#crearEgreso_formaPago').val("");
					$('#crearEgreso_observaciones').val("");
					$('#crearEgreso_folio').val("");
					$('#crearEgreso_estatusEgreso').val("");
					$('#crearEgreso_comprobante').val("");
					
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function guardarComprobanteEgreso(nombreComprobante,input) {
	var formData = new FormData();
	formData.append('file', $(input)[0].files[0]);
	formData.append('comprobanteNombre',nombreComprobante);
	disableActionButtons();
	
	$.ajax({
		url : 'backend/egresos/uploadComprobanteEgreso.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		// success : function(data) {
		// 	console.log(data);
		// 	alert(data);
		// }
		success: function(jsonresult){
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {
				enableActionButtons();
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{
				enableActionButtons();
				Swal.fire({
					icon: 'warning',
					title: "El registro se ha guardado en la base de datos, pero no se ha podido guardar el comprobante.",
					showConfirmButton: true,
					timer: 1500
				});

			}
		}
	});
}

function editarEgreso(idEgreso,referencia,receptor,concepto,tipoGasto,precioUnitario,cantidad,unidad,fechaRegistro,fechaPago,formaPago,observaciones,folio,estatusEgreso,comprobante,idUsuario,fechaAprobado){
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('editarEgreso_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};

	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/egresos.php",
			method: "post",
			data: {
				accion:"update",
				idEgreso:idEgreso,
				referencia:referencia,
				receptor:receptor,
				concepto:concepto,
				tipoGasto:tipoGasto,
				precioUnitario:precioUnitario,
				cantidad:cantidad,
				unidad:unidad,
				fechaRegistro:fechaRegistro,
				fechaPago:fechaPago,
				formaPago:formaPago,
				observaciones:observaciones,
				folio:folio,
				estatusEgreso:estatusEgreso,
				comprobante:comprobante,
				idUsuario:idUsuario,
				fechaAprobado:fechaAprobado
			},
			success: function(jsonresult){
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					enableActionButtons();
					if(json.response.comprobanteNombre != '') {
						// SE GUARDA EL COMPROBANTE
						guardarComprobante(json.response.comprobanteNombre,'#editarEgreso_comprobante');
					}else{
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
					egresosTable.ajax.reload();
					$("#editarEgreso_modal").modal("hide");

					$('#editarEgreso_idEgreso').val("");
					$('#editarEgreso_referencia').val("");
					$('#editarEgreso_receptor').val("");
					$('#editarEgreso_concepto').val("");
					$('#editarEgreso_tipoGasto').val("");
					$('#editarEgreso_precioUnitario').val("");
					$('#editarEgreso_cantidad').val("");
					// $('#editarEgreso_total').val("");
					$('#editarEgreso_unidad').val("");
					$('#editarEgreso_fechaRegistro').val("");
					$('#editarEgreso_fechaPago').val("");
					$('#editarEgreso_formaPago').val("");
					$('#editarEgreso_observaciones').val("");
					$('#editarEgreso_folio').val("");
					$('#editarEgreso_estatusEgreso').val("");
					$('#editarEgreso_comprobante').val("");
					$('#editarEgreso_idUsuario').val("");
					$('#editarEgreso_username').val("");
					$('#editarEgreso_fechaAprobado').val("");
					
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}

function borrarEgreso(idEgreso,comprobantePath){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/egresos.php",
				type:"POST",
				data:{
					accion:"delete",
					idEgreso:idEgreso
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						egresosTable.ajax.reload();
						// Se oculta el modal
						$("#editarEgreso_modal").modal("hide");
						
						if(comprobantePath != '') {
							// SE GUARDA EL COMPROBANTE
							eliminarComprobante(comprobantePath);
						}else{
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}

					}else{
						
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------MATERIAS---------------------------------------------------------------------------------
function crearMateria(clave,materia,nivelEscolar,grado){
  if($("#registrarMateria_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/materias.php",
		method: "post",
		data: {
			accion:"create",
			clave:clave,
			materia:materia,
			nivelEscolar:nivelEscolar,
			grado:grado
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				materiasTable.ajax.reload();
				$("#registrarMateria_modal").modal("hide");
				$('#crearMateria_clave').val("");
				$('#crearMateria_materia').val("");
				$('#crearMateria_nivelEscolar').val("");
				$('#crearMateria_grado').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarMateria(idMateria,clave,materia,nivelEscolar,grado) {
  if($("#editarMateria_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/materias.php",
		method: "post",
		data: {
			accion:"update",
			idMateria:idMateria,
			clave:clave,
			materia:materia,
			nivelEscolar:nivelEscolar,
			grado:grado
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				materiasTable.ajax.reload();
				$("#editarMateria_modal").modal("hide");
				
				$('#editarMateria_idMateria').val("");
				$('#editarMateria_clave').val("");
				$('#editarMateria_materia').val("");
				$('#editarMateria_nivelEscolar').val("");
				$('#editarMateria_grado').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarMateria(idMateria){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/materias.php",
				type:"POST",
				data:{
					accion:"delete",
					idMateria:idMateria
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						materiasTable.ajax.reload();
						// Se oculta el modal
						$("#editarMateria_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}




//---------------------------------------------------------------------------------------------GRUPO---------------------------------------------------------------------------------
function crearGrupo(idTrabajador,generacion,nivelEscolar,grado,grupo,salon){
	if($("#registrarGrupo_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/grupos.php",
		method: "post",
		data: {
			accion:"create",
			idTrabajador:idTrabajador,
			generacion:generacion,
			nivelEscolar:nivelEscolar,
			grado:grado,
			grupo:grupo,
			salon:salon
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				gruposTable.ajax.reload();
				$("#registrarGrupo_modal").modal("hide");

				$('#crearGrupo_idTrabajador').val("");
				$('#crearGrupo_generacion').val("");
				$('#crearGrupo_nivelEscolar').val("");
				$('#crearGrupo_grado').val("");
				$('#crearGrupo_grupo').val("");
				$('#crearGrupo_salon').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarGrupo(idGrupo,grado,grupo,idTrabajador,generacion,nivelEscolar,salon){
	
  if($("#editarGrupo_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/grupos.php",
		method: "post",
		data: {
			accion:"update",
			idGrupo:idGrupo,
			grado:grado,
			grupo:grupo,
			idTrabajador:idTrabajador,
			generacion:generacion,
			nivelEscolar:nivelEscolar,
			salon:salon
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				gruposTable.ajax.reload();
				gruposMateriasTable.ajax.reload();
				$("#editarGrupo_modal").modal("hide");

				$('#editarGrupo_idGrupo').val("");
				$('#editarGrupo_grado').val("");
				$('#editarGrupo_grupo').val("");
				$('#editarGrupo_idTrabajador').val("");
				$('#editarGrupo_generacion').val("");
				$('#editarGrupo_nivelEscolar').val("");
				$('#editarGrupo_salon').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarGrupo(idGrupo){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/grupos.php",
				type:"POST",
				data:{
					accion:"delete",
					idGrupo:idGrupo
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						gruposTable.ajax.reload();
						gruposMateriasTable.ajax.reload();
						// Se oculta el modal
						$("#editarGrupo_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

function relacionarMateria_Grupo(idGrupo,idTrabajador,idMateria,horaInicio,horaFin,dia){
	if($("#relacionarMateria_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/grupos.php",
		method: "post",
		data: {
			accion:"relacionarMateria_Grupo",
			idGrupo:idGrupo,
			idTrabajador:idTrabajador,
			idMateria:idMateria,
			horaInicio:horaInicio,
			horaFin:horaFin,
			dia:dia
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				gruposMateriasTable.ajax.reload();
				// $("#relacionarMateria_modal").modal("hide");

				$('#relacionarMateria_idTrabajador').val("");
				$('#relacionarMateria_idMateria').val("");
				$('#relacionarMateria_horaInicio').val("");
				$('#relacionarMateria_horaFin').val("");
				$('#relacionarMateria_dia').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});

}

function cambiarEstatusGrupo(idGrupo,estatusGrupo){
	disableActionButtons();
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	});
	if(estatusGrupo=="Activo"){
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas desactivar el grupo?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, desactivar!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url:"backend/grupos.php",
					type:"POST",
					data:{
						accion:"cambiarEstatus",
						idGrupo:idGrupo,
						nuevoestatusGrupo:"Inactivo"
					},
					success: function(jsonresult){
						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
							enableActionButtons();
							$("#editarGrupo_modal").modal("hide");
							gruposTable.ajax.reload();
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}else{
							enableActionButtons();
      				setSwitchery(mySwitch, true);
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				enableActionButtons();
				setSwitchery(mySwitch, true);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
	}else{
		swalWithBootstrapButtons.fire({
			title: 'Seguro que deseas activar el grupo?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, activar!',
			cancelButtonText: 'No, cancelar!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url:"backend/grupos.php",
					type:"POST",
					data:{
						accion:"cambiarEstatus",
						idGrupo:idGrupo,
						nuevoestatusGrupo:"Activo"
					},
					success: function(jsonresult){
						var json = $.parseJSON(jsonresult);
						if(json.response.status == 'success') {
							enableActionButtons();
							$("#editarGrupo_modal").modal("hide");
							gruposTable.ajax.reload();
							Swal.fire({
								icon: 'success',
								title: json.response.message,
								showConfirmButton: false,
								timer: 1500
							});
						}else{
							enableActionButtons();
							setSwitchery(mySwitch, false);
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: json.response.message
							})
						}
					}
				});
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
			) {
				enableActionButtons();
				setSwitchery(mySwitch, false);
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'No se ha realizado ninguna acción',
					'error'
				)
			}
		});
	};
}

function borrarHorario(horaInicio,horaFin) {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/materiasGrupos.php",
				type:"POST",
				data:{
					accion:"delete",
					horaInicio:horaInicio,
					horaFin:horaFin
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						gruposMateriasTable.ajax.reload();
						// Se oculta el modal
						$("#borrarHorario_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}

//---------------------------------------------------------------------------------------------CALIFICACIONES---------------------------------------------------------------------------------
function registrarCalificacion(idTrabajador,idAlumno,nivelEscolar,gradoyGrupo,idMateria,cicloEscolar,periodo,calificacion){
	if($("#registrarCalificacion_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/calificaciones.php",
		method: "post",
		data: {
			accion:"create",
			idTrabajador:idTrabajador,
			idAlumno:idAlumno,
			nivelEscolar:nivelEscolar,
			gradoyGrupo:gradoyGrupo,
			idMateria:idMateria,
			cicloEscolar:cicloEscolar,
			periodo:periodo,
			calificacion:calificacion
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				calificacionesTable.ajax.reload();
				// $("#registrarCalificacion_modal").modal("hide");
				// $('#crearCalificacion_idTrabajador').val("");
				// $('#crearCalificacion_alumno').val("");
				// $('#crearCalificacion_nivelEscolar').val("");
				// $('#crearCalificacion_nivelEscolarDisabled').val("");
				// $('#crearCalificacion_gradoyGrupo').val("");
				// $('#crearCalificacion_gradoyGrupoDisabled').val("");
				$('#crearCalificacion_idMateria').val("");
				// $('#crearCalificacion_cicloEscolar').val("");
				// $('#crearCalificacion_periodo').val("");
				$('#crearCalificacion_calificacion').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}


function editarCalificacion(idCalificacion,idTrabajador,idAlumno,cicloEscolar,nivelEscolar,gradoyGrupo,periodo,idMateria,calificacion){
	if($("#editarCalificacion_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/calificaciones.php",
		method: "post",
		data: {
			accion:"update",
			idCalificacion:idCalificacion,
			idTrabajador:idTrabajador,
			idAlumno:idAlumno,
			cicloEscolar:cicloEscolar,
			nivelEscolar:nivelEscolar,
			gradoyGrupo:gradoyGrupo,
			periodo:periodo,
			idMateria:idMateria,
			calificacion:calificacion
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				calificacionesTable.ajax.reload();
				$("#editarCalificacion_modal").modal("hide");

				$('#editarCalificacion_idCalificacion').val("");
				$('#editarCalificacion_idTrabajadorDisabled').val("");
				$('#editarCalificacion_idAlumnoDisabled').val("");
				$('#editarCalificacion_nivelEscolarDisabled').val("");
				$('#editarCalificacion_gradoyGrupoDisabled').val("");
				$('#editarCalificacion_cicloEscolarDisabled').val("");
				$('#editarCalificacion_periodo').val("");
				$('#editarCalificacion_idMateria').val("");
				$('#editarCalificacion_calificacion').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarCalificacion(idCalificacion){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/calificaciones.php",
				type:"POST",
				data:{
					accion:"delete",
					idCalificacion:idCalificacion
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						calificacionesTable.ajax.reload();
						// Se oculta el modal
						$("#editarCalificacion_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------CALIFICACIONES---------------------------------------------------------------------------------
function registrarTarea(idGrupo,idMateria,idTrabajador,titulo,descripcion,fechaInicio,fechaEntrega){
	if($("#registrarTarea_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/tareas.php",
		method: "post",
		data: {
			accion:"create",
			idGrupo:idGrupo,
			idMateria:idMateria,
			idTrabajador:idTrabajador,
			titulo:titulo,
			descripcion:descripcion,
			fechaInicio:fechaInicio,
			fechaEntrega:fechaEntrega
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				tareasTable.ajax.reload();
				$("#registrarTarea_modal").modal("hide");

				$('#crearTarea_idGrupo').val("");
				$('#crearTarea_idMateria').val("");
				$('#crearTarea_idTrabajador').val("");
				$('#crearTarea_titulo').val("");
				$('#crearTarea_descripcion').val("");
				$('#crearTarea_fechaInicio').val("");
				$('#crearTarea_fechaEntrega').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarTarea(idTarea,titulo,descripcion,fechaInicio,fechaEntrega) {
	if($("#editarTarea_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/tareas.php",
		method: "post",
		data: {
			accion:"update",
			idTarea:idTarea,
			titulo:titulo,
			descripcion:descripcion,
			fechaInicio:fechaInicio,
			fechaEntrega:fechaEntrega
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				tareasTable.ajax.reload();
				$("#editarTarea_modal").modal("hide");

				$('#editarTarea_idTarea').val("");
				$('#editarTarea_generacion').val("");
				$('#editarTarea_nivelEscolar').val("");
				$('#editarTarea_gradoyGrupo').val("");
				$('#editarTarea_nombreCompletoDocente').val("");
				$('#editarTarea_materia').val("");
				$('#editarTarea_titulo').val("");
				$('#editarTarea_descripcion').val("");
				$('#editarTarea_fechaInicio').val("");
				$('#editarTarea_fechaEntrega').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarTarea(idTarea){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/tareas.php",
				type:"POST",
				data:{
					accion:"delete",
					idTarea:idTarea
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						tareasTable.ajax.reload();
						// Se oculta el modal
						$("#editarTarea_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}



//---------------------------------------------------------------------------------------------NOTAS---------------------------------------------------------------------------------
function crearNota(idAlumno,titulo,texto){
	if($("#registrarNotaAlumno_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/notas.php",
		method: "post",
		data: {
			accion:"create",
			idAlumno:idAlumno,
			titulo:titulo,
			texto:texto
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				notasAlumnosTable.ajax.reload();
				$("#registrarNotaAlumno_modal").modal("hide");

				$('#crearNotaAlumno_idAlumno').val("");
				$('#crearNotaAlumno_titulo').val("");
				$('#crearNotaAlumno_texto').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});

}

function editarNotaAlumno(idNotaAlumno,titulo,texto){
	if($("#editarNotaAlumno_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/notas.php",
		method: "post",
		data: {
			accion:"update",
			idNotaAlumno:idNotaAlumno,
			titulo:titulo,
			texto:texto
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				notasAlumnosTable.ajax.reload();
				$("#editarNotaAlumno_modal").modal("hide");

				$('#editarNotaAlumno_idNotaAlumno').val("");
				$('#editarNotaAlumno_idAlumno').val("");
				$('#editarNotaAlumno_titulo').val("");
				$('#editarNotaAlumno_texto').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarNotaAlumno(idNotaAlumno){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/notas.php",
				type:"POST",
				data:{
					accion:"delete",
					idNotaAlumno:idNotaAlumno
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						notasAlumnosTable.ajax.reload();
						// Se oculta el modal
						$("#editarNotaAlumno_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}


function crearNotaAdmin(idTrabajador,titulo,texto){
	if($("#registrarNotaAdmin_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/notasAdmin.php",
		method: "post",
		data: {
			accion:"create",
			idTrabajador:idTrabajador,
			titulo:titulo,
			texto:texto
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				notasAdminTable.ajax.reload();
				$("#registrarNotaAdmin_modal").modal("hide");

				$('#crearNotaAdmin_idTrabajador').val("");
				$('#crearNotaAdmin_titulo').val("");
				$('#crearNotaAdmin_texto').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function editarNotaAdmin(idNotasAdmin,titulo,texto){
	if($("#editarNotaAdmin_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/notasAdmin.php",
		method: "post",
		data: {
			accion:"update",
			idNotasAdmin:idNotasAdmin,
			titulo:titulo,
			texto:texto
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				notasAdminTable.ajax.reload();
				$("#editarNotaAdmin_modal").modal("hide");

				$('#editarNotaAdmin_idNotasAdmin').val("");
				$('#editarNotaAdmin_idTrabajador').val("");
				$('#editarNotaAdmin_titulo').val("");
				$('#editarNotaAdmin_texto').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarNotaAdmin(idNotasAdmin){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/notasAdmin.php",
				type:"POST",
				data:{
					accion:"delete",
					idNotasAdmin:idNotasAdmin
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						notasAdminTable.ajax.reload();
						// Se oculta el modal
						$("#editarNotaAdmin_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}





//---------------------------------------------------------------------------------------------INVENTARIO---------------------------------------------------------------------------------
function crearInventario(descripcion,unidad,precioCompra,precioSugerido){
	if($("#registrarInventario_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"createInventario",
			descripcion:descripcion,
			unidad:unidad,
			precioCompra:precioCompra,
			precioSugerido:precioSugerido
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				inventarioTable.ajax.reload();
				$("#registrarInventario_modal").modal("hide");

				$('#crearInventario_descripcion').val("");
				$('#crearInventario_unidad').val("");
				$('#crearInventario_precioCompra').val("");
				$('#crearInventario_precioSugerido').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
function crearEntrada(idInventario,cantidad,costoUnitario,proveedor,observaciones){
	if($("#registrarEntrada_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"createEntrada",
			idInventario:idInventario,
			cantidad:cantidad,
			costoUnitario:costoUnitario,
			proveedor:proveedor,
			observaciones:observaciones
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				inventarioTable.ajax.reload();
				entradasTable.ajax.reload();
				$("#registrarEntrada_modal").modal("hide");
				
				$('#crearEntrada_idInventario').val("");
				$('#crearEntrada_cantidad').val("");
				$('#crearEntrada_costoUnitario').val("");
				$('#crearEntrada_proveedor').val("");
				$('#crearEntrada_observaciones').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
function crearSalida(idInventario,idAlumno,cantidad,costoUnitario,observaciones){
	if($("#registrarSalida_modal_Form").valid()==false){
    return;
  }

	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"createSalida",
			idInventario:idInventario,
			idAlumno:idAlumno,
			cantidad:cantidad,
			costoUnitario:costoUnitario,
			observaciones:observaciones
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				inventarioTable.ajax.reload();
				salidasTable.ajax.reload();
				$("#registrarSalida_modal").modal("hide");

				$('#crearSalida_idInventario').val("");
				$('#crearSalida_idAlumno').val("");
				$('#crearSalida_cantidad').val("");
				$('#crearSalida_costoUnitario').val("");
				$('#crearSalida_observaciones').val("");
				
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}


function editarInventario(idInventario,descripcion,unidad,precioCompra,precioSugerido){
	if($("#editInventario_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"updateInventario",
			idInventario:idInventario,
			descripcion:descripcion,
			unidad:unidad,
			precioCompra:precioCompra,
			precioSugerido:precioSugerido
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				inventarioTable.ajax.reload();
				$("#editInventario_modal").modal("hide");

				$('#editInventario_idInventario').val("");
				$('#editInventario_descripcion').val("");
				$('#editInventario_unidad').val("");
				$('#editInventario_precioCompra').val("");
				$('#editInventario_precioSugerido').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
function editarEntrada(idEntrada,idInventario,costoUnitario,proveedor,observaciones){
	if($("#editEntrada_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"updateEntrada",
			idEntrada:idEntrada,
			idInventario:idInventario,
			costoUnitario:costoUnitario,
			proveedor:proveedor,
			observaciones:observaciones
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				entradasTable.ajax.reload();
				$("#editEntrada_modal").modal("hide");

				$('#editEntrada_idEntrada').val("");
				$('#editEntrada_idInventario').val("");
				$('#editEntrada_descripcion').val("");
				$('#editEntrada_cantidad').val("");
				$('#editEntrada_costoUnitario').val("");
				$('#editEntrada_proveedor').val("");
				$('#editEntrada_observaciones').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
function editarSalida(idSalida,idInventario,costoUnitario,observaciones){
	if($("#editSalida_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/inventario.php",
		method: "post",
		data: {
			accion:"updateSalida",
			idSalida:idSalida,
			idInventario:idInventario,
			costoUnitario:costoUnitario,
			observaciones:observaciones
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				salidasTable.ajax.reload();
				$("#editSalida_modal").modal("hide");

				$('#editSalida_idSalida').val("");
				$('#editSalida_idInventario').val("");
				$('#editSalida_descripcion').val("");
				$('#editSalida_idAlumno').val("");
				$('#editSalida_cantidad').val("");
				$('#editSalida_costoUnitario').val("");
				$('#editSalida_observaciones').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}

function borrarInventario(idInventario){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/inventario.php",
				type:"POST",
				data:{
					accion:"deleteInventario",
					idInventario:idInventario
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						inventarioTable.ajax.reload();
						// Se oculta el modal
						$("#editInventario_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}
function borrarEntrada(idEntrada,idInventario){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/inventario.php",
				type:"POST",
				data:{
					accion:"deleteEntrada",
					idEntrada:idEntrada,
					idInventario:idInventario
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						inventarioTable.ajax.reload();
						entradasTable.ajax.reload();
						// Se oculta el modal
						$("#editEntrada_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}
function borrarSalida(idSalida,idInventario){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/inventario.php",
				type:"POST",
				data:{
					accion:"deleteSalida",
					idSalida:idSalida,
					idInventario:idInventario
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						inventarioTable.ajax.reload();
						salidasTable.ajax.reload();
						// Se oculta el modal
						$("#editSalida_modal").modal("hide");
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}





//---------------------------------------------------------------------------------------------MATERIAL EDUCATIVO---------------------------------------------------------------------------------
function crearMaterialEducativo(idGrupo,idTrabajador,titulo,descripcion,path){
	// VALIDACIÓN DE FORM (PATTERNS)
	var form = document.getElementById('crearMaterialeducativo_modal_Form');
	var required=0;
	var validity=true;
	for(var i=0; i < form.elements.length; i++){
		if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
			required++;
		}
		if(form.elements[i].validity.valid==false){
			validity=false;
		}
	};
	
	if (required==0 && validity==true) { // IF THE VALIDATION IS OK, SEND TO THE SERVER
		disableActionButtons();
		$.ajax({
			url: "backend/materialeducativo.php",
			method: "post",
			data: {
				accion:"create",
				idGrupo:idGrupo,
				idTrabajador:idTrabajador,
				titulo:titulo,
				descripcion:descripcion,
				path:path
			},
			success: function(jsonresult){
				enableActionButtons();
				var json = $.parseJSON(jsonresult);
				if(json.response.status == 'success') {
					if(json.response.pathNombre != '') {
						// SE GUARDA EL material
						guardarMaterial(json.response.pathNombre,'#crearMaterialeducativo_path');
					}else{
						Swal.fire({
							icon: 'success',
							title: json.response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
					try {
						materialeducativoTable.ajax.reload();
					} catch (error) {
					}
					$("#crearMaterialeducativo_modal").modal("hide");

					$('#crearMaterialeducativo_idGrupo').val("");
					$('#crearMaterialeducativo_idTrabajador').val("");
					$('#crearMaterialeducativo_generacion').val("");
					$('#crearMaterialeducativo_nivelEscolar').val("");
					$('#crearMaterialeducativo_gradoyGrupo').val("");
					$('#crearMaterialeducativo_titulo').val("");
					$('#crearMaterialeducativo_descripcion').val("Sin aprobar");
					$('#crearMaterialeducativo_path').val("");
					
				}else{
					enableActionButtons();
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: json.response.message
					})
				}
			}
		});
	}else if(validity==false){
		enableActionButtons();
		new PNotify({
			text: 'Llena correctamente los campos.',
			type: 'error',
			styling: 'bootstrap3'
		});
	}
}
function editarMaterialEducativo(idMaterialEducativo,descripcion){
	if($("#editarMaterialeducativo_modal_Form").valid()==false){
    return;
  }
	// Se desactivan los botones de acción y se muestra el gif
  disableActionButtons();
	$.ajax({
		url: "backend/materialeducativo.php",
		method: "post",
		data: {
			accion:"update",
			idMaterialEducativo:idMaterialEducativo,
			descripcion:descripcion
		},
		success: function(jsonresult){
			
			var json = $.parseJSON(jsonresult);
			if(json.response.status == 'success') {

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				materialeducativoTable.ajax.reload();
				$("#editarMaterialeducativo_modal").modal("hide");

				$('#editarMaterialeducativo_idMaterialEducativo').val("");
				$('#editarMaterialeducativo_idGrupo').val("");
				$('#editarMaterialeducativo_idTrabajador').val("");
				$('#editarMaterialeducativo_generacion').val("");
				$('#editarMaterialeducativo_nivelEscolar').val("");
				$('#editarMaterialeducativo_gradoyGrupo').val("");
				$('#editarMaterialeducativo_titulo').val("");
				$('#editarMaterialeducativo_descripcion').val("");
				Swal.fire({
					icon: 'success',
					title: json.response.message,
					showConfirmButton: false,
					timer: 1500
				});
			}else{

				// Se vuelve a activar los botones de acción y se oculta el gif
        enableActionButtons();
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: json.response.message
				})
			}
		}
	});
}
function eliminarMaterialEducativo(idMaterialEducativo,path){
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: false
	})

	swalWithBootstrapButtons.fire({
		title: 'Seguro que deseas eliminar el registro?',
		text: "No se podrán deshacer los cambios!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sí, eliminar!',
		cancelButtonText: 'No, cancelar!',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
		  // Se desactivan los botones de acción y se muestra el gif
      disableActionButtons();
			$.ajax({
				url:"backend/materialeducativo.php",
				type:"POST",
				data:{
					accion:"delete",
					idMaterialEducativo:idMaterialEducativo
				},
				success: function(jsonresult){
					var json = $.parseJSON(jsonresult);
					if(json.response.status == 'success') {
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						// Se recarga la tabla
						materialeducativoTable.ajax.reload();
						// Se oculta el modal
						eliminarPath(path);
						$("#editarMaterialeducativo_modal").modal("hide");
						// Swal.fire({
						// 	icon: 'success',
						// 	title: json.response.message,
						// 	showConfirmButton: false,
						// 	timer: 1500
						// });
					}else{
						// Se vuelve a activar los botones de acción y se oculta el gif
            enableActionButtons();
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: json.response.message
						})
					}
				}
			});
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
		) {
			swalWithBootstrapButtons.fire(
				'Cancelado',
				'El registro no se ha eliminado',
				'error'
			)
		}
	})
}