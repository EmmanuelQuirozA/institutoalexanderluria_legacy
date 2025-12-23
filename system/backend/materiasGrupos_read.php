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
  
	$searchBygeneracion = $_POST["searchBygeneracion"];
	$searchBynivelEscolar = $_POST["searchBynivelEscolar"];
	$searchBygradoyGrupo = $_POST["searchBygradoyGrupo"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"generacion"=>$searchBygeneracion,
		"nivelEscolar"=>$searchBynivelEscolar,
		"CONCAT(grado,'-',grupo)"=>$searchBygradoyGrupo
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			generacion LIKE :generacion AND
			nivelEscolar LIKE :nivelEscolar AND
			CONCAT(grado,'-',grupo) LIKE :gradoyGrupo
			) ";
		$searchArray = array( 
			'generacion'  =>"%$searchValue%",
			'nivelEscolar'  =>"%$searchValue%",
			'gradoyGrupo'  =>"%$searchValue%",
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM    (
			SELECT idHorario,h.idGrupo,h.idTrabajador,h.horaInicio,h.horaFin,m.materia,h.dia 
			FROM horarios h 
				INNER JOIN materias m ON m.idMateria=h.idMateria
				INNER JOIN grupos g ON h.idGrupo = g.idGrupo
		) ho 
		INNER JOIN grupos g ON ho.idGrupo = g.idGrupo");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM    (
			SELECT idHorario,h.idGrupo,h.idTrabajador,h.horaInicio,h.horaFin,m.materia,h.dia 
			FROM horarios h 
				INNER JOIN materias m ON m.idMateria=h.idMateria
				INNER JOIN grupos g ON h.idGrupo = g.idGrupo
		) ho 
		INNER JOIN grupos g ON ho.idGrupo = g.idGrupo WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare(
		"SELECT idHorario,nivelEscolar,generacion,CONCAT(grado,'-',grupo) AS gradoyGrupo,CONCAT(DATE_FORMAT(ho.horaInicio,'%H:%i'),' - ',DATE_FORMAT(ho.horaFin,'%H:%i')) horas,
		MAX(CASE WHEN ho.dia='Lunes' THEN ho.materia ELSE '' END) Lunes,
		MAX(CASE WHEN ho.dia='Martes' THEN ho.materia ELSE '' END) Martes,
		MAX(CASE WHEN ho.dia='Miercoles' THEN ho.materia ELSE '' END) Miercoles,
		MAX(CASE WHEN ho.dia='Jueves' THEN ho.materia ELSE '' END) Jueves,
		MAX(CASE WHEN ho.dia='Viernes' THEN ho.materia ELSE '' END) Viernes,
		MAX(CASE WHEN ho.dia='Sabado' THEN ho.materia ELSE '' END) Sabado FROM    (
			SELECT idHorario,h.idGrupo,h.idTrabajador,h.horaInicio,h.horaFin,m.materia,h.dia 
			FROM horarios h 
				INNER JOIN materias m ON m.idMateria=h.idMateria
				INNER JOIN grupos g ON h.idGrupo = g.idGrupo
		) ho 
		INNER JOIN grupos g ON ho.idGrupo = g.idGrupo
    WHERE 1 ".$searchQuery." GROUP BY horas ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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

		$stmt = $connection->prepare(
		"SELECT idHorario,nivelEscolar,generacion,CONCAT(grado,'-',grupo) AS gradoyGrupo,CONCAT(DATE_FORMAT(ho.horaInicio,'%H:%i'),' - ',DATE_FORMAT(ho.horaFin,'%H:%i')) horas,
		MAX(CASE WHEN ho.dia='Lunes' THEN ho.materia ELSE '' END) Lunes,
		MAX(CASE WHEN ho.dia='Martes' THEN ho.materia ELSE '' END) Martes,
		MAX(CASE WHEN ho.dia='Miercoles' THEN ho.materia ELSE '' END) Miercoles,
		MAX(CASE WHEN ho.dia='Jueves' THEN ho.materia ELSE '' END) Jueves,
		MAX(CASE WHEN ho.dia='Viernes' THEN ho.materia ELSE '' END) Viernes,
		MAX(CASE WHEN ho.dia='Sabado' THEN ho.materia ELSE '' END) Sabado FROM    (
			SELECT idHorario,h.idGrupo,h.idTrabajador,h.horaInicio,h.horaFin,m.materia,h.dia 
			FROM horarios h 
				INNER JOIN materias m ON m.idMateria=h.idMateria
				INNER JOIN grupos g ON h.idGrupo = g.idGrupo
		) ho 
		INNER JOIN grupos g ON ho.idGrupo = g.idGrupo
    WHERE 1 ".$searchQuery." GROUP BY horas ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idHorario"=>$row['idHorario'],
			"generacion"=>$row['generacion'],
			"nivelEscolar"=>$row['nivelEscolar'],
			"gradoyGrupo"=>$row['gradoyGrupo'],
			"horas"=>$row['horas'],
			"Lunes"=>$row['Lunes'],
			"Martes"=>$row['Martes'],
			"Miercoles"=>$row['Miercoles'],
			"Jueves"=>$row['Jueves'],
			"Viernes"=>$row['Viernes'],
			"Sabado"=>$row['Sabado']
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
