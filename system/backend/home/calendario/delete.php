<?php
  require '../../../../build/config.php';
  session_start();

  if(isset($_POST["id"])){
		$id=trim($_POST['id']);

		try{
      $sql = $connection->prepare( 
        "DELETE FROM `calendario` WHERE `idcalendario` = :idcalendario");
      $sql->bindParam('idcalendario', $id,PDO::PARAM_INT);
    
      $sql->execute();
      
      if($sql){
				$jsonresult = array(
					'response' => array(
						'status' => 'success',
						'code' => '0',
						'message' => 'El registro se ha eliminado correctamente'
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
	}
  echo json_encode($jsonresult);
?>
