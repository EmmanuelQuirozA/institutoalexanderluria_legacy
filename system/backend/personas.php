<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);

  if ($accion=="create") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    $sqlselect="SELECT c FROM roles INNER JOIN permisos ON roles.idRol=permisos.idRol INNER JOIN modulos ON permisos.idModulo=modulos.idModulo WHERE nombre = 'Usuarios' AND roles.idRol = ".$_SESSION['idRol'];
    $stmtselect=$connection->prepare($sqlselect);
    $stmtselect->execute();
    $results=$stmtselect->fetchAll();
    
    foreach ($results as $output){
      $c=$output["c"];
    }
    if(isset($_POST['nombre'])&&isset($_POST['apellidoPaterno'])&&isset($_POST['apellidoMaterno'])){
      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      
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
        }
      
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO personas(nombre,apellidoPaterno,apellidoMaterno) 
                        VALUES (:nombre,:apellidoPaterno,:apellidoMaterno)");
          $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
          $query->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
          $query->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
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
    if(isset($_POST['idPersona'])&&isset($_POST['nombre'])&&isset($_POST['apellidoPaterno'])&&isset($_POST['apellidoMaterno'])){
      $idPersona=$_POST['idPersona'];
      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));

        try{
          $query = "UPDATE personas 
            SET 
            `nombre`      		= :nombre,
            `apellidoPaterno` = :apellidoPaterno,
            `apellidoMaterno`       = :apellidoMaterno
            WHERE `idPersona`   = :idPersona";
            $sql = $connection->prepare($query);
            $sql->bindParam("nombre", $nombre, PDO::PARAM_STR);
            $sql->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
            $sql->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
            $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);

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