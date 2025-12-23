<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    $idGrupo = trim($_POST['idGrupo']);
    $idMateria = trim($_POST['idMateria']);
    $idTrabajador = trim($_POST['idTrabajador']);
    $titulo = ucwords(mb_strtolower(trim($_POST['titulo'])));
    $descripcion = trim($_POST['descripcion']);
    $fechaInicio = trim($_POST['fechaInicio']);
    $fechaEntrega = trim($_POST['fechaEntrega']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idGrupo']) && isset($_POST['idMateria']) && isset($_POST['idTrabajador']) && isset($_POST['titulo']) && isset($_POST['fechaInicio']) && isset($_POST['fechaEntrega']) )
    {
  
      try{
        $query = $connection->prepare("SELECT * FROM tareas WHERE idGrupo=:idGrupo AND titulo=:titulo");
        $query->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
        $query->bindParam("titulo", $titulo, PDO::PARAM_STR);
        $query->execute();
  
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'La tarea ya se encuentra registrada'
            )
          );
        }
  
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO tareas(idGrupo,idMateria,idTrabajador,titulo,descripcion,fechaInicio,fechaEntrega)
            VALUES      (:idGrupo,:idMateria,:idTrabajador,:titulo,:descripcion,:fechaInicio,:fechaEntrega)");
          $query->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
          $query->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
          $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
          $query->bindParam("titulo", $titulo, PDO::PARAM_STR);
          $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
          $query->bindParam("fechaInicio", $fechaInicio, PDO::PARAM_STR);
          $query->bindParam("fechaEntrega", $fechaEntrega, PDO::PARAM_STR);
          $result = $query->execute();
  
          if($result){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'El registro se ha agregado correctamente.'
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
    $idTarea = trim($_POST['idTarea']);
    $titulo = ucwords(mb_strtolower(trim($_POST['titulo'])));
    $descripcion = trim($_POST['descripcion']);
    $fechaInicio = trim($_POST['fechaInicio']);
    $fechaEntrega = trim($_POST['fechaEntrega']);
    
    try{
      // UPDATE DE PERSONA
      $query = "UPDATE tareas 
      SET 
      `titulo` = :titulo,
      `descripcion` = :descripcion,
      `fechaInicio` = :fechaInicio,
      `fechaEntrega` = :fechaEntrega
      WHERE `idTarea` = :idTarea";
      $sql = $connection->prepare($query);
      $sql->bindParam("titulo", $titulo, PDO::PARAM_STR);
      $sql->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
      $sql->bindParam("fechaInicio", $fechaInicio, PDO::PARAM_STR);
      $sql->bindParam("fechaEntrega", $fechaEntrega, PDO::PARAM_STR);
      $sql->bindParam("idTarea", $idTarea, PDO::PARAM_INT);
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
    if(isset($_POST['idTarea'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idTarea=trim($_POST['idTarea']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `tareas` WHERE `idTarea` = :idTarea");
        $sql->bindParam('idTarea', $idTarea,PDO::PARAM_INT);
        
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