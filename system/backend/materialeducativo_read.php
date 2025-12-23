<?php
	include '../../build/config.php';
	session_start();

    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowpge = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    $searchArray = array();

    ## Search 
    $searchQuery = " ";
    if($searchValue != ''){
      $searchQuery = " AND (
        generacion LIKE :generacion AND
        nivelEscolar LIKE :nivelEscolar AND
        CONCAT(grado,'-',grupo) LIKE :gradoyGrupo AND
        concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) LIKE :nombreCompleto AND
        titulo LIKE :titulo AND
        descripcion LIKE :descripcion AND
        tipoDocumento LIKE :tipoDocumento AND
        fechaSubido LIKE :fechaSubido
        ) ";
      $searchArray = array( 
        'generacion' =>"%$searchValue%",
        'nivelEscolar' =>"%$searchValue%",
        'gradoyGrupo' =>"%$searchValue%",
        'nombreCompleto' =>"%$searchValue%",
        'titulo' =>"%$searchValue%",
        'descripcion' =>"%$searchValue%",
        'tipoDocumento' =>"%$searchValue%",
        'fechaSubido' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount 
    FROM materialeducativo me
    INNER JOIN grupos g ON me.idGrupo=g.idGrupo
    INNER JOIN trabajadores t ON me.idTrabajador=t.idTrabajador
    INNER JOIN personas p ON t.idPersona=p.idPersona");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount 
    FROM materialeducativo me
    INNER JOIN grupos g ON me.idGrupo=g.idGrupo
    INNER JOIN trabajadores t ON me.idTrabajador=t.idTrabajador
    INNER JOIN personas p ON t.idPersona=p.idPersona WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT
    idMaterialEducativo,
    me.idGrupo,
    me.idTrabajador,
      generacion,
      nivelEscolar,
      CONCAT(grado,'-',grupo) AS gradoyGrupo,
      concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto,
    titulo,
    descripcion,
    tipoDocumento,
    fechaSubido,
    path
    FROM materialeducativo me
    INNER JOIN grupos g ON me.idGrupo=g.idGrupo
    INNER JOIN trabajadores t ON me.idTrabajador=t.idTrabajador
    INNER JOIN personas p ON t.idPersona=p.idPersona WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

    // Bind values
    foreach($searchArray as $key=>$search){
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$rowpge, PDO::PARAM_INT);
    $stmt->execute();
    $empRecords = $stmt->fetchAll();

    $data = array();

    foreach($empRecords as $row){
      $data[] = array(
        "idMaterialEducativo" =>$row['idMaterialEducativo'],
        "idGrupo" =>$row['idGrupo'],
        "idTrabajador" =>$row['idTrabajador'],
        "generacion" =>$row['generacion'],
        "nivelEscolar" =>$row['nivelEscolar'],
        "gradoyGrupo" =>$row['gradoyGrupo'],
        "nombreCompleto" =>$row['nombreCompleto'],
        "titulo" =>$row['titulo'],
        "descripcion" =>$row['descripcion'],
        "tipoDocumento" =>$row['tipoDocumento'],
        "fechaSubido" =>$row['fechaSubido'],
        "path" =>$row['path']
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

