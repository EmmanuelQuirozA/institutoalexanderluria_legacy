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
	$searchByreferencia = $_POST["searchByreferencia"];
	$searchByreceptor = $_POST["searchByreceptor"];
	$searchByconcepto = $_POST["searchByconcepto"];
	$searchBytipoGasto = $_POST["searchBytipoGasto"];
	$searchByprecioUnitario = $_POST["searchByprecioUnitario"];
	$searchBycantidad = $_POST["searchBycantidad"];
	$searchBytotal = $_POST["searchBytotal"];
	$searchByunidad = $_POST["searchByunidad"];
	$searchByfechaRegistro = $_POST["searchByfechaRegistro"];
	$searchByfechaPago = $_POST["searchByfechaPago"];
	$searchByformaPago = $_POST["searchByformaPago"];
	$searchByobservaciones = $_POST["searchByobservaciones"];
	$searchByfolio = $_POST["searchByfolio"];
	$searchByestatusEgreso = $_POST["searchByestatusEgreso"];
	$searchByusername = $_POST["searchByusername"];
	$searchByfechaAprobado = $_POST["searchByfechaAprobado"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"referencia"=>$searchByreferencia,
		"receptor"=>$searchByreceptor,
		"concepto"=>$searchByconcepto,
		"tipoGasto"=>$searchBytipoGasto,
		"precioUnitario"=>$searchByprecioUnitario,
		"cantidad"=>$searchBycantidad,
		"total"=>$searchBytotal,
		"unidad"=>$searchByunidad,
		"fechaRegistro"=>$searchByfechaRegistro,
		"fechaPago"=>$searchByfechaPago,
		"formaPago"=>$searchByformaPago,
		"observaciones"=>$searchByobservaciones,
		"folio"=>$searchByfolio,
		"estatusEgreso"=>$searchByestatusEgreso,
		"username"=>$searchByusername,
		"fechaAprobado"=>$searchByfechaAprobado
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			referencia LIKE :referencia AND
			receptor LIKE :receptor AND
			concepto LIKE :concepto AND
			tipoGasto LIKE :tipoGasto AND
			precioUnitario LIKE :precioUnitario AND
			cantidad LIKE :cantidad AND
			total LIKE :total AND
			unidad LIKE :unidad AND
			fechaRegistro LIKE :fechaRegistro AND
			fechaPago LIKE :fechaPago AND
			formaPago LIKE :formaPago AND
			observaciones LIKE :observaciones AND
			folio LIKE :folio AND
			estatusEgreso LIKE :estatusEgreso AND
			username LIKE :username AND
			fechaAprobado LIKE :fechaAprobado
			) ";
		$searchArray = array( 
			'referencia'  =>"%$searchValue%",
			'receptor'  =>"%$searchValue%",
			'concepto'  =>"%$searchValue%",
			'tipoGasto'  =>"%$searchValue%",
			'precioUnitario'  =>"%$searchValue%",
			'cantidad'  =>"%$searchValue%",
			'total'  =>"%$searchValue%",
			'unidad'  =>"%$searchValue%",
			'fechaRegistro'  =>"%$searchValue%",
			'fechaPago'  =>"%$searchValue%",
			'formaPago'  =>"%$searchValue%",
			'observaciones'  =>"%$searchValue%",
			'folio'  =>"%$searchValue%",
			'estatusEgreso'  =>"%$searchValue%",
			'username'  =>"%$searchValue%",
			'fechaAprobado'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM egresos INNER JOIN usuarios ON egresos.idUsuario=usuarios.idUsuario");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM egresos INNER JOIN usuarios ON egresos.idUsuario=usuarios.idUsuario WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT 
		idEgreso,
		referencia,
		receptor,
		concepto,
		tipoGasto,
		precioUnitario,
		cantidad,
		total,
		unidad,
		fechaRegistro,
		fechaPago,
		formaPago,
		observaciones,
		folio,
		estatusEgreso,
		comprobante,
		egresos.idUsuario,
		username,
		fechaAprobado
		FROM egresos 
		INNER JOIN usuarios ON egresos.idUsuario=usuarios.idUsuario
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

		$stmt = $connection->prepare("SELECT 
		idEgreso,
		referencia,
		receptor,
		concepto,
		tipoGasto,
		precioUnitario,
		cantidad,
		total,
		unidad,
		fechaRegistro,
		fechaPago,
		formaPago,
		observaciones,
		folio,
		estatusEgreso,
		comprobante,
		egresos.idUsuario,
		username,
		fechaAprobado
		FROM egresos 
		INNER JOIN usuarios ON egresos.idUsuario=usuarios.idUsuario
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
			"idEgreso"=>$row['idEgreso'],
			"referencia"=>$row['referencia'],
			"receptor"=>$row['receptor'],
			"concepto"=>$row['concepto'],
			"tipoGasto"=>$row['tipoGasto'],
			"precioUnitario"=>$row['precioUnitario'],
			"cantidad"=>$row['cantidad'],
			"total"=>$row['total'],
			"unidad"=>$row['unidad'],
			"fechaRegistro"=>$row['fechaRegistro'],
			"fechaPago"=>$row['fechaPago'],
			"formaPago"=>$row['formaPago'],
			"observaciones"=>$row['observaciones'],
			"folio"=>$row['folio'],
			"estatusEgreso"=>$row['estatusEgreso'],
			"comprobante"=>$row['comprobante'],
			"idUsuario"=>$row['idUsuario'],
			"username"=>$row['username'],
			"fechaAprobado"=>$row['fechaAprobado']
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
