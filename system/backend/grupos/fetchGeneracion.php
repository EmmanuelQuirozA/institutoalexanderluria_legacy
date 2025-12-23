<?php
	include '../../../build/config.php';
  session_start();
  ## Fetch records
  $stmt = $connection->prepare('SELECT DISTINCT generacion FROM grupos WHERE estadoGrupo="Activo";');
  $stmt->execute();
  $empRecords = $stmt->fetchAll();

  echo ("<option value=''>Generación</option>");
  
  if ($empRecords) {
    foreach($empRecords as $row){
      echo ("<option value='".$row['generacion']."'>".$row['generacion']."</option>");
    }
  }else{
    echo ("<option>No hay datos</option>");
  }
  exit;
?>