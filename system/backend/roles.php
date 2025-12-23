<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    $nombreRol = ucwords(mb_strtolower(trim($_POST['nombreRol'])));
    $descripcion = ucwords(mb_strtolower(trim($_POST['descripcion'])));
    /*<!-------------------------REGISTER PHP------------------------->*/
    if($nombreRol!="")
    {
  
      try{
        $query = $connection->prepare("SELECT * FROM roles WHERE nombreRol=:nombreRol");
        $query->bindParam("nombreRol", $nombreRol, PDO::PARAM_STR);
        $query->execute();
  
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'El rol ya se encuentra registrado'
            )
          );
        }
  
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO roles(nombreRol,descripcion)
            VALUES      (:nombreRol,:descripcion)");
          $query->bindParam("nombreRol", $nombreRol, PDO::PARAM_STR);
          $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
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
    $flag=false;
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idRol'])&&isset($_POST['permisosChecked'])){
      $idRol=$_POST['idRol'];
      $input=$_POST['permisosChecked'];

      $query ="UPDATE `permisos` SET 
      `c` = '0',
      `r` = '0',
      `u` = '0',
      `d` = '0'
      WHERE (`idRol` = '".$idRol."')";
      $sql = $connection->prepare($query);
      $sql->execute();


      foreach ($input as &$permiso) {
        $idPermiso = strtok($permiso, '_');
        $permisoCRUD = strtok(substr($permiso,strlen($idPermiso)+1), '_');
        try{
          $query ="UPDATE `permisos` SET `".$permisoCRUD."` = '1' WHERE (`idPermiso` = '".$idPermiso."') AND (`idRol` = '".$idRol."')";
          $sql = $connection->prepare($query);
      
          $sql->execute();
      
          if($sql->rowCount() > 0){
            $flag=true;
          }else{
            $flag=false;
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
      }
      
      if ($flag) {
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
            'message' => 'Ocurrió un error y no se guardaron los cambios ¡Intenta de nuevo!'
          )
        );
      }
    }else{
      $idRol=$_POST['idRol'];

      $query ="UPDATE `permisos` SET 
      `c` = '0',
      `r` = '0',
      `u` = '0',
      `d` = '0'
      WHERE (`idRol` = '".$idRol."')";
      $sql = $connection->prepare($query);
      $sql->execute();

      $jsonresult = array(
        'response' => array(
          'status' => 'success',
          'code' => '0',
          'message' => 'Se han guardado los cambios'
        )
      );
    }
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idRol'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idRol=trim($_POST['idRol']);
      try{
        if ($_SESSION['idRol'] != $idRol){

          $query = $connection->prepare("SELECT * FROM usuarios WHERE idRol=:idRol");
          $query->bindParam("idRol", $idRol, PDO::PARAM_INT);
          $query->execute();
    
          if ($query->rowCount() > 0) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'Hay usuarios con este rol. Por favor, primero elimine los usuarios y después vuelva a intentar.'
              )
            );
          }else{
            /*<!-------------------------deleteuser TABLE------------------------->*/
            $sql = $connection->prepare("DELETE FROM `roles` WHERE `idRol` = :idRol");
            $sql->bindParam('idRol', $idRol,PDO::PARAM_INT);
            
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
    }
  }elseif ($accion=="relacionarModulo") {
    $idRol =trim($_POST['idRol']);
    $idModulo =trim($_POST['idModulo']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if($idRol!=""&&$idModulo!="")
    {

      try{
        $query = $connection->prepare("SELECT * FROM permisos WHERE idRol=:idRol AND idModulo=:idModulo");
        $query->bindParam("idRol", $idRol, PDO::PARAM_INT);
        $query->bindParam("idModulo", $idModulo, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'La relación módulo-rol ya se encuentra registrada.'
            )
          );
        }

        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO permisos(idRol,idModulo)
            VALUES      (:idRol,:idModulo)");
          $query->bindParam("idRol", $idRol, PDO::PARAM_INT);
          $query->bindParam("idModulo", $idModulo, PDO::PARAM_INT);
          $result = $query->execute();

          if($result){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'La relación módulo-rol se ha agregado correctamente.'
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
          'message' => 'Llena todos los campos necesarios.'
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