<?php
	include '../../../build/config.php';

  if (isset($_POST['codigo_query'])) {
    $inpText = $_POST['codigo_query'];
    $sql = 'SELECT DISTINCT idAlumno, CONCAT(idAlumno, " - ", nombre, " ", apellidoPaterno, " ", apellidoMaterno) AS nombreCompleto FROM personas INNER JOIN alumnos ON personas.idPersona=alumnos.idPersona WHERE CONCAT(nombre, " ", apellidoPaterno, " ", apellidoMaterno) LIKE :nombre AND estatusAlumno="Alta"';
    $stmt = $connection->prepare($sql);
    $stmt->execute(['nombre' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" id="'.$row['idAlumno'].'" class=" list-group-item list-group-item-action alumnoSearch border-1">' . $row['nombreCompleto'] .'</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Sin registros</p>';
    }
  }
?>