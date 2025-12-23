<?php
	include '../../../build/config.php';

  if (isset($_POST['codigo_query'])) {
    $inpText = $_POST['codigo_query'];
    $sql = 'SELECT DISTINCT idTutor, CONCAT(idTutor, " - ", nombre, " ", apellidoPaterno, " ", apellidoMaterno) AS nombreCompleto FROM personas INNER JOIN tutores ON personas.idPersona=tutores.idPersona WHERE CONCAT(nombre, " ", apellidoPaterno, " ", apellidoMaterno) LIKE :nombre';
    $stmt = $connection->prepare($sql);
    $stmt->execute(['nombre' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" id="'.$row['idTutor'].'" class=" list-group-item list-group-item-action tutorSearch border-1">' . $row['nombreCompleto'] .'</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Sin registros</p>';
    }
  }
?>