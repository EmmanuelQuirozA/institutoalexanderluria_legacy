<?php
	include '../../../build/config.php';
  session_start();
  ## Fetch records
  $stmt = $connection->prepare('SELECT DISTINCT CONCAT(grado,"-",grupo) AS gradoyGrupo FROM grupos WHERE estadoGrupo="Activo";');
  $stmt->execute();
  $empRecords = $stmt->fetchAll();

  echo ("<option value=''>Grado y grupo</option>");
     
  if ($empRecords) {
    foreach($empRecords as $row){
      echo ("<option value='".$row['gradoyGrupo']."'>".$row['gradoyGrupo']."</option>");
    }
  }else{
    echo ("<option>No hay grupos para este grupo</option>");
  }
  exit;
?>