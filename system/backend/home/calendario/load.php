<?php
  require '../../../../build/config.php';
  session_start();


  $data = array();

  $query = "SELECT 
  idCalendario,
  calendario.idUsuario AS usuario,
  username,
  nombre,
  apellidoPaterno,
  apellidoMaterno,
  titulo,
  start,
  end,
  notas,
  tipoEvento
  FROM calendario  
  INNER JOIN usuarios ON calendario.idUsuario=usuarios.idUsuario
  INNER JOIN personas ON usuarios.idPersona=personas.idPersona
  ORDER BY idCalendario;";

  $statement = $connection->prepare($query);

  $statement->execute();

  $result = $statement->fetchAll();

  foreach($result as $row)
  {
  $data[] = array(
    'id'   => $row["idCalendario"],
    'titulo'   => $row["titulo"],
    'title'   => $row["titulo"],
    'notas'   => $row["notas"],
    'start'   => $row["start"],
    'end'   => $row["end"],
    'tipoEvento'   => $row["tipoEvento"]
  );
  }

  echo json_encode($data);

?>
