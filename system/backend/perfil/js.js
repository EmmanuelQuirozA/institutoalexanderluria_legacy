$(document).on('click', '.editarContrasena', function(){
	$("#editarcontrasena_modal").modal("toggle");
});
$(document).on('click', '.contrasena_editRegistro', function(){
	var password = document.getElementById('editarcontrasena_password').value;
	var passwordConfirm = document.getElementById('editarcontrasena_passwordConfirm').value;
	editarContrasena(password,passwordConfirm);
});
