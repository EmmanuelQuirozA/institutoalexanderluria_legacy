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
	if ($columnName==="0") {
		$columnName="alumno";
	}

	$cicloEscolar = $_POST['cicloEscolar'];

	$searchArray = array();

	## Search 
	$searchQuery = " ";
	if($searchValue != ''){
		$searchQuery = "AND (alumno LIKE :alumno)";
		$searchArray = array( 
			'alumno' =>"%$searchValue%"
		);
	}

	$columns = array();
	$counter=1;
	$stmt = $connection->prepare("SHOW fields FROM `".$cicloEscolar."` ;");
	// SHOW COLUMNS FROM instituto_alumno.`colegiaturas2021-2022` ;
	$stmt->execute();
	$empRecords = $stmt->fetch();

	foreach($empRecords as $row){
		// "1"=>$row['idcolegiaturas2021-2022'],
		array_push($columns);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM `".$cicloEscolar."` ");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM `".$cicloEscolar."` WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	$stmt = $connection->prepare("SELECT * FROM `".$cicloEscolar."` INNER JOIN alumnos ON `".$cicloEscolar."`.idAlumno=alumnos.idAlumno WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

	// Bind values
	foreach($searchArray as $key=>$search){
		$stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
	}

	$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
	$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
	$stmt->execute();
	$empRecords = $stmt->fetchAll();

	// $data = array();
	
	// foreach($empRecords as $row){
	// 	$data[] = array(
	// 		1=>$row['idcolegiaturas2021-2022'],
	// 		2=>$row['idAlumno'],
	// 		3=>$row['alumno'],
	// 		4=>$row['Agosto-2021'],
	// 		5=>$row['Septiembre-2021'],
	// 		6=>$row['Octubre-2021'],
	// 		7=>$row['Noviembre-2021'],
	// 		8=>$row['Diciembre-2021'],
	// 		9=>$row['Enero-2022'],
	// 		10=>$row['Febrero-2022'],
	// 		11=>$row['Marzo-2022'],
	// 		12=>$row['Abril-2022'],
	// 		13=>$row['Mayo-2022'],
	// 		14=>$row['Junio-2022'],
	// 		15=>$row['Julio-2022']
	// 	);
	// }

	## Response
	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $empRecords
	);

	echo json_encode($response);
?>

