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

	$searchArray = array();

	## Search 
	$searchQuery = " ";
	if($searchValue != ''){
		$searchQuery = " AND (
			CONCAT(nombre,' ',apellidoPaterno,' ',apellidoMaterno)  LIKE :nombreCompleto OR 
			username  LIKE :username OR
			fecha  LIKE :fecha OR
			descripcion  LIKE :descripcion OR
			cantidad  LIKE :cantidad OR
			precioUnitario  LIKE :precioUnitario OR
			cantidad  LIKE :cantidad OR
			totalUnitario  LIKE :totalUnitario 
			) ";
		$searchArray = array( 
			'nombreCompleto'=>"%$searchValue%",
			'username'=>"%$searchValue%",
			'fecha'=>"%$searchValue%",
			'descripcion'=>"%$searchValue%",
			'cantidad'=>"%$searchValue%",
			'precioUnitario'=>"%$searchValue%",
			'cantidad'=>"%$searchValue%",
			'totalUnitario'=>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM ventas_cocina INNER JOIN personas ON ventas_cocina.idPersona=personas.idPersona 
	INNER JOIN usuarios ON ventas_cocina.idUsuario=usuarios.idUsuario");
	$stmt->execute();
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM ventas_cocina INNER JOIN personas ON ventas_cocina.idPersona=personas.idPersona 
	INNER JOIN usuarios ON ventas_cocina.idUsuario=usuarios.idUsuario AND 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){
		$stmt = $connection->prepare("SELECT 
		idVenta_Cocina,
		CONCAT(nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto,
		username,
		fecha,
		descripcion,
		cantidad,
		precioUnitario,
		totalUnitario  
		FROM ventas_cocina 
		INNER JOIN personas ON ventas_cocina.idPersona=personas.idPersona 
		INNER JOIN usuarios ON ventas_cocina.idUsuario=usuarios.idUsuario WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

		// Bind values
		foreach($searchArray as $key=>$search){
			$stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
		}

		$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
		$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
		$stmt->execute();
		$empRecords = $stmt->fetchAll();

		$data = array();
	}else{
		
		$stmt = $connection->prepare("SELECT 
		idVenta_Cocina,
		CONCAT(nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto,
		username,
		fecha,
		descripcion,
		cantidad,
		precioUnitario,
		totalUnitario  
		FROM ventas_cocina 
		INNER JOIN personas ON ventas_cocina.idPersona=personas.idPersona 
		INNER JOIN usuarios ON ventas_cocina.idUsuario=usuarios.idUsuario WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idVenta_Cocina"=>$row['idVenta_Cocina'],
			"nombreCompleto"=>$row['nombreCompleto'],
			"username"=>$row['username'],
			"fecha"=>$row['fecha'],
			"descripcion"=>$row['descripcion'],
			"cantidad"=>$row['cantidad'],
			"precioUnitario"=>$row['precioUnitario'],
			"totalUnitario"=>$row['totalUnitario']
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

