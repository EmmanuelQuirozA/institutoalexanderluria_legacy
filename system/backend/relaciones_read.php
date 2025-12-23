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
	$searchBynombreCompletoTutor = $_POST["searchBynombreCompletoTutor"];
	$searchBynombreCompletoAlumno = $_POST["searchBynombreCompletoAlumno"];
	$searchBytipoRelacion = $_POST["searchBytipoRelacion"];
	$searchByestatusAlumno = $_POST["searchByestatusAlumno"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"CONCAT(pt.nombre,' ',pt.apellidoPaterno,' ',pt.apellidoMaterno)"=>$searchBynombreCompletoTutor,
		"CONCAT(pa.nombre,' ',pa.apellidoPaterno,' ',pa.apellidoMaterno)"=>$searchBynombreCompletoAlumno,
		"tipoRelacion"=>$searchBytipoRelacion,
		"estatusAlumno"=>$searchByestatusAlumno
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			CONCAT(pt.nombre,' ',pt.apellidoPaterno,' ',pt.apellidoMaterno) LIKE :nombreCompleto
			) ";
		$searchArray = array( 
			'nombreCompleto'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM r_tutor_alumno rta 
  INNER JOIN tutores t ON rta.idTutor=t.idTutor
  INNER JOIN personas pt ON t.idPersona=pt.idPersona
  INNER JOIN alumnos a ON rta.idAlumno=a.idAlumno
  INNER JOIN personas pa ON a.idPersona=pa.idPersona;");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM r_tutor_alumno rta 
  INNER JOIN tutores t ON rta.idTutor=t.idTutor
  INNER JOIN personas pt ON t.idPersona=pt.idPersona
  INNER JOIN alumnos a ON rta.idAlumno=a.idAlumno
  INNER JOIN personas pa ON a.idPersona=pa.idPersona WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT 
    idR_tutor_alumno,
    rta.idTutor,
    rta.idAlumno,
    CONCAT(pt.nombre,' ',pt.apellidoPaterno,' ',pt.apellidoMaterno) AS nombreCompletoTutor,
    CONCAT(pa.nombre,' ',pa.apellidoPaterno,' ',pa.apellidoMaterno) AS nombreCompletoAlumno,
    tipoRelacion,
    estatusAlumno
    FROM r_tutor_alumno rta 
    INNER JOIN tutores t ON rta.idTutor=t.idTutor
    INNER JOIN personas pt ON t.idPersona=pt.idPersona
    INNER JOIN alumnos a ON rta.idAlumno=a.idAlumno
    INNER JOIN personas pa ON a.idPersona=pa.idPersona WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    idR_tutor_alumno,
    rta.idTutor,
    rta.idAlumno,
    CONCAT(pt.nombre,' ',pt.apellidoPaterno,' ',pt.apellidoMaterno) AS nombreCompletoTutor,
    CONCAT(pa.nombre,' ',pa.apellidoPaterno,' ',pa.apellidoMaterno) AS nombreCompletoAlumno,
    tipoRelacion,
    estatusAlumno
    FROM r_tutor_alumno rta 
    INNER JOIN tutores t ON rta.idTutor=t.idTutor
    INNER JOIN personas pt ON t.idPersona=pt.idPersona
    INNER JOIN alumnos a ON rta.idAlumno=a.idAlumno
    INNER JOIN personas pa ON a.idPersona=pa.idPersona WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idR_tutor_alumno"=>$row['idR_tutor_alumno'],
			"idTutor"=>$row['idTutor'],
			"idAlumno"=>$row['idAlumno'],
			"nombreCompletoTutor"=>$row['nombreCompletoTutor'],
			"nombreCompletoAlumno"=>$row['nombreCompletoAlumno'],
			"tipoRelacion"=>$row['tipoRelacion'],
			"estatusAlumno"=>$row['estatusAlumno']
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
