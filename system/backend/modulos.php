<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
    $descripcion = trim($_POST['descripcion']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if($nombre!=""){
      try{
        $query = $connection->prepare("SELECT * FROM modulos WHERE nombre=:nombre");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->execute();
  
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'El módulo ya se encuentra registrado'
            )
          );
        }
  
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO modulos(nombre,descripcion)
            VALUES      (:nombre,:descripcion)");
          $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
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
    /*<!-------------------------UPDATE PHP------------------------->*/
	  if(
    isset($_POST['idModulo'])&&
    isset($_POST['nombre'])&&
    $_POST['idModulo']!=""&&
    $_POST['nombre']!=""
    ){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idModulo=trim($_POST['idModulo']);
      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $descripcion = trim($_POST['descripcion']);
      /*<!-------------------------UPDATE TABLE------------------------->*/
      try{
        $query = "UPDATE modulos 
          SET 
          `nombre` = :nombre,
          `descripcion` = :descripcion
        WHERE `idModulo` = :idModulo";
        $sql = $connection->prepare($query);
        $sql->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $sql->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
        $sql->bindParam("idModulo", $idModulo, PDO::PARAM_INT);
  
        $sql->execute();
  
        if($sql->rowCount() > 0){
          $jsonresult = array(
            'response' => array(
              'status' => 'success',
              'code' => '0',
              'message' => 'El registro se ha editado correctamente.'
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
    if(isset($_POST['idModulo'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idModulo=trim($_POST['idModulo']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `modulos` WHERE `idModulo` = :idModulo");
        $sql->bindParam('idModulo', $idModulo,PDO::PARAM_INT);
        
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