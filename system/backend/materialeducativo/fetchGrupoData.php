<?php
	include '../../../build/config.php';
  session_start();

	/*<!-------------------------QUERY PHP------------------------->*/
  $idGrupo=trim($_POST['idGrupo']);

  $query = 'SELECT generacion,nivelEscolar,CONCAT(grado,"-",grupo) AS gradoyGrupo,CONCAT(g.idTrabajador," - ",nombre," ",apellidoPaterno," ",apellidoMaterno) AS docente FROM grupos g 
  INNER JOIN trabajadores t ON g.idTrabajador=t.idTrabajador 
  INNER JOIN personas p ON t.idPersona=p.idPersona WHERE idGrupo = :idGrupo ';
  $sql = $connection->prepare($query);
  $sql->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);  

  $sql->execute();

  $result = $sql->fetchAll();
  if ($result) {
    foreach ($result as $row) {
      $jsonresult = array(
        'response' => array(
          'docente' => $row['docente'],
          'nivelEscolar' => $row['nivelEscolar'],
          'gradoyGrupo' => $row['gradoyGrupo'],
          'generacion' => $row['generacion']
        )
      );
    }
  }
  echo json_encode($jsonresult);
?>