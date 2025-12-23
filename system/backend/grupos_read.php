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
          CONCAT(grupos.idTrabajador,' - ',nombre,' ',apellidoPaterno,' ',apellidoMaterno) LIKE :nombreCompleto AND 
          generacion LIKE :generacion AND
          nivelEscolar LIKE :nivelEscolar AND
          CONCAT(grupos.grado,'-',grupos.grupo) LIKE :gradoyGrupo AND 
          salon LIKE :salon  
        ) ";
      $searchArray = array( 
        'nombreCompleto' =>"%$searchValue%",
        'generacion' =>"%$searchValue%",
        'nivelEscolar' =>"%$searchValue%",
        'gradoyGrupo' =>"%$searchValue%",
        'salon' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM grupos INNER JOIN trabajadores ON grupos.idTrabajador=trabajadores.idTrabajador INNER JOIN personas ON trabajadores.idPersona=personas.idPersona");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM grupos INNER JOIN trabajadores ON grupos.idTrabajador=trabajadores.idTrabajador INNER JOIN personas ON trabajadores.idPersona=personas.idPersona WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idGrupo,
    grupos.idTrabajador,
    grupos.grado,
    grupos.grupo,
    CONCAT(grupos.idTrabajador,' - ',nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto,
    generacion,
    nivelEscolar,
    CONCAT(grupos.grado,'-',grupos.grupo) AS gradoyGrupo,
    salon,
    estadoGrupo
    FROM grupos 
    INNER JOIN trabajadores ON grupos.idTrabajador=trabajadores.idTrabajador
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
        "idGrupo" =>$row['idGrupo'],
        "idTrabajador" =>$row['idTrabajador'],
        "grado" =>$row['grado'],
        "grupo" =>$row['grupo'],
        "nombreCompleto" =>$row['nombreCompleto'],
        "generacion" =>$row['generacion'],
        "nivelEscolar" =>$row['nivelEscolar'],
        "gradoyGrupo" =>$row['gradoyGrupo'],
        "salon" =>$row['salon'],
        "estadoGrupo" =>$row['estadoGrupo']
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

