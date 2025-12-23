<?php
	include '../../../build/config.php';

  if (isset($_POST['codigo_query'])) {
    $inpText = $_POST['codigo_query'];
    $sql = 'SELECT DISTINCT idPersona, CONCAT(idPersona, " - ", nombre, " ", apellidoPaterno, " ", apellidoMaterno) AS nombreCompleto FROM personas WHERE CONCAT(nombre, " ", apellidoPaterno, " ", apellidoMaterno) LIKE :nombre';
    $stmt = $connection->prepare($sql);
    $stmt->execute(['nombre' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" id="'.$row['idPersona'].'" class=" list-group-item list-group-item-action personaSearch border-1">' . $row['nombreCompleto'] .'</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Sin registros</p>';
    }
  }
?>