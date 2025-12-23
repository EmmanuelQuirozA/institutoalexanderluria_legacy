<?php
  include '../../../build/config.php';
  session_start();
	/*<!-------------------------UPDATE PHP------------------------->*/
	if(
	isset($_POST['idPersona'])&&
	isset($_POST['cantidad'])&&
	isset($_POST['saldo'])&&
  $_POST['idPersona']!=""&&
	$_POST['cantidad']!=""&&
	$_POST['saldo']!=""
  ){
    
		/*<!-------------------------FORM INFORMATION SENT------------------------->*/
		$idPersona=trim($_POST['idPersona']);
		$saldo=trim($_POST['saldo'])+trim($_POST['cantidad']); //Saldo del alumno más la cantidad ingresada
    
		/*<!-------------------------UPDATE TABLE------------------------->*/
    try{
      $query = $connection->prepare("SELECT * FROM alumnos WHERE idPersona=:idPersona");
      $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
      $query->execute();
      if ($query->rowCount() > 0) {
        //Se actualiza el saldo del alumno
        $query = "UPDATE alumnos SET `saldo` = :saldo WHERE `idPersona` = :idPersona";
        $sql = $connection->prepare($query);
        $sql->bindParam("saldo", $saldo, PDO::PARAM_STR);
        $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);

        $sql->execute();

        if($sql->rowCount() > 0){
          //Se agrega el registro de la recarga
          $idPersona=trim($_POST['idPersona']);
          $saldoRecargado = $_POST['cantidad'];
          $idUsuario = $_SESSION['idUsuario'];
          $fecha = date("Y-m-d");
          
          $query = "INSERT INTO recargas_saldo(idPersona,idUsuario,tipoPersona,monto,fecha) 
          values (:idPersona,:idUsuario,'Alumno',:monto,:fecha)";
          $sql = $connection->prepare($query);
          $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $sql->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
          $sql->bindParam("monto", $saldoRecargado, PDO::PARAM_STR);
          $sql->bindParam("fecha", $fecha, PDO::PARAM_STR);
          $sql->execute();

          if($sql->rowCount() > 0){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'Saldo se ha agregado correctamente.'
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

        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
            )
          );
        }
      }else{
        $jsonresult = array(
          'response' => array(
            'status' => 'error',
            'code' => '5',
            'message' => 'No se encuentra el alumno.'
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
        'message' => 'Llena todos los campos necesarios'
      )
    );
  }
  echo json_encode($jsonresult);
?>