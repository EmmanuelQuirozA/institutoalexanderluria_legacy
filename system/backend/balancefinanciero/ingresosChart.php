<?php 
	include '../../../build/config.php';
  $fechaInicial = $_POST['fechaInicial'];
  $fechaFinal = $_POST['fechaFinal'];
  if ($fechaInicial&&$fechaFinal) {
    $stmt = $connection->prepare("SELECT tipoIngreso,SUM(monto) AS monto FROM(SELECT * FROM(
    SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto, fechaPago as fecha, monto FROM pagos UNION
    SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto 
    FROM recargas_saldo) consolidadoIngresos WHERE fecha BETWEEN :fechaInicial AND :fechaFinal) consolidadoIngresosFiltrado group by tipoIngreso");
    $stmt->bindValue(':fechaInicial', $fechaInicial,PDO::PARAM_STR);
    $stmt->bindValue(':fechaFinal', $fechaFinal,PDO::PARAM_STR);
  }else{
    $stmt = $connection->prepare("SELECT tipoIngreso,SUM(monto) AS monto FROM(SELECT * FROM(
    SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto, fechaPago as fecha, monto FROM pagos UNION
    SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto 
    FROM recargas_saldo) consolidadoIngresos) consolidadoIngresosFiltrado group by tipoIngreso");
  }

  $stmt->execute();
  $empRecords = $stmt->fetchAll();

  $data[0][0] = 'tipoIngreso';
  $data[0][1] = 'monto';
  $x = 1;
  
	foreach($empRecords as $row){
    $data[$x][0] = $row["tipoIngreso"];
    $data[$x][1] = (FLOAT)$row["monto"];
    $x++;
	}

	echo json_encode($data);
?>