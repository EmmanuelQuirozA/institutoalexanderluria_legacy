<?php
	include '../../../build/config.php';

	header('Content-Type: application/json');

	function obtenerImpresorasWindows() {
		$impresoras = [];

		@exec('powershell -Command "Get-Printer | Select-Object -ExpandProperty Name"', $powershellPrinters);
		if (!empty($powershellPrinters)) {
			foreach ($powershellPrinters as $printer) {
				$printerName = trim($printer);
				if ($printerName !== '') {
					$impresoras[] = $printerName;
				}
			}
		}

		if (empty($impresoras)) {
			@exec('wmic printer get name', $wmicPrinters);
			if (!empty($wmicPrinters)) {
				foreach ($wmicPrinters as $printer) {
					$printerName = trim($printer);
					if ($printerName !== '' && stripos($printerName, 'Name') !== 0) {
						$impresoras[] = $printerName;
					}
				}
			}
		}

		return array_values(array_unique($impresoras));
	}

	function obtenerImpresorasLinux() {
		$impresoras = [];
		$lpstat = @shell_exec('lpstat -a 2>/dev/null');

		if ($lpstat !== null) {
			$lineas = preg_split("/\\r\\n|\\n|\\r/", trim($lpstat));
			foreach ($lineas as $linea) {
				$nombre = trim(strtok($linea, ' '));
				if ($nombre !== '') {
					$impresoras[] = $nombre;
				}
			}
		}

		return array_values(array_unique($impresoras));
	}

	try {
		$listaImpresoras = stripos(PHP_OS, 'WIN') === 0 ? obtenerImpresorasWindows() : obtenerImpresorasLinux();

		echo json_encode([
			'status' => 'success',
			'printers' => $listaImpresoras
		]);
	} catch (Throwable $e) {
		http_response_code(500);
		echo json_encode([
			'status' => 'error',
			'message' => 'No se pudieron obtener las impresoras disponibles.'
		]);
	}
?>
