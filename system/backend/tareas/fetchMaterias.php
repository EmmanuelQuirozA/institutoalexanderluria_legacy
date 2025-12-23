<?php
	include '../../../build/config.php';
  session_start();
  if(isset($_POST['idGrupo'])){

    $idGrupo = $_POST['idGrupo'];
    ## Fetch records
    $stmt = $connection->prepare('SELECT * FROM `materias` INNER JOIN grupos ON SUBSTR(materias.grado, 1, 1)=grupos.grado WHERE idGrupo='.$idGrupo);

    $stmt->execute();
    $empRecords = $stmt->fetchAll();

    if ($empRecords) {
      foreach($empRecords as $row){
        echo ("<option value='".$row['idMateria']."'>".$row['materia']."</option>");
      }
    }else{
      echo ("<option>No hay materias para este grupo</option>");
    }
    exit;
    // $state = $_POST['get_option'];
    // $find=mysql_query("select city from places where state='$state'");
    // while($row=mysql_fetch_array($find))
    // {
    //   echo "<option>".$row['city']."</option>";
    // }
    // exit;

  }else{
    echo ("<option>No hay materias para este grupo</option>");
  }
?>