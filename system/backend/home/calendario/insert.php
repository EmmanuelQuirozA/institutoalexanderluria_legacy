<?php
  require '../../../../build/config.php';
  session_start();

  if(isset($_POST['titulo'])&&isset($_POST['start'])&&isset($_POST['end'])){
    if ($_POST['start']<=$_POST['end']) {
      $idUsuario = trim($_SESSION["idUsuario"]);
      $titulo = trim($_POST['titulo']);
      $start = trim($_POST['start']);
      $end = trim($_POST['end']);
      $notas = trim($_POST['notas']);
      $tipoEvento = trim($_POST['tipoEvento']);
      try {
        $query = "INSERT INTO calendario(idUsuario,titulo,start,end,notas,tipoEvento) 
        values (:idUsuario,:titulo,:start,:end,:notas,:tipoEvento)";
        $sql = $connection->prepare($query);
        $sql->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
        $sql->bindParam("titulo", $titulo, PDO::PARAM_STR);
        $sql->bindParam("start", $start, PDO::PARAM_STR);
        $sql->bindParam("end", $end, PDO::PARAM_STR);
        $sql->bindParam("notas", $notas, PDO::PARAM_STR);
        $sql->bindParam("tipoEvento", $tipoEvento, PDO::PARAM_STR);
        $sql->execute();

        if($sql->rowCount() > 0){
          $jsonresult = array(
            'response' => array(
              'status' => 'success',
              'code' => '0',
              'message' => 'El registro se ha editado correctamente.'
            )
          );
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
            )
          );
        }
      } catch (PDOException $e) {
        echo 'PDOException : '.  $e->getMessage();
      }
    }else{
      $jsonresult = array(
        'response' => array(
          'status' => 'error',
          'code' => '4',
          'message' => 'La fecha inicial no puede ser mayor a la fecha final'
        )
      );
    }
  }else{
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '4',
        'message' => 'Llena todos los campos necesarios'
      )
    );
  }
  echo json_encode($jsonresult);
?>