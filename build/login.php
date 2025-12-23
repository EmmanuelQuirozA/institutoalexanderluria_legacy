<?php
  try{
    session_start();
    include '../build/config.php';

    $_SESSION['idUsuario'] = 
    $_SESSION['nombreCompleto'] = 
    $_SESSION['username'] = 
    $_SESSION['correoElectronico'] = 
    $_SESSION['idRol'] = 
    $_SESSION['idPersona'] = 
    $_SESSION['cookies'] = 
    $_SESSION['avisoPrivacidad'] = "";

    if (isset($_POST['username'])&&isset($_POST['password'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];

      $query = $connection->prepare("SELECT * FROM usuarios WHERE username=:username OR correoElectronico=:correoElectronico");
      $query->bindParam("correoElectronico", $username, PDO::PARAM_STR);
      $query->bindParam("username", $username, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        session_destroy();
        $jsonresult = array(
          'response' => array(
            'status' => 'error',
            'code' => '0',
            'message' => 'Nombre de usuario o correo electrónico no existe o no se encuentra registrado.'
          )
        );
      } else {
        if (password_verify($password, $result['password'])) {
            
          $idPersona = $result['idPersona'];

          $stmt = $connection->prepare('SELECT idUsuario, username, correoElectronico, usuarios.idRol, usuarios.idPersona, cookies, avisoPrivacidad, nombreRol, nombre, apellidoPaterno, apellidoMaterno FROM usuarios  INNER JOIN roles ON usuarios.idRol=roles.idRol INNER JOIN personas ON usuarios.idPersona=personas.idPersona WHERE usuarios.idPersona = :idPersona');
          $stmt->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $stmt->execute();
          $result = $stmt->fetchAll();
          if ($result) {
            foreach ($result as $row) {
          
              $_SESSION['idUsuario'] = $row['idUsuario'];
              $_SESSION['nombre'] = $row['nombre']." ".$row['apellidoPaterno'];
              $_SESSION['nombreCompleto'] = $row['nombre']." ".$row['apellidoPaterno']." ".$row['apellidoMaterno'];
              $_SESSION['username'] = $row['username'];
              $_SESSION['correoElectronico'] = $row['correoElectronico'];
              $_SESSION['idRol'] = $row['idRol'];
              $_SESSION['idPersona'] = $row['idPersona'];
              $_SESSION['cookies'] = $row['cookies'];
              $_SESSION['avisoPrivacidad'] = $row['avisoPrivacidad'];
              $_SESSION['nombreRol'] = $row['nombreRol'];
              
              $c=1;
              $r=1;
              $u=1;
              $d=1;
              
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '2',
                  'nombreCompleto' => $_SESSION['nombreCompleto'],
                  'nombreRol' => $_SESSION['nombreRol'],
                  'message' => "Login success!"
                )
              );
            }
          }else{
            session_destroy();
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '2',
                'message' => "Algo salió mal."
              )
            );
          }

        } else {
          session_destroy();
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '2',
              'message' => 'Nombre de usuario y contraseña no coincide.'
            )
          );
        }
      }
    }else{
      session_destroy();
      $jsonresult = array(
        'response' => array(
          'status' => 'error',
          'code' => '3',
          'message' => "Los campos de nombre de usuario y contraseña no deben estar vacios."
        )
      );
    }
  }
  catch (PDOException $e) {
    session_destroy();
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '3',
        'message' => $e->getMessage()
      )
    );
  }
  echo json_encode($jsonresult);
?>