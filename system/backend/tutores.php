<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    if (isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno'])) {

      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $numeroCel = ucwords(mb_strtolower(trim($_POST['numeroCel'])));
      $numeroTrabajo = ucwords(mb_strtolower(trim($_POST['numeroTrabajo'])));
      $numeroCasa = ucwords(mb_strtolower(trim($_POST['numeroCasa'])));
      $correoElectronico = ucwords(mb_strtolower(trim($_POST['correoElectronico'])));
      $religion = ucwords(mb_strtolower(trim($_POST['religion'])));
      
      try{
        $query = $connection->prepare("SELECT * FROM personas WHERE nombre=:nombre and apellidoPaterno=:apellidoPaterno and apellidoMaterno=:apellidoMaterno");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
        $query->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos nombres y apellidos'
            )
          );
        }else{
          $query = $connection->prepare(
            "INSERT INTO personas(nombre,apellidoPaterno,apellidoMaterno) 
                        VALUES (:nombre,:apellidoPaterno,:apellidoMaterno)");
          $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
          $query->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
          $query->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
          $result = $query->execute();
      
          if($result){
            $idPersona = $connection->lastInsertId();

            $query = $connection->prepare(
              "INSERT INTO tutores(idPersona,lugarNacimiento,numeroCel,numeroTrabajo,numeroCasa,correoElectronico,religion) 
                          VALUES (:idPersona,:lugarNacimiento,:numeroCel,:numeroTrabajo,:numeroCasa,:correoElectronico,:religion)");
            $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
            $query->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
            $query->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
            $query->bindParam("numeroTrabajo", $numeroTrabajo, PDO::PARAM_STR);
            $query->bindParam("numeroCasa", $numeroCasa, PDO::PARAM_STR);
            $query->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
            $query->bindParam("religion", $religion, PDO::PARAM_STR);
            
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
                'code' => '1',
                'message' => 'Algo salió mal. ¡Intenta de nuevo!'
              )
            );
          }
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
          'message' => 'Llene correctamente los campos'
        )
      );
    }
  }elseif($accion=="createRelacion"){
    if (isset($_POST['idTutor']) && isset($_POST['idAlumno']) && isset($_POST['tipoRelacion'])) {

      $idTutor = trim($_POST['idTutor']);
      $idAlumno = trim($_POST['idAlumno']);
      $tipoRelacion = trim($_POST['tipoRelacion']);

      $tutorExiste=false;
      $alumnoExiste=false;
      try{

        $query = $connection->prepare("SELECT * FROM tutores WHERE idTutor=:idTutor ");
        $query->bindParam("idTutor", $idTutor, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {//
          $tutorExiste=true;
        }
        $query = $connection->prepare("SELECT * FROM alumnos WHERE idAlumno=:idAlumno ");
        $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {//
          $alumnoExiste=true;
        }
        
        if($tutorExiste&&$alumnoExiste){
          $query = $connection->prepare("SELECT * FROM r_tutor_alumno WHERE idTutor=:idTutor and idAlumno=:idAlumno");
          $query->bindParam("idTutor", $idTutor, PDO::PARAM_INT);
          $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $query->execute();
        
          if ($query->rowCount() > 0) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'Ya existe un registro con estos datos.'
              )
            );
          }else{
            $query = $connection->prepare(
              "INSERT INTO r_tutor_alumno(idTutor,idAlumno,tipoRelacion) 
                          VALUES (:idTutor,:idAlumno,:tipoRelacion)");
            $query->bindParam("idTutor", $idTutor, PDO::PARAM_INT);
            $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
            $query->bindParam("tipoRelacion", $tipoRelacion, PDO::PARAM_STR);
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
              'code' => '1',
              'message' => 'No se encontró el tutor o el alumno. ¡Intenta de nuevo!'
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
          'message' => 'Llene correctamente los campos'
        )
      );
    }
  }elseif ($accion=="update") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idPersona'])&&isset($_POST['nombre'])&&isset($_POST['apellidoPaterno'])&&isset($_POST['apellidoMaterno'])){
      $flagPersona=false;
      $flagTutor=false;

      $idTutor=$_POST['idTutor'];
      $idPersona=$_POST['idPersona'];

      $nombreTutor = ucwords(mb_strtolower(trim($_POST['nombreTutor'])));
      $apellidoPaternoTutor = ucwords(mb_strtolower(trim($_POST['apellidoPaternoTutor'])));
      $apellidoMaternoTutor = ucwords(mb_strtolower(trim($_POST['apellidoMaternoTutor'])));

      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $numeroCel = ucwords(mb_strtolower(trim($_POST['numeroCel'])));
      $numeroTrabajo = ucwords(mb_strtolower(trim($_POST['numeroTrabajo'])));
      $numeroCasa = ucwords(mb_strtolower(trim($_POST['numeroCasa'])));
      $correoElectronico = ucwords(mb_strtolower(trim($_POST['correoElectronico'])));
      $religion = ucwords(mb_strtolower(trim($_POST['religion'])));
      
      try{
        if ($nombreTutor!=$nombre || $apellidoPaternoTutor!=$apellidoPaterno || $apellidoMaternoTutor!=$apellidoMaterno ) {
          $query = $connection->prepare("SELECT * FROM personas WHERE nombre=:nombre and apellidoPaterno=:apellidoPaterno and apellidoMaterno=:apellidoMaterno");
          $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
          $query->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
          $query->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
          $query->execute();
        
          if ($query->rowCount() > 0) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'Ya existe un registro con estos nombres y apellidos'
              )
            );
          }else{
            // UPDATE DE PERSONA
            $query = "UPDATE personas 
            SET 
            `nombre` = :nombre,
            `apellidoPaterno` = :apellidoPaterno,
            `apellidoMaterno` = :apellidoMaterno
            WHERE `idPersona` = :idPersona";
            $sql = $connection->prepare($query);
            $sql->bindParam("nombre", $nombre, PDO::PARAM_STR);
            $sql->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
            $sql->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
            $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
            $sql->execute();
            if($sql->rowCount() > 0){
              // UPDATE DE TUTOR
              $query = "UPDATE tutores 
                SET 
                `lugarNacimiento` = :lugarNacimiento,
                `numeroCel` = :numeroCel,
                `numeroTrabajo` = :numeroTrabajo,
                `numeroCasa` = :numeroCasa,
                `correoElectronico` = :correoElectronico,
                `religion` = :religion
                WHERE `idTutor` = :idTutor AND `idPersona` = :idPersona ";
                $sql = $connection->prepare($query);
                $sql->bindParam("idTutor", $idTutor, PDO::PARAM_INT);
                $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
                $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
                $sql->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
                $sql->bindParam("numeroTrabajo", $numeroTrabajo, PDO::PARAM_STR);
                $sql->bindParam("numeroCasa", $numeroCasa, PDO::PARAM_STR);
                $sql->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
                $sql->bindParam("religion", $religion, PDO::PARAM_STR);

              $sql->execute();
          
              // UPDATE DE TUTOR :: RESULTADO
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
          }
        }else{
          // UPDATE DE ALUMNO
          $query = "UPDATE tutores 
          SET 
            `lugarNacimiento` = :lugarNacimiento,
            `numeroCel` = :numeroCel,
            `numeroTrabajo` = :numeroTrabajo,
            `numeroCasa` = :numeroCasa,
            `correoElectronico` = :correoElectronico,
            `religion` = :religion
          WHERE `idTutor` = :idTutor AND `idPersona` = :idPersona ";
          $sql = $connection->prepare($query);
          $sql->bindParam("idTutor", $idTutor, PDO::PARAM_INT);
          $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
          $sql->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
          $sql->bindParam("numeroTrabajo", $numeroTrabajo, PDO::PARAM_STR);
          $sql->bindParam("numeroCasa", $numeroCasa, PDO::PARAM_STR);
          $sql->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
          $sql->bindParam("religion", $religion, PDO::PARAM_STR);

          $sql->execute();
      
          // UPDATE DE ALUMNO :: RESULTADO
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
  }elseif ($accion=="updateRelacion") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idR_tutor_alumno'])&&isset($_POST['tipoRelacion'])){
      $idR_tutor_alumno = trim($_POST['idR_tutor_alumno']);
      $tipoRelacion = trim($_POST['tipoRelacion']);
      
      try{
        // UPDATE DE ALUMNO
        $query = "UPDATE r_tutor_alumno 
        SET 
          `tipoRelacion` = :tipoRelacion
        WHERE `idR_tutor_alumno` = :idR_tutor_alumno";
        $sql = $connection->prepare($query);
        $sql->bindParam("idR_tutor_alumno", $idR_tutor_alumno, PDO::PARAM_INT);
        $sql->bindParam("tipoRelacion", $tipoRelacion, PDO::PARAM_STR);

        $sql->execute();
    
        // UPDATE DE ALUMNO :: RESULTADO
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
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idPersona'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idPersona=trim($_POST['idPersona']);
      try{
        if ($_SESSION['idPersona'] != $idPersona){
          /*<!-------------------------deleteuser TABLE------------------------->*/
          $sql = $connection->prepare("DELETE FROM `personas` WHERE `idPersona` = :idPersona");
          $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
          
          $sql->execute();
          
          if($sql){
            $sql = $connection->prepare("DELETE FROM `tutores` WHERE `idPersona` = :idPersona");
            $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
            
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
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '2',
              'message' => '¡No puedes eliminar tu propio registro!'
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
  }elseif ($accion=="deleteRelacion") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idR_tutor_alumno'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idR_tutor_alumno=trim($_POST['idR_tutor_alumno']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `r_tutor_alumno` WHERE `idR_tutor_alumno` = :idR_tutor_alumno");
        $sql->bindParam('idR_tutor_alumno', $idR_tutor_alumno,PDO::PARAM_INT);
        
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