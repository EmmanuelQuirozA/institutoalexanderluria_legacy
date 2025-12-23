<?php
	include '../../../build/config.php';
  session_start();

	/*<!-------------------------QUERY PHP------------------------->*/
  $alumno=trim($_POST['alumno']);

  $query = 'SELECT DISTINCT idPersona,nivelEscolar,CONCAT(grado,"-",grupo) AS gradoyGrupo,saldo FROM alumnos INNER JOIN grupos ON alumnos.idGrupo=grupos.idGrupo WHERE idAlumno = :alumno ';
  $sql = $connection->prepare($query);
  $sql->bindParam("alumno", $alumno, PDO::PARAM_INT);  

  $sql->execute();

  $result = $sql->fetchAll();
  if ($result) {
    foreach ($result as $row) {
      $jsonresult = array(
        'response' => array(
          'idPersona' => $row['idPersona'],
          'nivelEscolar' => $row['nivelEscolar'],
          'gradoyGrupo' => $row['gradoyGrupo'],
          'saldo' => $row['saldo']
        )
      );
    }
  }
  echo json_encode($jsonresult);
?>