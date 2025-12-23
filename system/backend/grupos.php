<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if ($accion=="create") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(
      isset($_POST['idTrabajador'])&&
      isset($_POST['generacion'])&&
      isset($_POST['nivelEscolar'])&&
      isset($_POST['grado'])&&
      isset($_POST['grupo'])){
      $idTrabajador = trim($_POST['idTrabajador']);
      $generacion = trim($_POST['generacion']);
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $grado = trim($_POST['grado']);
      $grupo = trim($_POST['grupo']);
      $salon = ucwords(mb_strtolower(trim($_POST['salon'])));
      
      try{
        $query = $connection->prepare("SELECT * FROM trabajadores WHERE idTrabajador=:idTrabajador");
        $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
          $query = $connection->prepare("SELECT * FROM grupos WHERE generacion=:generacion AND nivelEscolar=:nivelEscolar AND grado=:grado AND grupo=:grupo");
          $query->bindParam("generacion", $generacion, PDO::PARAM_STR);
          $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
          $query->bindParam("grado", $grado, PDO::PARAM_STR);
          $query->bindParam("grupo", $grupo, PDO::PARAM_STR);
          $query->execute();
        
          if ($query->rowCount() > 0) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'Ya existe un registro con estos datos.'
              )
            );
          }
        
          if ($query->rowCount() == 0) {
            $query = $connection->prepare(
              "INSERT INTO grupos(idTrabajador,generacion,nivelEscolar,grado,grupo,salon) 
                          VALUES (:idTrabajador,:generacion,:nivelEscolar,:grado,:grupo,:salon)");
            $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
            $query->bindParam("generacion", $generacion, PDO::PARAM_STR);
            $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
            $query->bindParam("grado", $grado, PDO::PARAM_INT);
            $query->bindParam("grupo", $grupo, PDO::PARAM_STR);
            $query->bindParam("salon", $salon, PDO::PARAM_STR);
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
                  'message' => 'Algo salió mal. ¡Intenta de nuevo!'
                )
              );
            }
          }
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'No se encuentra el docente.'
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
          'code' => '4',
          'message' => 'Llena todos los campos necesarios.'
        )
      );
    }
  }elseif ($accion=="update") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(
      isset($_POST['idGrupo'])&&
      isset($_POST['grado'])&&
      isset($_POST['grupo'])&&
      isset($_POST['idTrabajador'])&&
      isset($_POST['generacion'])&&
      isset($_POST['nivelEscolar'])&&
      isset($_POST['salon'])){

      $idGrupo = trim($_POST['idGrupo']);
      $grado = trim($_POST['grado']);
      $grupo = trim($_POST['grupo']);
      $idTrabajador = trim($_POST['idTrabajador']);
      $generacion = trim($_POST['generacion']);
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $salon = trim($_POST['salon']);

        try{
          $query = "UPDATE grupos 
            SET 
            `grado` = :grado,
            `grupo` = :grupo,
            `idTrabajador` = :idTrabajador,
            `generacion` = :generacion,
            `nivelEscolar` = :nivelEscolar,
            `salon` = :salon
            WHERE `idGrupo`   = :idGrupo";
            $sql = $connection->prepare($query);
            $sql->bindParam("grado", $grado, PDO::PARAM_INT);
            $sql->bindParam("grupo", $grupo, PDO::PARAM_STR);
            $sql->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
            $sql->bindParam("generacion", $generacion, PDO::PARAM_STR);
            $sql->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
            $sql->bindParam("salon", $salon, PDO::PARAM_STR);
            $sql->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);

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
    }else{
      $jsonresult = array(
        'response' => array(
          'status' => 'error',
          'code' => '4',
          'message' => 'Llena todos los campos necesarios'
        )
      );
    }
  }elseif ($accion=="relacionarMateria_Grupo") {
    // idGrupo,idMateria,horaInicial,horaFinal
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idGrupo'])&&isset($_POST['idMateria'])&&isset($_POST['horaInicio'])&&isset($_POST['horaFin'])&&isset($_POST['dia'])){
      $idGrupo = trim($_POST['idGrupo']);
      $idTrabajador = trim($_POST['idTrabajador']);
      $idMateria = trim($_POST['idMateria']);
      $horaInicio = trim($_POST['horaInicio']);
      $horaFin = trim($_POST['horaFin']);
      $dia = trim($_POST['dia']);

      try{
        if ($horaInicio < $horaFin) {

          $query = $connection->prepare(
            "INSERT INTO horarios(horaInicio,horaFin,idMateria,idTrabajador,idGrupo,dia) 
                        VALUES (:horaInicio,:horaFin,:idMateria,:idTrabajador,:idGrupo,:dia)");
          $query->bindParam("horaInicio", $horaInicio, PDO::PARAM_STR);
          $query->bindParam("horaFin", $horaFin, PDO::PARAM_STR);
          $query->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
          $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
          $query->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
          $query->bindParam("dia", $dia, PDO::PARAM_STR);
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
                'message' => 'Algo salió mal. ¡Intenta de nuevo!'
              )
            );
          }
          
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'La hora de inicio debe ser anterior a la hora de fin.'
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
          'code' => '4',
          'message' => 'Llena todos los campos necesarios.'
        )
      );
    }
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idGrupo'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idGrupo=trim($_POST['idGrupo']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `grupos` WHERE `idGrupo` = :idGrupo");
        $sql->bindParam('idGrupo', $idGrupo,PDO::PARAM_INT);
        
        $sql->execute();
        
        if($sql){
          $sql = $connection->prepare("DELETE FROM `horarios` WHERE `idGrupo` = :idGrupo");
          $sql->bindParam('idGrupo', $idGrupo,PDO::PARAM_INT);
          
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
  }elseif ($accion=="cambiarEstatus") {
    if(isset($_POST['idGrupo'])){

      $idGrupo = trim($_POST['idGrupo']);
      $estadoGrupo = trim($_POST['nuevoestatusGrupo']);

        try{
          $query = "UPDATE grupos 
            SET 
            `estadoGrupo` = :estadoGrupo
            WHERE `idGrupo`   = :idGrupo";
            $sql = $connection->prepare($query);
            $sql->bindParam("estadoGrupo", $estadoGrupo, PDO::PARAM_STR);
            $sql->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);

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
    }else{
      $jsonresult = array(
        'response' => array(
          'status' => 'error',
          'code' => '4',
          'message' => 'Llena todos los campos necesarios'
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