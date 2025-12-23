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
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM trabajadores");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM trabajadores WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idTrabajador,
    trabajadores.idPersona,
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    CONCAT(nombre, ' ', apellidoPaterno, ' ',apellidoMaterno) AS nombreCompleto,
    noTrabajador,
    referencia,
    curp,
    rfc,
    noSeguro,
    fechaNacimiento,
    lugarNacimiento,
    puesto,
    sueldo,
    banco,
    noCuenta,
    numeroCel,
    fechaInicioLabores,
    fechaFinLabores,
    estadoCivil,
    hijos,
    calle,
    numero,
    colonia,
    codigoPostal,
    localidad,
    estado,
    egresadoDe,
    universidad,
    fechaEgreso,
    maestria,
    fechaEgresoMaestria,
    aniosExperienciaLaboral,
    saldo
    FROM trabajadores 
    INNER JOIN personas ON trabajadores.idPersona=personas.idPersona
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
        "idTrabajador" => $row['idTrabajador'],
        "idPersona" => $row['idPersona'],
        "nombre" => $row['nombre'],
        "apellidoPaterno" => $row['apellidoPaterno'],
        "apellidoMaterno" => $row['apellidoMaterno'],
        "nombreCompleto" => $row['nombreCompleto'],
        "noTrabajador" => $row['noTrabajador'],
        "referencia" => $row['referencia'],
        "curp" => $row['curp'],
        "rfc" => $row['rfc'],
        "noSeguro" => $row['noSeguro'],
        "fechaNacimiento" => $row['fechaNacimiento'],
        "lugarNacimiento" => $row['lugarNacimiento'],
        "puesto" => $row['puesto'],
        "sueldo" => $row['sueldo'],
        "banco" => $row['banco'],
        "noCuenta" => $row['noCuenta'],
        "numeroCel" => $row['numeroCel'],
        "fechaInicioLabores" => $row['fechaInicioLabores'],
        "fechaFinLabores" => $row['fechaFinLabores'],
        "estadoCivil" => $row['estadoCivil'],
        "hijos" => $row['hijos'],
        "calle" => $row['calle'],
        "numero" => $row['numero'],
        "colonia" => $row['colonia'],
        "codigoPostal" => $row['codigoPostal'],
        "localidad" => $row['localidad'],
        "estado" => $row['estado'],
        "egresadoDe" => $row['egresadoDe'],
        "universidad" => $row['universidad'],
        "fechaEgreso" => $row['fechaEgreso'],
        "maestria" => $row['maestria'],
        "fechaEgresoMaestria" => $row['fechaEgresoMaestria'],
        "aniosExperienciaLaboral" => $row['aniosExperienciaLaboral'],
        "saldo" => $row['saldo']
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

