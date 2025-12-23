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
          CONCAT(ptr.nombre,' ',ptr.apellidoPaterno,' ',ptr.apellidoMaterno) LIKE :nombreCompletoDocente AND 
          CONCAT(pal.nombre,' ',pal.apellidoPaterno,' ',pal.apellidoMaterno) LIKE :nombreCompletoAlumno AND 
          titulo LIKE :titulo AND
          texto LIKE :texto AND
          fechaEnviado LIKE :fechaEnviado AND
          fechaVisto LIKE :fechaVisto  
        ) ";
      $searchArray = array( 
        'nombreCompletoDocente' =>"%$searchValue%",
        'nombreCompletoAlumno' =>"%$searchValue%",
        'titulo' =>"%$searchValue%",
        'texto' =>"%$searchValue%",
        'fechaEnviado' =>"%$searchValue%",
        'fechaVisto' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM notasalumnos na
    INNER JOIN alumnos al ON na.idAlumno=al.idAlumno
    INNER JOIN personas pal on al.idPersona=pal.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajador=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona");
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM notasalumnos na
    INNER JOIN alumnos al ON na.idAlumno=al.idAlumno
    INNER JOIN personas pal on al.idPersona=pal.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajador=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona WHERE 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idNotaAlumno,
    CONCAT(ptr.nombre,' ',ptr.apellidoPaterno,' ',ptr.apellidoMaterno) AS nombreCompletoDocente,
    CONCAT(pal.nombre,' ',pal.apellidoPaterno,' ',pal.apellidoMaterno) AS nombreCompletoAlumno,
    titulo,
    texto,
    fechaEnviado,
    fechaVisto
    FROM notasalumnos na
    INNER JOIN alumnos al ON na.idAlumno=al.idAlumno
    INNER JOIN personas pal on al.idPersona=pal.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajador=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona 
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
        "idNotaAlumno" =>$row['idNotaAlumno'],
        "nombreCompletoDocente" =>$row['nombreCompletoDocente'],
        "nombreCompletoAlumno" =>$row['nombreCompletoAlumno'],
        "titulo" =>$row['titulo'],
        "texto" =>$row['texto'],
        "fechaEnviado" =>$row['fechaEnviado'],
        "fechaVisto" =>$row['fechaVisto']
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

