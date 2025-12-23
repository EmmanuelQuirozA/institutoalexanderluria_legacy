<?php 
	include '../../../build/config.php';
  $fechaInicial = $_POST['fechaInicial'];
  $fechaFinal = $_POST['fechaFinal'];
  if ($fechaInicial&&$fechaFinal) {
    $stmt = $connection->prepare("SELECT consolidadoIngreso.fecha AS fecha, ingreso,egreso, (ingreso-egreso) AS ganancia FROM ( SELECT CONCAT(MONTH(fecha),'-',YEAR(fecha)) AS fecha,SUM(monto) AS ingreso FROM
    (SELECT * FROM(
    SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto, fechaPago AS fecha, monto FROM pagos UNION
    SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto 
    FROM recargas_saldo) consolidadoIngresos WHERE fecha BETWEEN :fechaInicial AND :fechaFinal) consolidadoIngresosFiltrado group by CONCAT(MONTH(fecha),'-',YEAR(fecha))) consolidadoIngreso
    INNER JOIN (SELECT CONCAT(MONTH(fechaPago),'-',YEAR(fechaPago)) AS fecha, SUM(total) AS egreso FROM egresos group by CONCAT(MONTH(fechaPago),'-',YEAR(fechaPago))) consolidadoEgresos ON consolidadoIngreso.fecha=consolidadoEgresos.fecha");
  
    $stmt->bindValue(':fechaInicial', $fechaInicial,PDO::PARAM_STR);
    $stmt->bindValue(':fechaFinal', $fechaFinal,PDO::PARAM_STR);
  }else{
    $stmt = $connection->prepare("SELECT consolidadoIngreso.fecha AS fecha, ingreso,egreso, (ingreso-egreso) AS ganancia FROM ( SELECT CONCAT(MONTH(fecha),'-',YEAR(fecha)) AS fecha,SUM(monto) AS ingreso FROM
    (SELECT * FROM(
    SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto, fechaPago AS fecha, monto FROM pagos UNION
    SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto 
    FROM recargas_saldo) consolidadoIngresos) consolidadoIngresosFiltrado group by CONCAT(MONTH(fecha),'-',YEAR(fecha))) consolidadoIngreso
    INNER JOIN (SELECT CONCAT(MONTH(fechaPago),'-',YEAR(fechaPago)) AS fecha, SUM(total) AS egreso FROM egresos group by CONCAT(MONTH(fechaPago),'-',YEAR(fechaPago))) consolidadoEgresos ON consolidadoIngreso.fecha=consolidadoEgresos.fecha");
  }


  


  $stmt->execute();
  $empRecords = $stmt->fetchAll();

  $data[0][0] = 'fecha';
  $data[0][1] = 'ingreso';
  $data[0][2] = 'egreso';
  $data[0][3] = 'ganancia';
  $x = 1;
  
	foreach($empRecords as $row){
    $data[$x][0] = $row["fecha"];
    $data[$x][1] = (FLOAT)$row["ingreso"];
    $data[$x][2] = (FLOAT)$row["egreso"];
    $data[$x][3] = (FLOAT)$row["ganancia"];
    $x++;
	}

	echo json_encode($data);
?>