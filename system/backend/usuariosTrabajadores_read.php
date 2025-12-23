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
      username            LIKE :username          OR 
      CONCAT(nombre, ' ', apellidoPaterno, ' ',apellidoMaterno) LIKE :nombre OR 
      nombreRol           LIKE :nombreRol         OR 
      correoElectronico   LIKE :correoElectronico
      ) ";
    $searchArray = array( 
      'username'          =>"%$searchValue%", 
      'nombre'            =>"%$searchValue%",
      'nombreRol'         =>"%$searchValue%",
      'correoElectronico' =>"%$searchValue%"
    );
  }

  ## Total number of records without filtering
  $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM usuarios INNER JOIN roles ON usuarios.idRol=roles.idRol INNER JOIN personas ON usuarios.idPersona=personas.idPersona INNER JOIN trabajadores ON usuarios.idPersona=trabajadores.idPersona");
  $stmt->execute();             
  $records = $stmt->fetch();
  $totalRecords = $records['allcount'];

  ## Total number of records with filtering
  $stmt = $connection->prepare("SELECT COUNT(*) AS allcount FROM usuarios INNER JOIN roles ON usuarios.idRol=roles.idRol INNER JOIN personas ON usuarios.idPersona=personas.idPersona INNER JOIN trabajadores ON usuarios.idPersona=trabajadores.idPersona WHERE 1 ".$searchQuery);
  $stmt->execute($searchArray);
  $records = $stmt->fetch();
  $totalRecordwithFilter = $records['allcount'];

  ## Fetch records
  $stmt = $connection->prepare("SELECT 
  idUsuario,
  usuarios.idRol,
  usuarios.idPersona,
  username,
  correoElectronico,
  nombreRol,
  CONCAT(nombre, ' ', apellidoPaterno, ' ',apellidoMaterno) AS nombreCompleto
  FROM usuarios 
  INNER JOIN roles ON usuarios.idRol=roles.idRol
  INNER JOIN personas ON usuarios.idPersona=personas.idPersona
  INNER JOIN trabajadores ON usuarios.idPersona=trabajadores.idPersona
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
      "idUsuario"         =>$row['idUsuario'],
      "idRol"             =>$row['idRol'],
      "idPersona"         =>$row['idPersona'],
      "username"          =>$row['username'],
      "nombreCompleto"    =>$row['nombreCompleto'],
      "nombreRol"         =>$row['nombreRol'],
      "correoElectronico" =>$row['correoElectronico']
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

