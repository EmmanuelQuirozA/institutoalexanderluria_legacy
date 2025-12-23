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
	$searchBynombreCompletoDocente = $_POST["searchBynombreCompletoDocente"];
	$searchBymateria = $_POST["searchBymateria"];
	$searchBytitulo = $_POST["searchBytitulo"];
	$searchBydescripcion = $_POST["searchBydescripcion"];
	$searchByfechaInicio = $_POST["searchByfechaInicio"];
	$searchByfechaEntrega = $_POST["searchByfechaEntrega"];
	$searchBydiasParaEntrega = $_POST["searchBydiasParaEntrega"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"generacion"=>$searchBygeneracion,
		"materias.nivelEscolar"=>$searchBynivelEscolar,
		"CONCAT(grupos.grado,'-',grupos.grupo)"=>$searchBygradoyGrupo,
		"CONCAT(personas.nombre,' ',personas.apellidoPaterno,' ',personas.apellidoMaterno) "=>$searchBynombreCompletoDocente,
		"materia"=>$searchBymateria,
		"titulo"=>$searchBytitulo,
		"descripcion"=>$searchBydescripcion,
		"fechaInicio"=>$searchByfechaInicio,
		"fechaEntrega"=>$searchByfechaEntrega,
		"CASE WHEN fechaEntrega-CURDATE()<=0 THEN 'Entrega vencida' ELSE fechaEntrega-CURDATE() END"=>$searchBydiasParaEntrega
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			CONCAT(personas.nombre,' ',personas.apellidoPaterno,' ',personas.apellidoMaterno) LIKE :nombreCompletoDocente

			) ";
		$searchArray = array( 
			'nombreCompletoDocente'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM tareas
    INNER JOIN grupos ON tareas.idGrupo=grupos.idGrupo
    INNER JOIN trabajadores ON tareas.idTrabajador=trabajadores.idTrabajador
    INNER JOIN personas ON trabajadores.idPersona=personas.idPersona
    INNER JOIN materias ON tareas.idMateria=materias.idMateria");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM tareas
    INNER JOIN grupos ON tareas.idGrupo=grupos.idGrupo
    INNER JOIN trabajadores ON tareas.idTrabajador=trabajadores.idTrabajador
    INNER JOIN personas ON trabajadores.idPersona=personas.idPersona
    INNER JOIN materias ON tareas.idMateria=materias.idMateria WHERE 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT 
    idTarea,
    generacion,
    materias.nivelEscolar,
    CONCAT(grupos.grado,'-',grupos.grupo) AS gradoyGrupo,
    CONCAT(personas.nombre,' ',personas.apellidoPaterno,' ',personas.apellidoMaterno) AS nombreCompletoDocente, 
    materia,
    titulo,
    descripcion,
    fechaInicio,
    fechaEntrega, 
    CASE WHEN fechaEntrega-CURDATE()<=0 THEN 'Entrega vencida' ELSE fechaEntrega-CURDATE() END diasParaEntrega
    FROM tareas
    INNER JOIN grupos ON tareas.idGrupo=grupos.idGrupo
    INNER JOIN trabajadores ON tareas.idTrabajador=trabajadores.idTrabajador
    INNER JOIN personas ON trabajadores.idPersona=personas.idPersona
    INNER JOIN materias ON tareas.idMateria=materias.idMateria WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    idTarea,
    generacion,
    materias.nivelEscolar,
    CONCAT(grupos.grado,'-',grupos.grupo) AS gradoyGrupo,
    CONCAT(personas.nombre,' ',personas.apellidoPaterno,' ',personas.apellidoMaterno) AS nombreCompletoDocente, 
    materia,
    titulo,
    descripcion,
    fechaInicio,
    fechaEntrega, 
    CASE WHEN fechaEntrega-CURDATE()<=0 THEN 'Entrega vencida' ELSE fechaEntrega-CURDATE() END diasParaEntrega
    FROM tareas
    INNER JOIN grupos ON tareas.idGrupo=grupos.idGrupo
    INNER JOIN trabajadores ON tareas.idTrabajador=trabajadores.idTrabajador
    INNER JOIN personas ON trabajadores.idPersona=personas.idPersona
    INNER JOIN materias ON tareas.idMateria=materias.idMateria WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idTarea"=>$row['idTarea'],
			"generacion"=>$row['generacion'],
			"nivelEscolar"=>$row['nivelEscolar'],
			"gradoyGrupo"=>$row['gradoyGrupo'],
			"nombreCompletoDocente"=>$row['nombreCompletoDocente'],
			"materia"=>$row['materia'],
			"titulo"=>$row['titulo'],
			"descripcion"=>$row['descripcion'],
			"fechaInicio"=>$row['fechaInicio'],
			"fechaEntrega"=>$row['fechaEntrega'],
			"diasParaEntrega"=>$row['diasParaEntrega']
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
