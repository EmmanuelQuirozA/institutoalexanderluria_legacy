<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  $jsonresult = array(
    'response' => array(
      'status' => 'error',
      'code' => '3',
      'message' => "Algo salió muy mal"
    )
  );
  if ($accion=="create") {
    $idGrupo = trim($_POST["idGrupo"]);
    $idTrabajador = trim($_POST["idTrabajador"]);
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);
    $tipoDocumento = substr(strrchr($_POST['path'], '.'), 1);
    // $tamano = trim($_POST["tamano"]);
    $fechaSubido = date("Y-m-d H:i:s");
    $path = $_POST['path'];

    if(isset($_POST['idGrupo'])&&isset($_POST['idTrabajador'])&&isset($_POST['titulo'])&&isset($_POST['descripcion'])&&isset($_POST['path'])){
      $pathExtensiom = substr(strrchr($path, '.'), 1);
      $path ="../../../archivos/materialeducativo/".str_replace("/","_",date("Y-m-d"))."_".str_replace(" ","_",$titulo).".".$pathExtensiom;

      //flags
      $grupoExiste=false;//grupo no existe
      $docenteExiste=true;//docente no existe
      try {
        //Busca el grupo existe
        $query = $connection->prepare("SELECT * FROM grupos WHERE idGrupo=:idGrupo");
        $query->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
          $grupoExiste=true;
        }
        //Busca si el docente existe
        $query = $connection->prepare("SELECT * FROM trabajadores WHERE idTrabajador=:idTrabajador AND puesto = 'Docente'");
        $query->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {//Valida que no haya una colegiatura ya registrada y que no esté rechazada aún
          $docenteExiste=true;
        }

        if ($grupoExiste&&$docenteExiste) {//si el alumno sí existe y el pago no se encuentra registrado, procede a guardar el registro en la tabla de pagos
          $query = $connection->prepare(
            "INSERT INTO materialeducativo (idGrupo,idTrabajador,titulo,descripcion,tipoDocumento,fechaSubido,path) 
            VALUES          (:idGrupo,:idTrabajador,:titulo,:descripcion,:tipoDocumento,:fechaSubido,:path)");
          $query->bindParam(":idGrupo", $idGrupo, PDO::PARAM_INT);
          $query->bindParam(":idTrabajador", $idTrabajador, PDO::PARAM_INT);
          $query->bindParam(":titulo", $titulo, PDO::PARAM_STR);
          $query->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
          $query->bindParam(":tipoDocumento", $tipoDocumento, PDO::PARAM_STR);
          $query->bindParam(":fechaSubido", $fechaSubido, PDO::PARAM_STR);
          $query->bindParam(":path", $path, PDO::PARAM_STR);
          $result = $query->execute();
          if ($result) {
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'pathNombre' => $path,
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
        } else {
          if (!$grupoExiste) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'No se encuentra el grupo'
              )
            );
          } else if(!$docenteExiste) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'No se encuentra el docente.'
              )
            );
          }
        }
        
          
      } catch (Exception $e) {
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
    $idMaterialEducativo = trim($_POST['idMaterialEducativo']);
    $descripcion = trim($_POST['descripcion']);
    
    try{
      // UPDATE DE PERSONA
      $query = "UPDATE materialeducativo 
      SET 
      `descripcion` = :descripcion
      WHERE `idMaterialEducativo` = :idMaterialEducativo";
      $sql = $connection->prepare($query);
      $sql->bindParam("idMaterialEducativo", $idMaterialEducativo, PDO::PARAM_INT);
      $sql->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
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
    if(isset($_POST['idMaterialEducativo'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idMaterialEducativo=trim($_POST['idMaterialEducativo']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `materialeducativo` WHERE `idMaterialEducativo` = :idMaterialEducativo");
        $sql->bindParam('idMaterialEducativo', $idMaterialEducativo,PDO::PARAM_INT);
        
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