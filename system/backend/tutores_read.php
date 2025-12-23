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
        CONCAT(nombre, ' ', apellidoPaterno, ' ',apellidoMaterno) LIKE :nombre 
        ) ";
      $searchArray = array( 
        'nombre' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM tutores INNER JOIN personas ON tutores.idPersona=personas.idPersona");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM tutores INNER JOIN personas ON tutores.idPersona=personas.idPersona WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idTutor,
    tutores.idPersona,
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    CONCAT(nombre, ' ', apellidoPaterno, ' ',apellidoMaterno) AS nombreCompleto,
    lugarNacimiento,
    numeroCel,
    numeroTrabajo,
    numeroCasa,
    correoElectronico,
    religion
    FROM tutores 
    INNER JOIN personas ON tutores.idPersona=personas.idPersona
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

    foreach($empRecords as $row){
      $data[] = array(
        "idTutor" => $row['idTutor'],
        "idPersona" => $row['idPersona'],
        "nombre" => $row['nombre'],
        "apellidoPaterno" => $row['apellidoPaterno'],
        "apellidoMaterno" => $row['apellidoMaterno'],
        "nombreCompleto" => $row['nombreCompleto'],
        "lugarNacimiento" => $row['lugarNacimiento'],
        "numeroCel" => $row['numeroCel'],
        "numeroTrabajo" => $row['numeroTrabajo'],
        "numeroCasa" => $row['numeroCasa'],
        "correoElectronico" => $row['correoElectronico'],
        "religion" => $row['religion']
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

