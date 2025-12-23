<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  $sqlselect="SELECT * FROM trabajadores WHERE idPersona=".$_SESSION['idPersona'];
  $stmtselect=$connection->prepare($sqlselect);
  $stmtselect->execute();
  $results=$stmtselect->fetchAll();
  foreach ($results as $output){
    $idTrabajadorRemitente = $output['idTrabajador'];
  }
  
  if($accion=="create"){
    $idTrabajadorDestinatario = trim($_POST['idTrabajador']);
    $titulo = ucwords(mb_strtolower(trim($_POST['titulo'])));
    $texto = trim($_POST['texto']);
    $fechaEnviado = date("Y-m-d H:i:s");
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idTrabajador']) && isset($_POST['titulo']) && isset($_POST['texto'])){
  
      try{
        $query = $connection->prepare(
          "INSERT INTO notasadmin(idTrabajadorDestinatario,idTrabajadorRemitente,titulo,texto,fechaEnviado)
          VALUES      (:idTrabajadorDestinatario,:idTrabajadorRemitente,:titulo,:texto,:fechaEnviado)");
        $query->bindParam("idTrabajadorDestinatario", $idTrabajadorDestinatario, PDO::PARAM_INT);
        $query->bindParam("idTrabajadorRemitente", $idTrabajadorRemitente, PDO::PARAM_INT);
        $query->bindParam("titulo", $titulo, PDO::PARAM_STR);
        $query->bindParam("texto", $texto, PDO::PARAM_STR);
        $query->bindParam("fechaEnviado", $fechaEnviado, PDO::PARAM_STR);
        $result = $query->execute();

        if($result){
          $jsonresult = array(
            'response' => array(
              'status' => 'success',
              'code' => '0',
              'message' => 'La nota se ha agregado correctamente.'
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
          'message' => 'Llena todos los campos necesarios'
        )
      );
    }
  }elseif ($accion=="update") {
    $idNotasAdmin = trim($_POST['idNotasAdmin']);
    $titulo = ucwords(mb_strtolower(trim($_POST['titulo'])));
    $texto = trim($_POST['texto']);
    
    try{
      // UPDATE DE PERSONA
      $query = "UPDATE notasadmin 
      SET 
      `titulo` = :titulo,
      `texto` = :texto
      WHERE `idNotasAdmin` = :idNotasAdmin";
      $sql = $connection->prepare($query);
      $sql->bindParam("idNotasAdmin", $idNotasAdmin, PDO::PARAM_INT);
      $sql->bindParam("titulo", $titulo, PDO::PARAM_STR);
      $sql->bindParam("texto", $texto, PDO::PARAM_STR);
      $sql->execute();
      if($sql->rowCount() > 0){
        $jsonresult = array(
          'response' => array(
            'status' => 'success',
            'code' => '0',
            'message' => 'Se han guardado los cambios.'
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
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idNotasAdmin'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idNotasAdmin=trim($_POST['idNotasAdmin']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `notasadmin` WHERE `idNotasAdmin` = :idNotasAdmin");
        $sql->bindParam('idNotasAdmin', $idNotasAdmin,PDO::PARAM_INT);
        
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