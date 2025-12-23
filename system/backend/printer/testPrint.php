<?php
	include '../../../build/config.php';
	require_once '../../../build/ImpresionTermica/ticket/autoload.php';

	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
	use Mike42\Escpos\PrintConnectors\CupsPrintConnector;

	header('Content-Type: application/json');

	$nombreImpresora = isset($_POST['nombre_impresora']) ? trim($_POST['nombre_impresora']) : '';
	$linea = isset($_POST['texto']) ? trim($_POST['texto']) : '';

	if ($nombreImpresora === '') {
		http_response_code(400);
		echo json_encode([
			'status' => 'error',
			'message' => 'Selecciona una impresora antes de enviar la prueba.'
		]);
		exit;
	}

	if ($linea === '') {
		$linea = 'Prueba de conexión - 80mm Series Printer (driver sprt-printer)';
	}

	try {
		$connector = stripos(PHP_OS, 'WIN') === 0
			? new WindowsPrintConnector($nombreImpresora)
			: new CupsPrintConnector($nombreImpresora);

		$printer = new Printer($connector);
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->text($linea . "\n");
		$printer->feed(2);
		$printer->cut();
		$printer->close();

		echo json_encode([
			'status' => 'success',
			'message' => 'Se envió la línea de prueba a la impresora seleccionada.'
		]);
	} catch (Throwable $e) {
		http_response_code(500);
		echo json_encode([
			'status' => 'error',
			'message' => 'No se pudo imprimir la prueba. Verifica la conexión y el driver sprt-printer.'
		]);
	}
?>
