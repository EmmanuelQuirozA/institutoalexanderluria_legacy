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
          clave LIKE :clave AND 
          materia LIKE :materia AND 
          nivelEscolar LIKE :nivelEscolar AND
          grado LIKE :grado  
        ) ";
      $searchArray = array( 
        'clave' =>"%$searchValue%",
        'materia' =>"%$searchValue%",
        'nivelEscolar' =>"%$searchValue%",
        'grado' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM materias");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM materias WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idMateria,
    clave,
    materia,
    nivelEscolar,
    grado
    FROM materias 
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
        "idMateria" =>$row['idMateria'],
        "clave" =>$row['clave'],
        "materia" =>$row['materia'],
        "nivelEscolar" =>$row['nivelEscolar'],
        "grado" =>$row['grado']
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

