<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);

  if ($accion=="create") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['materia'])&&isset($_POST['grado'])&&isset($_POST['nivelEscolar'])){
      $clave = ucwords(mb_strtolower(trim($_POST['clave'])));
      $materia = ucwords(mb_strtolower(trim($_POST['materia'])));
      $grado = trim($_POST['grado']);
      $nivelEscolar = trim($_POST['nivelEscolar']);
      
      try{
        $query = $connection->prepare("SELECT * FROM materias WHERE materia=:materia AND grado=:grado AND nivelEscolar=:nivelEscolar");
        $query->bindParam("materia", $materia, PDO::PARAM_STR);
        $query->bindParam("grado", $grado, PDO::PARAM_STR);
        $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
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
            "INSERT INTO materias(clave,materia,grado,nivelEscolar) 
                        VALUES (:clave,:materia,:grado,:nivelEscolar)");
          $query->bindParam("clave", $clave, PDO::PARAM_STR);
          $query->bindParam("materia", $materia, PDO::PARAM_STR);
          $query->bindParam("grado", $grado, PDO::PARAM_STR);
          $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
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
    $flag=false;
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idMateria'])&&isset($_POST['materia'])&&isset($_POST['nivelEscolar'])&&isset($_POST['grado'])){
      $idMateria=$_POST['idMateria'];
      $clave = ucwords(mb_strtolower(trim($_POST['clave'])));
      $materia = ucwords(mb_strtolower(trim($_POST['materia'])));
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $grado = trim($_POST['grado']);

        try{
          $query = "UPDATE materias 
            SET 
            `clave`      		= :clave,
            `materia`      		= :materia,
            `nivelEscolar` = :nivelEscolar,
            `grado`       = :grado
            WHERE `idMateria`   = :idMateria";
            $sql = $connection->prepare($query);
            $sql->bindParam("clave", $clave, PDO::PARAM_STR);
            $sql->bindParam("materia", $materia, PDO::PARAM_STR);
            $sql->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
            $sql->bindParam("grado", $grado, PDO::PARAM_STR);
            $sql->bindParam("idMateria", $idMateria, PDO::PARAM_INT);

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
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idMateria'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idMateria=trim($_POST['idMateria']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `materias` WHERE `idMateria` = :idMateria");
        $sql->bindParam('idMateria', $idMateria,PDO::PARAM_INT);
        
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