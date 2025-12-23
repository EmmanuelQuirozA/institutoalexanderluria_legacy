<?php
	include '../../build/config.php';
	session_start();
	## Read value
	$draw = $_POST['draw'];
	$row = $_POST['start'];
	$rowperpage = $_POST['length']; // Rows display per page
	$columnIndex = $_POST['order'][0]['column']; // Column index
	$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
	$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
	$searchValue = $_POST['search']['value']; // Search value

	## Custom Field value
	$searchBytipoIngreso = $_POST["searchBytipoIngreso"];
	$searchBydescripcion = $_POST["searchBydescripcion"];
	$searchByfecha = $_POST["searchByfecha"];
	$searchBymonto = $_POST["searchBymonto"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"tipoIngreso"=>$searchBytipoIngreso,
		"descripcion"=>$searchBydescripcion,
		"fecha"=>$searchByfecha,
		"monto"=>$searchBymonto
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			tipoIngreso LIKE :tipoIngreso AND
			descripcion LIKE :descripcion AND
			fecha LIKE :fecha AND
			monto LIKE :monto
			) ";
		$searchArray = array( 
			'tipoIngreso'  =>"%$searchValue%",
			'descripcion'  =>"%$searchValue%",
			'fecha'  =>"%$searchValue%",
			'monto'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM (
	SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto AS descripcion, fechaPago AS fecha, monto FROM pagos UNION
	SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto FROM recargas_saldo) consolidadoIngresos");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM (
	SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto AS descripcion, fechaPago AS fecha, monto FROM pagos UNION
	SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto FROM recargas_saldo) consolidadoIngresos WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT * FROM (
		SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto AS descripcion, fechaPago AS fecha, monto FROM pagos UNION
		SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto FROM recargas_saldo) consolidadoIngresos
				 WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

		// Bind values
		foreach($searchArray as $key=>$search){
			$stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
		}

		$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
		$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
		$stmt->execute();
		$empRecords = $stmt->fetchAll();

		$data = array();

	}else {

		$stmt = $connection->prepare("SELECT * FROM (
		SELECT idPago AS id, 'Pagos' AS tipoIngreso, concepto AS descripcion, fechaPago AS fecha, monto FROM pagos UNION
		SELECT idRecargasSaldo, 'Recarga de saldo','Recarga de saldo',fecha, monto FROM recargas_saldo) consolidadoIngresos
				 WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

		// Bind values
		foreach($searchArray as $key=>$search){
			$stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
		}

		$stmt->execute();
		$empRecords = $stmt->fetchAll();

		$data = array();
	}

	foreach($empRecords as $row){
		$data[] = array(
			"id"=>$row['id'],
			"tipoIngreso"=>$row['tipoIngreso'],
			"descripcion"=>$row['descripcion'],
			"fecha"=>$row['fecha'],
			"monto"=>$row['monto']
		);

	}

	## Response
	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);

	echo json_encode($response);
?>
