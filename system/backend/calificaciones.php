<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if ($accion=="create") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(
      isset($_POST['idTrabajador'])&&
      isset($_POST['idAlumno'])&&
      isset($_POST['nivelEscolar'])&&
      isset($_POST['gradoyGrupo'])&&
      isset($_POST['idMateria'])&&
      isset($_POST['cicloEscolar'])&&
      isset($_POST['periodo'])&&
      isset($_POST['calificacion'])){
      $idTrabajador = trim($_POST['idTrabajador']);
      $idAlumno = trim($_POST['idAlumno']);
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $gradoyGrupo = trim($_POST['gradoyGrupo']);
      $idMateria = trim($_POST['idMateria']);
      $idCicloEscolar = trim($_POST['cicloEscolar']);
      $periodo = ucwords(mb_strtolower(trim($_POST['periodo'])));
      $calificacion = trim($_POST['calificacion']);
      
      try{
        $query = $connection->prepare("SELECT * FROM trabajadores WHERE idTrabajador=:idTrabajador AND puesto='Docente'");
        $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
        $query->execute();
        
        if ($query->rowCount() > 0) {
        
          $query = $connection->prepare("SELECT * FROM alumnos WHERE idAlumno=:idAlumno");
          $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $query->execute();
          
          if ($query->rowCount() > 0) {

            $query = $connection->prepare("SELECT * FROM calificaciones WHERE idAlumno=:idAlumno AND nivelEscolar=:nivelEscolar AND gradoyGrupo=:gradoyGrupo AND idMateria=:idMateria AND idCicloEscolar=:idCicloEscolar AND periodo=:periodo");
            $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
            $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
            $query->bindParam("gradoyGrupo", $gradoyGrupo, PDO::PARAM_STR);
            $query->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
            $query->bindParam("idCicloEscolar", $idCicloEscolar, PDO::PARAM_STR);
            $query->bindParam("periodo", $periodo, PDO::PARAM_STR);
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
                "INSERT INTO calificaciones(idTrabajador,idAlumno,nivelEscolar,gradoyGrupo,idMateria,idCicloEscolar,periodo,calificacion) 
                            VALUES (:idTrabajador,:idAlumno,:nivelEscolar,:gradoyGrupo,:idMateria,:idCicloEscolar,:periodo,:calificacion)");
              $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
              $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
              $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
              $query->bindParam("gradoyGrupo", $gradoyGrupo, PDO::PARAM_STR);
              $query->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
              $query->bindParam("idCicloEscolar", $idCicloEscolar, PDO::PARAM_STR);
              $query->bindParam("periodo", $periodo, PDO::PARAM_STR);
              $query->bindParam("calificacion", $calificacion, PDO::PARAM_STR);
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
                'message' => 'No se encontró el alumno.'
              )
            );
          }
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => 'No se encontró el Docente.'
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
      isset($_POST['idCalificacion'])&&
      isset($_POST['periodo'])&&
      isset($_POST['idMateria'])&&
      isset($_POST['calificacion'])){

      $idCalificacion = trim($_POST['idCalificacion']);
      $idTrabajador = trim($_POST['idTrabajador']);
      $idAlumno = trim($_POST['idAlumno']);
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $gradoyGrupo = trim($_POST['gradoyGrupo']);
      $idMateria = trim($_POST['idMateria']);
      $idCicloEscolar = trim($_POST['cicloEscolar']);
      $periodo = ucwords(mb_strtolower(trim($_POST['periodo'])));
      $calificacion = trim($_POST['calificacion']);

        try{
          $query = $connection->prepare("SELECT * FROM calificaciones WHERE idAlumno=:idAlumno AND nivelEscolar=:nivelEscolar AND gradoyGrupo=:gradoyGrupo AND idMateria=:idMateria AND idCicloEscolar=:idCicloEscolar AND periodo=:periodo AND calificacion=:calificacion");
          $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
          $query->bindParam("gradoyGrupo", $gradoyGrupo, PDO::PARAM_STR);
          $query->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
          $query->bindParam("idCicloEscolar", $idCicloEscolar, PDO::PARAM_STR);
          $query->bindParam("periodo", $periodo, PDO::PARAM_STR);
          $query->bindParam("calificacion", $calificacion, PDO::PARAM_STR);
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
            $query = "UPDATE calificaciones 
              SET 
              `periodo` = :periodo,
              `idMateria` = :idMateria,
              `calificacion` = :calificacion
              WHERE `idCalificacion`   = :idCalificacion";
              $sql = $connection->prepare($query);
              $sql->bindParam("periodo", $periodo, PDO::PARAM_STR);
              $sql->bindParam("idMateria", $idMateria, PDO::PARAM_INT);
              $sql->bindParam("calificacion", $calificacion, PDO::PARAM_STR);
              $sql->bindParam("idCalificacion", $idCalificacion, PDO::PARAM_INT);

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
    if(isset($_POST['idCalificacion'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idCalificacion=trim($_POST['idCalificacion']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `calificaciones` WHERE `idCalificacion` = :idCalificacion");
        $sql->bindParam('idCalificacion', $idCalificacion,PDO::PARAM_INT);
        
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