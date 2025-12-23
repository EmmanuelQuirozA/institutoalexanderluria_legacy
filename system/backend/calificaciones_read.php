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
	$searchBynivelEscolar = $_POST["searchBynivelEscolar"];
	$searchBygradoyGrupo = $_POST["searchBygradoyGrupo"];
	$searchBymateria = $_POST["searchBymateria"];
	$searchBynombreCompletoDocente = $_POST["searchBynombreCompletoDocente"];
	$searchBynombreCompletoAlumno = $_POST["searchBynombreCompletoAlumno"];
	$searchBycicloEscolar = $_POST["searchBycicloEscolar"];
	$searchByperiodo = $_POST["searchByperiodo"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"c.nivelEscolar"=>$searchBynivelEscolar,
		"c.gradoyGrupo"=>$searchBygradoyGrupo,
		"materia"=>$searchBymateria,
		"CONCAT(pTrabajador.nombre,' ',pTrabajador.apellidoPaterno,' ',pTrabajador.apellidoMaterno)"=>$searchBynombreCompletoDocente,
		"CONCAT(pAlumno.nombre,' ',pAlumno.apellidoPaterno,' ',pAlumno.apellidoMaterno)"=>$searchBynombreCompletoAlumno,
		"cicloEscolar"=>$searchBycicloEscolar,
		"periodo"=>$searchByperiodo
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			CONCAT(pTrabajador.nombre,' ',pTrabajador.apellidoPaterno,' ',pTrabajador.apellidoMaterno) LIKE :searchBynombreCompletoDocente
			) ";
		$searchArray = array( 
			'searchBynombreCompletoDocente'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM calificaciones c
    INNER JOIN materias m ON c.idMateria=m.idMateria
    INNER JOIN alumnos a ON c.idAlumno=a.idAlumno
    INNER JOIN personas pAlumno ON a.idPersona=pAlumno.idPersona
    INNER JOIN ciclosescolares ce ON c.idCicloEscolar=ce.idCicloEscolar
    LEFT JOIN trabajadores t ON c.idTrabajador=t.idTrabajador
    LEFT JOIN personas pTrabajador ON t.idPersona=pTrabajador.idPersona");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM calificaciones c
    INNER JOIN materias m ON c.idMateria=m.idMateria
    INNER JOIN alumnos a ON c.idAlumno=a.idAlumno
    INNER JOIN personas pAlumno ON a.idPersona=pAlumno.idPersona
    INNER JOIN ciclosescolares ce ON c.idCicloEscolar=ce.idCicloEscolar
    LEFT JOIN trabajadores t ON c.idTrabajador=t.idTrabajador
    LEFT JOIN personas pTrabajador ON t.idPersona=pTrabajador.idPersona WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT 
    idCalificacion,
    materia,
    CONCAT(pTrabajador.nombre,' ',pTrabajador.apellidoPaterno,' ',pTrabajador.apellidoMaterno) AS nombreCompletoDocente,
    CONCAT(pAlumno.nombre,' ',pAlumno.apellidoPaterno,' ',pAlumno.apellidoMaterno) AS nombreCompletoAlumno,
    cicloEscolar,
    periodo,
    c.nivelEscolar,
    c.gradoyGrupo,
    calificacion,
  c.idTrabajador,
  c.idAlumno,
  c.idMateria,
  c.idCicloEscolar
    FROM calificaciones c
    INNER JOIN materias m ON c.idMateria=m.idMateria
    INNER JOIN alumnos a ON c.idAlumno=a.idAlumno
    INNER JOIN personas pAlumno ON a.idPersona=pAlumno.idPersona
    INNER JOIN ciclosescolares ce ON c.idCicloEscolar=ce.idCicloEscolar
    LEFT JOIN trabajadores t ON c.idTrabajador=t.idTrabajador
    LEFT JOIN personas pTrabajador ON t.idPersona=pTrabajador.idPersona WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    idCalificacion,
    materia,
    CONCAT(pTrabajador.nombre,' ',pTrabajador.apellidoPaterno,' ',pTrabajador.apellidoMaterno) AS nombreCompletoDocente,
    CONCAT(pAlumno.nombre,' ',pAlumno.apellidoPaterno,' ',pAlumno.apellidoMaterno) AS nombreCompletoAlumno,
    cicloEscolar,
    periodo,
    c.nivelEscolar,
    c.gradoyGrupo,
    calificacion,
  c.idTrabajador,
  c.idAlumno,
  c.idMateria,
  c.idCicloEscolar
    FROM calificaciones c
    INNER JOIN materias m ON c.idMateria=m.idMateria
    INNER JOIN alumnos a ON c.idAlumno=a.idAlumno
    INNER JOIN personas pAlumno ON a.idPersona=pAlumno.idPersona
    INNER JOIN ciclosescolares ce ON c.idCicloEscolar=ce.idCicloEscolar
    LEFT JOIN trabajadores t ON c.idTrabajador=t.idTrabajador
    LEFT JOIN personas pTrabajador ON t.idPersona=pTrabajador.idPersona WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idCalificacion"=>$row['idCalificacion'],
			"materia"=>$row['materia'],
			"nombreCompletoDocente"=>$row['nombreCompletoDocente'],
			"nombreCompletoAlumno"=>$row['nombreCompletoAlumno'],
			"cicloEscolar"=>$row['cicloEscolar'],
			"periodo"=>$row['periodo'],
			"nivelEscolar"=>$row['nivelEscolar'],
			"gradoyGrupo"=>$row['gradoyGrupo'],
			"calificacion"=>$row['calificacion'],
			"idTrabajador"=>$row['idTrabajador'],
			"idAlumno"=>$row['idAlumno'],
			"idMateria"=>$row['idMateria'],
			"idCicloEscolar"=>$row['idCicloEscolar']
			
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
