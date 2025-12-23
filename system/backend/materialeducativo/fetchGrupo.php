<?php
	include '../../../build/config.php';

  if (isset($_POST['codigo_query'])) {
    $inpText = $_POST['codigo_query'];
    $sql = 'SELECT DISTINCT generacion,nivelEscolar,CONCAT(idGrupo," - ",generacion," - ",nivelEscolar," / ",grado,"-",grupo) AS grupo FROM grupos WHERE CONCAT(idGrupo," - ",generacion," - ",nivelEscolar," / ",grado,"-",grupo) LIKE :grupo';
    $stmt = $connection->prepare($sql);
    $stmt->execute(['grupo' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" class=" list-group-item list-group-item-action personaSearch border-1">' . $row['grupo'] .'</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Sin registros</p>';
    }
  }
?>