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
	$searchBydescripcion = $_POST["searchBydescripcion"];
	$searchByexistencia = $_POST["searchByexistencia"];
	$searchByunidad = $_POST["searchByunidad"];
	$searchByprecioCompra = $_POST["searchByprecioCompra"];
	$searchByprecioSugerido = $_POST["searchByprecioSugerido"];
	$searchByfechaAlta = $_POST["searchByfechaAlta"];
	$searchByusername = $_POST["searchByusername"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"descripcion"=>$searchBydescripcion,
		"existencia"=>$searchByexistencia,
		"unidad"=>$searchByunidad,
		"precioCompra"=>$searchByprecioCompra,
		"precioSugerido"=>$searchByprecioSugerido,
		"fechaAlta"=>$searchByfechaAlta,
		"username"=>$searchByusername
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			descripcion LIKE :descripcion
			) ";
		$searchArray = array( 
			'descripcion'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM inventario i
  INNER JOIN usuarios u ON i.idUsuario=u.idUsuario");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM inventario i
  INNER JOIN usuarios u ON i.idUsuario=u.idUsuario WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT
    idInventario,
    i.idUsuario,
    descripcion,
    existencia,
    unidad,
    precioCompra,
    precioSugerido,
    fechaAlta,
    username
    FROM inventario i
    INNER JOIN usuarios u ON i.idUsuario=u.idUsuario WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    idInventario,
    i.idUsuario,
    descripcion,
    existencia,
    unidad,
    precioCompra,
    precioSugerido,
    fechaAlta,
    username
    FROM inventario i
    INNER JOIN usuarios u ON i.idUsuario=u.idUsuario WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idInventario"=>$row['idInventario'],
			"idUsuario"=>$row['idUsuario'],
			"descripcion"=>$row['descripcion'],
			"existencia"=>$row['existencia'],
			"unidad"=>$row['unidad'],
			"precioCompra"=>$row['precioCompra'],
			"precioSugerido"=>$row['precioSugerido'],
			"fechaAlta"=>$row['fechaAlta'],
			"username"=>$row['username']
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
