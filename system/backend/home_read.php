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
	$searchBynombreCompleto = $_POST["searchBynombreCompleto"];
	$searchByusername = $_POST["searchByusername"];
	$searchBynivelEscolar = $_POST["searchBynivelEscolar"];
	$searchBygradoyGrupo = $_POST["searchBygradoyGrupo"];
	$searchByreferencia = $_POST["searchByreferencia"];
	$searchByconcepto = $_POST["searchByconcepto"];
	$searchBymonto = $_POST["searchBymonto"];
	$searchByfechaRegistro = $_POST["searchByfechaRegistro"];
	$searchByfechaPago = $_POST["searchByfechaPago"];
	$searchByformaPago = $_POST["searchByformaPago"];
	$searchBycicloEscolar = $_POST["searchBycicloEscolar"];
	$searchBymesColegiatura = $_POST["searchBymesColegiatura"];
	$searchByobservaciones = $_POST["searchByobservaciones"];
	$searchByfolio = $_POST["searchByfolio"];
	
	$searchArray = array();

	## Search 
	$searchQuery = " ";

	$columns = array(
		"CONCAT(apellidoPaterno,' ',apellidoMaterno,' ',nombre)"=>$searchBynombreCompleto,
		"username"=>$searchByusername,
		"pagos.nivelEscolar"=>$searchBynivelEscolar,
		"pagos.gradoyGrupo"=>$searchBygradoyGrupo,
		"pagos.referencia"=>$searchByreferencia,
		"concepto"=>$searchByconcepto,
		"monto"=>$searchBymonto,
		"fechaRegistro"=>$searchByfechaRegistro,
		"fechaPago"=>$searchByfechaPago,
		"formaPago"=>$searchByformaPago,
		"cicloEscolar"=>$searchBycicloEscolar,
		"mesColegiatura"=>$searchBymesColegiatura,
		"observaciones"=>$searchByobservaciones,
		"folio"=>$searchByfolio
	);
	foreach ($columns as $column => $searchBy) {
		if($searchBy != ''){
			$searchQuery .= " and ($column like '%".$searchBy."%' ) ";
		}
	}
	
	if($searchValue != ''){
		$searchQuery = " AND (
			CONCAT(apellidoPaterno,' ',apellidoMaterno,' ',nombre) LIKE :nombreCompleto
			) ";
		$searchArray = array( 
			'nombreCompleto'  =>"%$searchValue%"
		);
	}

	## Total number of records without filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM pagos INNER JOIN alumnos ON pagos.idAlumno=alumnos.idAlumno INNER JOIN personas ON alumnos.idPersona=personas.idPersona INNER JOIN usuarios ON pagos.idUsuario=usuarios.idUsuario");
	$stmt->execute();             
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];

	## Total number of records with filtering
	$stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM pagos INNER JOIN alumnos ON pagos.idAlumno=alumnos.idAlumno INNER JOIN personas ON alumnos.idPersona=personas.idPersona INNER JOIN usuarios ON pagos.idUsuario=usuarios.idUsuario WHERE estatusPago IN ('Sin aprobar','En validación')  AND 1 ".$searchQuery);
	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];

	## Fetch records
	if($rowperpage!=-1){

		$stmt = $connection->prepare("SELECT 
    idPago,
    idColegiatura,
    pagos.idAlumno,
    pagos.idUsuario,
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    CONCAT(apellidoPaterno,' ',apellidoMaterno,' ',nombre) AS nombreCompleto,
    username,
    pagos.nivelEscolar,
    pagos.gradoyGrupo,
    pagos.referencia,
    concepto,
    monto,
    fechaRegistro,
    fechaPago,
    formaPago,
    estatusPago,
    comprobante,
    cicloEscolar,
    mesColegiatura,
    observaciones,
    folio
		FROM pagos INNER JOIN alumnos ON pagos.idAlumno=alumnos.idAlumno INNER JOIN personas ON alumnos.idPersona=personas.idPersona INNER JOIN usuarios ON pagos.idUsuario=usuarios.idUsuario WHERE estatusPago IN ('Sin aprobar','En validación')  AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    idPago,
    idColegiatura,
    pagos.idAlumno,
    pagos.idUsuario,
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    CONCAT(apellidoPaterno,' ',apellidoMaterno,' ',nombre) AS nombreCompleto,
    username,
    pagos.nivelEscolar,
    pagos.gradoyGrupo,
    pagos.referencia,
    concepto,
    monto,
    fechaRegistro,
    fechaPago,
    formaPago,
    estatusPago,
    comprobante,
    cicloEscolar,
    mesColegiatura,
    observaciones,
    folio
		FROM pagos INNER JOIN alumnos ON pagos.idAlumno=alumnos.idAlumno INNER JOIN personas ON alumnos.idPersona=personas.idPersona INNER JOIN usuarios ON pagos.idUsuario=usuarios.idUsuario WHERE estatusPago IN ('Sin aprobar','En validación')  AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder);

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
			"idPago"=>$row['idPago'],
			"idColegiatura"=>$row['idColegiatura'],
			"idAlumno"=>$row['idAlumno'],
			"idUsuario"=>$row['idUsuario'],
			"nombre"=>$row['nombre'],
			"apellidoPaterno"=>$row['apellidoPaterno'],
			"apellidoMaterno"=>$row['apellidoMaterno'],
			"nombreCompleto"=>$row['nombreCompleto'],
			"username"=>$row['username'],
			"nivelEscolar"=>$row['nivelEscolar'],
			"gradoyGrupo"=>$row['gradoyGrupo'],
			"referencia"=>$row['referencia'],
			"concepto"=>$row['concepto'],
			"monto"=>$row['monto'],
			"fechaRegistro"=>$row['fechaRegistro'],
			"fechaPago"=>$row['fechaPago'],
			"formaPago"=>$row['formaPago'],
			"estatusPago"=>$row['estatusPago'],
			"comprobante"=>$row['comprobante'],
			"cicloEscolar"=>$row['cicloEscolar'],
			"mesColegiatura"=>$row['mesColegiatura'],
			"observaciones"=>$row['observaciones'],
			"folio"=>$row['folio']
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
