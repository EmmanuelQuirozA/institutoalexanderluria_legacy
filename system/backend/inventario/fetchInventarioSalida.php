<?php
	include '../../../build/config.php';

  if (isset($_POST['codigo_query'])) {
    $inpText = $_POST['codigo_query'];
    $sql = 'SELECT DISTINCT idInventario, CONCAT(idInventario, " - ", descripcion) AS item FROM inventario WHERE CONCAT(idInventario, " - ", descripcion) LIKE :descripcion';
    $stmt = $connection->prepare($sql);
    $stmt->execute(['descripcion' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" id="'.$row['idInventario'].'" class=" list-group-item list-group-item-action salidaInventarioSearch border-1">' . $row['item'] .'</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">Sin registros</p>';
    }
  }
?>