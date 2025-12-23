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
          CONCAT(pad.nombre,' ',pad.apellidoPaterno,' ',pad.apellidoMaterno) LIKE :nombreCompletoAdmin AND 
          CONCAT(ptr.nombre,' ',ptr.apellidoPaterno,' ',ptr.apellidoMaterno) LIKE :nombreCompletoDocente AND 
          titulo LIKE :titulo AND
          texto LIKE :texto AND
          fechaEnviado LIKE :fechaEnviado AND
          fechaVisto LIKE :fechaVisto  
        ) ";
      $searchArray = array( 
        'nombreCompletoAdmin' =>"%$searchValue%",
        'nombreCompletoDocente' =>"%$searchValue%",
        'titulo' =>"%$searchValue%",
        'texto' =>"%$searchValue%",
        'fechaEnviado' =>"%$searchValue%",
        'fechaVisto' =>"%$searchValue%"
      );
    }

    ## Total number of records without filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount 
    FROM notasadmin na
    INNER JOIN trabajadores ad ON na.idTrabajadorRemitente=ad.idTrabajador
    INNER JOIN personas pad on ad.idPersona=pad.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajadorDestinatario=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona WHERE pad.idPersona=".$_SESSION['idPersona']);
    $stmt->execute();             
    $records = $stmt->fetch();
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $stmt = $connection->prepare("SELECT COUNT(*) AS allcount 
    FROM notasadmin na
    INNER JOIN trabajadores ad ON na.idTrabajadorRemitente=ad.idTrabajador
    INNER JOIN personas pad on ad.idPersona=pad.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajadorDestinatario=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona WHERE pad.idPersona=".$_SESSION['idPersona']." AND 1 ".$searchQuery);
    $stmt->execute($searchArray);
    $records = $stmt->fetch();
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $stmt = $connection->prepare("SELECT 
    idNotasAdmin,
    CONCAT(pad.nombre,' ',pad.apellidoPaterno,' ',pad.apellidoMaterno) AS nombreCompletoAdmin,
    CONCAT(ptr.nombre,' ',ptr.apellidoPaterno,' ',ptr.apellidoMaterno) AS nombreCompletoDocente,
    titulo,
    texto,
    fechaEnviado,
    fechaVisto
    FROM notasadmin na
    INNER JOIN trabajadores ad ON na.idTrabajadorRemitente=ad.idTrabajador
    INNER JOIN personas pad on ad.idPersona=pad.idPersona
    INNER JOIN trabajadores tr ON na.idTrabajadorDestinatario=tr.idTrabajador
    INNER JOIN personas ptr ON tr.idPersona=ptr.idPersona 
    WHERE pad.idPersona=".$_SESSION['idPersona']." AND 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
        "idNotasAdmin" =>$row['idNotasAdmin'],
        "nombreCompletoAdmin" =>$row['nombreCompletoAdmin'],
        "nombreCompletoDocente" =>$row['nombreCompletoDocente'],
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

