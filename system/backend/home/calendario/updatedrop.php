<?php
  require '../../../../build/config.php';
  session_start();


  if(isset($_POST["id"])){
		$start=trim($_POST['start']);
		$end=trim($_POST['end']);
		$id=trim($_POST['id']);
    try{

      $query = "UPDATE calendario 
        SET 
        start=:start, 
        end=:end 
      WHERE idCalendario=:idCalendario";
      $sql = $connection->prepare($query);
      $sql->bindParam("start", $start, PDO::PARAM_STR);
      $sql->bindParam("end", $end, PDO::PARAM_STR);
      $sql->bindParam("idCalendario", $id, PDO::PARAM_INT);
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
      $jsonresult = array(
        'response' => array(
          'status' => 'error',
          'code' => '3',
          'message' => $e->getMessage()
        )
      );
    }
  }else{
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '4',
        'message' => 'Ocurrió un error inesperado. Code: 4'
      )
    );
  }
  echo json_encode($jsonresult);
?>