<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['horaInicio'])&&isset($_POST['horaFin'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $horaInicio=trim($_POST['horaInicio']);
      $horaFin=trim($_POST['horaFin']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `horarios` WHERE DATE_FORMAT(horaInicio,'%H:%i')=:horaInicio AND DATE_FORMAT(horaFin,'%H:%i')=:horaFin");
        $sql->bindParam('horaInicio', $horaInicio,PDO::PARAM_STR);
        $sql->bindParam('horaFin', $horaFin,PDO::PARAM_STR);
        
        $sql->execute();
        
        if($sql){
          $jsonresult = array(
            'response' => array(
              'status' => 'success',
              'code' => '0',
              'message' => 'El registro se ha eliminado correctamente.'
            )
          );
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => '¡Algo salió mal. ¡Intenta de nuevo!'
            )
          );
        }
      }	catch (PDOException $e) {
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
          'code' => '1',
          'message' => '¡Algo salió mal. ¡Intenta de nuevo!'
        )
      );
    }
  }else{
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '1',
        'message' => '¡Error 555!'
      )
    );
  }


  
  echo json_encode($jsonresult);
?>