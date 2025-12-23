<?php
	include '../../../build/config.php';
  session_start();

	/*<!-------------------------QUERY PHP------------------------->*/
  $trabajador=trim($_POST['trabajador']);

  $query = 'SELECT DISTINCT * FROM trabajadores  WHERE idTrabajador = :trabajador';
  $sql = $connection->prepare($query);
  $sql->bindParam("trabajador", $trabajador, PDO::PARAM_INT);  

  $sql->execute();

  $result = $sql->fetchAll();
  if ($result) {
    foreach ($result as $row) {
      $jsonresult = array(
        'response' => array(
          'idTrabajador' => $row['idTrabajador'],
          'idPersona' => $row['idPersona'],
          'saldo' => $row['saldo']
        )
      );
    }
  }
  echo json_encode($jsonresult);
?>