<?php
include '../config.php';
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$nombre_impresora = "impresoraTermica"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);

if($_POST['tipoPago']=="saldoAlumno"){
	$idPersona = trim($_POST['idPersona']);
    
    // Consulta para obtener el saldo actual (se usa un statement preparado para seguridad)
    $sql = "SELECT saldo FROM alumnos WHERE idPersona = :idPersona";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['idPersona' => $idPersona]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $saldo = $result['saldo'];
    } else {
        $saldo = "Ocurrió un error, favor de validar"; // En caso de no encontrar registro
    }

	$idAlumno=trim($_POST['idAlumno']);
	$cantidad=trim($_POST['cantidad']);
	$saldoActual=trim($_POST['saldo']);
	
	$printer->text("\n"."Instituto Alexander Luria" . "\n");
	$printer->text("Direccion: C. Isaac Calderón 465, La Soledad, 58118 Morelia, Mich." . "\n");
	$printer->text("Tel: 443 321 0592" . "\n");
	#La fecha también
	date_default_timezone_set("America/Mexico_City");
	$printer->text(date("Y-m-d H:i:s") . "\n");
	$printer->text("-----------------------------" . "\n");
	$printer->text("\n"."Recarga de saldo" . "\n");
	$printer->text("Alumno: ".$idAlumno . "\n");
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("Saldo anterior: $".$saldoActual . "\n");
	$printer->text("Saldo ingresado: $".$cantidad . "\n");
	$printer->text("Saldo actual: $".$saldo . "\n");
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	
	$printer->text("-----------------------------"."\n");
}elseif ($_POST['tipoPago']=="saldoTrabajador") {
	$idPersona = trim($_POST['idPersona']);
    
    // Consulta para obtener el saldo actual (se usa un statement preparado para seguridad)
    $sql = "SELECT saldo FROM trabajadores WHERE idPersona = :idPersona";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['idPersona' => $idPersona]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $saldo = $result['saldo'];
    } else {
        $saldo = "Ocurrió un error, favor de validar"; // En caso de no encontrar registro
    }

	$idTrabajador=trim($_POST['idTrabajador']);
	$cantidad=trim($_POST['cantidad']);
	$saldoActual=trim($_POST['saldo']);
	
	$printer->text("\n"."Instituto Alexander Luria" . "\n");
	$printer->text("Direccion: C. Isaac Calderón 465, La Soledad, 58118 Morelia, Mich." . "\n");
	$printer->text("Tel: 443 321 0592" . "\n");
	#La fecha también
	date_default_timezone_set("America/Mexico_City");
	$printer->text(date("Y-m-d H:i:s") . "\n");
	$printer->text("-----------------------------" . "\n");
	$printer->text("\n"."Recarga de saldo" . "\n");
	$printer->text("Trabajador: ".$idTrabajador . "\n");
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("Saldo anterior: $".$saldoActual . "\n");
	$printer->text("Saldo ingresado: $".$cantidad . "\n");
	$printer->text("Saldo actual: $".$saldo . "\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	
	$printer->text("-----------------------------"."\n");
	// $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
}elseif ($_POST['tipoPago']=="pagoGeneral") {
	
	$idAlumnoPago = $_POST['idAlumnoPago'];
	$nivelEscolar = $_POST['nivelEscolar'];
	$gradoyGrupo = $_POST['gradoyGrupo'];
	$alumno = $_POST['alumno'];
	$formaPago = $_POST['formaPago'];
	$fechaPago = $_POST['fechaPago'];
	$fechaRegistro = $_POST['fechaRegistro'];
	$concepto = $_POST['concepto'];
	$mesColegiatura = $_POST['mesColegiatura'];
	$cicloEscolar = substr($_POST['cicloEscolar'],12) ;
	$monto = $_POST['monto'];
	$idUsuario = $_POST['idUsuario'];
	$observaciones = $_POST['observaciones'];
	
	$printer->text("\n"."Instituto Alexander Luria" . "\n");
	$printer->text("Direccion: C. Isaac Calderón 465, La Soledad, 58118 Morelia, Mich." . "\n");
	$printer->text("Tel: 443 321 0592" . "\n");
	#La fecha también
	date_default_timezone_set("America/Mexico_City");
	$printer->text(date("Y-m-d H:i:s") . "\n");
	$printer->text("-----------------------------" . "\n");
	$printer->text("\n".$concepto. "\n");
	$printer->text("Alumno: ".$alumno . "\n");
	$printer->text("Nivel escolar: ".$nivelEscolar . "\n");
	$printer->text("Grado y grupo: ".$gradoyGrupo . "\n");
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("Forma de pago: ".$formaPago . "\n");
	$printer->text("Fecha de pago: ".$fechaPago . "\n");
	// $printer->text("Fecha registrada: ".$fechaRegistro . "\n");
	$printer->text("Referencia: ".$referencia . "\n");
	$printer->text("Mes: ".$mesColegiatura . "\n");
	$printer->text("Ciclo escolar: ".$cicloEscolar. "\n");
	
	$printer->setJustification(Printer::JUSTIFY_RIGHT);
	$printer->text("Monto: $".$monto . "\n");
	
	$printer->setJustification(Printer::JUSTIFY_CENTER);

	$printer->text("-----------------------------"."\n");
	$printer->text("Observaciones: ".$observaciones . "\n");
	// $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
}

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Muchas gracias por su pago\n");


$printer->feed(2);
$printer->cut();
$printer->pulse();
$printer->close();
echo $saldo;
?>