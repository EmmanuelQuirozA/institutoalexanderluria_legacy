<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if ($accion=="create") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    if (
      isset($_POST['username'])
    &&isset($_POST['password'])
    &&$_POST['username']!=""
    &&$_POST['password']!="") 
    {
  
      $username = trim($_POST['username']);    
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      
      $correoElectronico = trim($_POST['correoElectronico']);    
      $idRol = trim($_POST['idRol']);
      $idPersona = trim($_POST['idPersona']);
      
      try{
        $query = $connection->prepare("SELECT * FROM usuarios WHERE USERNAME=:username OR correoElectronico=:correoElectronico OR idPersona=:idPersona");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
        $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'El nombre de usuario ya se encuentra registrado o la persona ya cuenta con usuario'
            )
          );
        }
      
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO usuarios(username,password,correoElectronico,idRol,idPersona) 
              VALUES (:username,:password,:correoElectronico,:idRol,:idPersona)");
          $query->bindParam("username", $username, PDO::PARAM_STR);
          $query->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
          $query->bindParam("password", $password, PDO::PARAM_STR);
          $query->bindParam("idRol", $idRol, PDO::PARAM_INT);
          $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $result = $query->execute();
      
          if($result){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'El usuario se ha agregado correctamente.'
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
          'message' => 'Llena todos los campos necesarios'
        )
      );
    }
  }elseif ($accion=="createAlumnoUser") {
    /*<!-------------------------REGISTER PHP------------------------->*/
    if (
      isset($_POST['username'])
    &&isset($_POST['password'])
    &&$_POST['username']!=""
    &&$_POST['password']!="") 
    {
  
      $username = trim($_POST['username']);    
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      
      $correoElectronico = trim($_POST['correoElectronico']);    

      $sqlselect="SELECT * FROM roles WHERE nombreRol='Alumno';";
      $stmtselect=$connection->prepare($sqlselect);
      $stmtselect->execute();
      $results=$stmtselect->fetchAll();
      foreach ($results as $output){
        $idRol = $output['idRol'];
      }
      $idPersona = trim($_POST['idPersona']);
      
      try{
        $query = $connection->prepare("SELECT * FROM usuarios WHERE USERNAME=:username OR correoElectronico=:correoElectronico OR idPersona=:idPersona");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
        $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'El nombre de usuario ya se encuentra registrado o la persona ya cuenta con usuario'
            )
          );
        }
      
        if ($query->rowCount() == 0) {
          $query = $connection->prepare(
            "INSERT INTO usuarios(username,password,correoElectronico,idRol,idPersona) 
              VALUES (:username,:password,:correoElectronico,:idRol,:idPersona)");
          $query->bindParam("username", $username, PDO::PARAM_STR);
          $query->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
          $query->bindParam("password", $password, PDO::PARAM_STR);
          $query->bindParam("idRol", $idRol, PDO::PARAM_INT);
          $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $result = $query->execute();
      
          if($result){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'El usuario se ha agregado correctamente.'
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
          'message' => 'Llena todos los campos necesarios'
        )
      );
    }
  }elseif ($accion=="update") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(
      isset($_POST['idUsuario'])&&
      isset($_POST['correoElectronico'])&&
      isset($_POST['idRol'])&&
      $_POST['idUsuario']!=""&&
      $_POST['correoElectronico']!=""&&
      $_POST['idRol']!=""
      ){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idUsuario=trim($_POST['idUsuario']);
      $correoElectronico=trim($_POST['correoElectronico']);
      $idRol=trim($_POST['idRol']);
      $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
      
      /*<!-------------------------UPDATE TABLE------------------------->*/
      try{
        if(isset($_POST['password']) && $_POST['password']!=""){
          if ($_POST['password']==$_POST['passwordConfirm']) {
            $query = "UPDATE usuarios 
            SET 
            `password`      		= :password_hash,
            `correoElectronico` = :correoElectronico,
            `idRol`       = :idRol
            WHERE `idUsuario`   = :idUsuario";
            $sql = $connection->prepare($query);
            $sql->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
            $sql->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $sql->bindParam("idRol", $idRol, PDO::PARAM_INT);
            $sql->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
  
            $sql->execute();
  
            if($sql->rowCount() > 0){
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'message' => 'El usuario se ha editado correctamente y se ha actualizado la contraseña.'
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
          }else{
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '1',
                'message' => 'Las contraseñas no coinciden.'
              )
            );
          }
          
        }else{
          $query = "UPDATE usuarios 
          SET 
          `correoElectronico`       = :correoElectronico,
          `idRol`       = :idRol
          WHERE `idUsuario`   = :idUsuario";
          $sql = $connection->prepare($query);
          $sql->bindParam("correoElectronico", $correoElectronico, PDO::PARAM_STR);
          $sql->bindParam("idRol", $idRol, PDO::PARAM_INT);
          $sql->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
  
          $sql->execute();
  
          if($sql->rowCount() > 0){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'El usuario se ha editado correctamente.'
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
      }catch (Exception $e) {
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
  }elseif ($accion=="updateContrasena") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(
      isset($_POST['password'])&&
      isset($_POST['passwordConfirm'])&&
      $_POST['password']!=""&&
      $_POST['passwordConfirm']!=""
      ){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
      
      /*<!-------------------------UPDATE TABLE------------------------->*/
      try{
        if ($_POST['password']==$_POST['passwordConfirm']) {
          $query = "UPDATE usuarios 
          SET 
          `password`      		= :password_hash
          WHERE `idUsuario`   = :idUsuario";
          $sql = $connection->prepare($query);
          $sql->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
          $sql->bindParam("idUsuario", $_SESSION['idUsuario'], PDO::PARAM_INT);

          $sql->execute();

          if($sql->rowCount() > 0){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'La contraseña se ha actualizado correctamente.'
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
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => 'Las contraseñas no coinciden.'
            )
          );
        }
      }catch (Exception $e) {
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
    if(isset($_POST['idUsuario'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idUsuario=trim($_POST['idUsuario']);
      try{
        if ($_SESSION['idUsuario'] != $idUsuario){
          /*<!-------------------------deleteuser TABLE------------------------->*/
          $sql = $connection->prepare("DELETE FROM `usuarios` WHERE `idUsuario` = :idUsuario");
          $sql->bindParam('idUsuario', $idUsuario,PDO::PARAM_INT);
          
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