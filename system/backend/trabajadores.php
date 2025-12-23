<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    if (isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno'])) {
      
      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      $noTrabajador = ucwords(mb_strtolower(trim($_POST['noTrabajador'])));
      $fechaInicioLabores = ucwords(mb_strtolower(trim($_POST['fechaInicioLabores'])));
      $fechaFinLabores = ucwords(mb_strtolower(trim($_POST['fechaFinLabores'])));
      $puesto = ucwords(mb_strtolower(trim($_POST['puesto'])));
      $sueldo = ucwords(mb_strtolower(trim($_POST['sueldo'])));
      $banco = ucwords(mb_strtolower(trim($_POST['banco'])));
      $noCuenta = ucwords(mb_strtolower(trim($_POST['noCuenta'])));
      $referencia = ucwords(mb_strtolower(trim($_POST['referencia'])));
      $curp = ucwords(mb_strtolower(trim($_POST['curp'])));
      $rfc = ucwords(mb_strtolower(trim($_POST['rfc'])));
      $noSeguro = ucwords(mb_strtolower(trim($_POST['noSeguro'])));
      $fechaNacimiento = ucwords(mb_strtolower(trim($_POST['fechaNacimiento'])));
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $estadoCivil = ucwords(mb_strtolower(trim($_POST['estadoCivil'])));
      $hijos = ucwords(mb_strtolower(trim($_POST['hijos'])));
      $numeroCel = ucwords(mb_strtolower(trim($_POST['numeroCel'])));
      $calle = ucwords(mb_strtolower(trim($_POST['calle'])));
      $numero = ucwords(mb_strtolower(trim($_POST['numero'])));
      $colonia = ucwords(mb_strtolower(trim($_POST['colonia'])));
      $codigoPostal = ucwords(mb_strtolower(trim($_POST['codigoPostal'])));
      $localidad = ucwords(mb_strtolower(trim($_POST['localidad'])));
      $estado = ucwords(mb_strtolower(trim($_POST['estado'])));
      $egresadoDe = ucwords(mb_strtolower(trim($_POST['egresadoDe'])));
      $universidad = ucwords(mb_strtolower(trim($_POST['universidad'])));
      $fechaEgreso = ucwords(mb_strtolower(trim($_POST['fechaEgreso'])));
      $maestria = ucwords(mb_strtolower(trim($_POST['maestria'])));
      $fechaEgresoMaestria = ucwords(mb_strtolower(trim($_POST['fechaEgresoMaestria'])));
      $aniosExperienciaLaboral = ucwords(mb_strtolower(trim($_POST['aniosExperienciaLaboral'])));
      
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
              "INSERT INTO trabajadores(idPersona,noTrabajador,fechaInicioLabores,fechaFinLabores,puesto,sueldo,banco,noCuenta,referencia,curp,rfc,noSeguro,fechaNacimiento,lugarNacimiento,estadoCivil,hijos,numeroCel,calle,numero,colonia,codigoPostal,localidad,estado,egresadoDe,universidad,fechaEgreso,maestria,fechaEgresoMaestria,aniosExperienciaLaboral) 
                          VALUES (:idPersona,:noTrabajador,:fechaInicioLabores,:fechaFinLabores,:puesto,:sueldo,:banco,:noCuenta,:referencia,:curp,:rfc,:noSeguro,:fechaNacimiento,:lugarNacimiento,:estadoCivil,:hijos,:numeroCel,:calle,:numero,:colonia,:codigoPostal,:localidad,:estado,:egresadoDe,:universidad,:fechaEgreso,:maestria,:fechaEgresoMaestria,:aniosExperienciaLaboral)");
            $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
            $query->bindParam("noTrabajador", $noTrabajador, PDO::PARAM_INT);
    				$query->bindValue("fechaInicioLabores",!empty($fechaInicioLabores) ? $fechaInicioLabores : NULL, PDO::PARAM_STR);
    				$query->bindValue("fechaFinLabores",!empty($fechaFinLabores) ? $fechaFinLabores : NULL, PDO::PARAM_STR);
            $query->bindParam("puesto", $puesto, PDO::PARAM_STR);
    				$query->bindValue("sueldo",!empty($sueldo) ? $sueldo : NULL, PDO::PARAM_STR);
            $query->bindParam("banco", $banco, PDO::PARAM_STR);
            $query->bindParam("noCuenta", $noCuenta, PDO::PARAM_INT);
            $query->bindParam("referencia", $referencia, PDO::PARAM_STR);
            $query->bindParam("curp", $curp, PDO::PARAM_STR);
            $query->bindParam("rfc", $rfc, PDO::PARAM_STR);
            $query->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
    				$query->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
            $query->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
            $query->bindParam("estadoCivil", $estadoCivil, PDO::PARAM_STR);
            $query->bindParam("hijos", $hijos, PDO::PARAM_STR);
            $query->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
            $query->bindParam("calle", $calle, PDO::PARAM_STR);
            $query->bindParam("numero", $numero, PDO::PARAM_STR);
            $query->bindParam("colonia", $colonia, PDO::PARAM_STR);
            $query->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
            $query->bindParam("localidad", $localidad, PDO::PARAM_STR);
            $query->bindParam("estado", $estado, PDO::PARAM_STR);
            $query->bindParam("egresadoDe", $egresadoDe, PDO::PARAM_STR);
            $query->bindParam("universidad", $universidad, PDO::PARAM_STR);
    				$query->bindValue("fechaEgreso",!empty($fechaEgreso) ? $fechaEgreso : NULL, PDO::PARAM_STR);
            $query->bindParam("maestria", $maestria, PDO::PARAM_STR);
    				$query->bindValue("fechaEgresoMaestria",!empty($fechaEgresoMaestria) ? $fechaEgresoMaestria : NULL, PDO::PARAM_STR);
            $query->bindParam("aniosExperienciaLaboral", $aniosExperienciaLaboral, PDO::PARAM_INT);
            
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

    }
  }elseif ($accion=="update") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idPersona'])&&isset($_POST['nombre'])&&isset($_POST['apellidoPaterno'])&&isset($_POST['apellidoMaterno'])){
      $idTrabajador=$_POST['idTrabajador'];
      $idPersona=$_POST['idPersona'];

      $nombreTrabajador = ucwords(mb_strtolower(trim($_POST['nombreTrabajador'])));
      $apellidoPaternoTrabajador = ucwords(mb_strtolower(trim($_POST['apellidoPaternoTrabajador'])));
      $apellidoMaternoTrabajador = ucwords(mb_strtolower(trim($_POST['apellidoMaternoTrabajador'])));

      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      $noTrabajador = ucwords(mb_strtolower(trim($_POST['noTrabajador'])));
      $fechaInicioLabores = ucwords(mb_strtolower(trim($_POST['fechaInicioLabores'])));
      $fechaFinLabores = ucwords(mb_strtolower(trim($_POST['fechaFinLabores'])));
      $puesto = ucwords(mb_strtolower(trim($_POST['puesto'])));
      $sueldo = ucwords(mb_strtolower(trim($_POST['sueldo'])));
      $banco = ucwords(mb_strtolower(trim($_POST['banco'])));
      $noCuenta = ucwords(mb_strtolower(trim($_POST['noCuenta'])));
      $referencia = ucwords(mb_strtolower(trim($_POST['referencia'])));
      $curp = ucwords(mb_strtolower(trim($_POST['curp'])));
      $rfc = ucwords(mb_strtolower(trim($_POST['rfc'])));
      $noSeguro = ucwords(mb_strtolower(trim($_POST['noSeguro'])));
      $fechaNacimiento = ucwords(mb_strtolower(trim($_POST['fechaNacimiento'])));
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $estadoCivil = ucwords(mb_strtolower(trim($_POST['estadoCivil'])));
      $hijos = ucwords(mb_strtolower(trim($_POST['hijos'])));
      $numeroCel = ucwords(mb_strtolower(trim($_POST['numeroCel'])));
      $calle = ucwords(mb_strtolower(trim($_POST['calle'])));
      $numero = ucwords(mb_strtolower(trim($_POST['numero'])));
      $colonia = ucwords(mb_strtolower(trim($_POST['colonia'])));
      $codigoPostal = ucwords(mb_strtolower(trim($_POST['codigoPostal'])));
      $localidad = ucwords(mb_strtolower(trim($_POST['localidad'])));
      $estado = ucwords(mb_strtolower(trim($_POST['estado'])));
      $egresadoDe = ucwords(mb_strtolower(trim($_POST['egresadoDe'])));
      $universidad = ucwords(mb_strtolower(trim($_POST['universidad'])));
      $fechaEgreso = ucwords(mb_strtolower(trim($_POST['fechaEgreso'])));
      $maestria = ucwords(mb_strtolower(trim($_POST['maestria'])));
      $fechaEgresoMaestria = ucwords(mb_strtolower(trim($_POST['fechaEgresoMaestria'])));
      $aniosExperienciaLaboral = ucwords(mb_strtolower(trim($_POST['aniosExperienciaLaboral'])));

      try{
        if ($nombreTrabajador!=$nombre || $apellidoPaternoTrabajador!=$apellidoPaterno || $apellidoMaternoTrabajador!=$apellidoMaterno ) {

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
              // UPDATE DE TRABAJADOR
              $query = "UPDATE trabajadores 
                SET 
                `noTrabajador` = :noTrabajador,
                `fechaInicioLabores` = :fechaInicioLabores,
                `fechaFinLabores` = :fechaFinLabores,
                `puesto` = :puesto,
                `sueldo` = :sueldo,
                `banco` = :banco,
                `noCuenta` = :noCuenta,
                `referencia` = :referencia,
                `curp` = :curp,
                `rfc` = :rfc,
                `noSeguro` = :noSeguro,
                `fechaNacimiento` = :fechaNacimiento,
                `lugarNacimiento` = :lugarNacimiento,
                `estadoCivil` = :estadoCivil,
                `hijos` = :hijos,
                `numeroCel` = :numeroCel,
                `calle` = :calle,
                `numero` = :numero,
                `colonia` = :colonia,
                `codigoPostal` = :codigoPostal,
                `localidad` = :localidad,
                `estado` = :estado,
                `egresadoDe` = :egresadoDe,
                `universidad` = :universidad,
                `fechaEgreso` = :fechaEgreso,
                `maestria` = :maestria,
                `fechaEgresoMaestria` = :fechaEgresoMaestria,
                `aniosExperienciaLaboral` = :aniosExperienciaLaboral
                WHERE `idPersona` = :idPersona AND `idTrabajador` = :idTrabajador ";
                $sql = $connection->prepare($query);
                $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
                $sql->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
                $sql->bindParam("noTrabajador", $noTrabajador, PDO::PARAM_INT);
                $sql->bindValue("fechaInicioLabores",!empty($fechaInicioLabores) ? $fechaInicioLabores : NULL, PDO::PARAM_STR);
                $sql->bindValue("fechaFinLabores",!empty($fechaFinLabores) ? $fechaFinLabores : NULL, PDO::PARAM_STR);
                $sql->bindParam("puesto", $puesto, PDO::PARAM_STR);
                $sql->bindValue("sueldo",!empty($sueldo) ? $sueldo : NULL, PDO::PARAM_STR);
                $sql->bindParam("banco", $banco, PDO::PARAM_STR);
                $sql->bindParam("noCuenta", $noCuenta, PDO::PARAM_INT);
                $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
                $sql->bindParam("curp", $curp, PDO::PARAM_STR);
                $sql->bindParam("rfc", $rfc, PDO::PARAM_STR);
                $sql->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
                $sql->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
                $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
                $sql->bindParam("estadoCivil", $estadoCivil, PDO::PARAM_STR);
                $sql->bindParam("hijos", $hijos, PDO::PARAM_STR);
                $sql->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
                $sql->bindParam("calle", $calle, PDO::PARAM_STR);
                $sql->bindParam("numero", $numero, PDO::PARAM_STR);
                $sql->bindParam("colonia", $colonia, PDO::PARAM_STR);
                $sql->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
                $sql->bindParam("localidad", $localidad, PDO::PARAM_STR);
                $sql->bindParam("estado", $estado, PDO::PARAM_STR);
                $sql->bindParam("egresadoDe", $egresadoDe, PDO::PARAM_STR);
                $sql->bindParam("universidad", $universidad, PDO::PARAM_STR);
                $sql->bindValue("fechaEgreso",!empty($fechaEgreso) ? $fechaEgreso : NULL, PDO::PARAM_STR);
                $sql->bindParam("maestria", $maestria, PDO::PARAM_STR);
                $sql->bindValue("fechaEgresoMaestria",!empty($fechaEgresoMaestria) ? $fechaEgresoMaestria : NULL, PDO::PARAM_STR);
                $sql->bindParam("aniosExperienciaLaboral", $aniosExperienciaLaboral, PDO::PARAM_INT);

              $sql->execute();
          
              // UPDATE DE ALUMNO :: RESULTADO
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
          // UPDATE DE TRABAJADOR
          $query = "UPDATE trabajadores 
          SET 
          `noTrabajador` = :noTrabajador,
          `fechaInicioLabores` = :fechaInicioLabores,
          `fechaFinLabores` = :fechaFinLabores,
          `puesto` = :puesto,
          `sueldo` = :sueldo,
          `banco` = :banco,
          `noCuenta` = :noCuenta,
          `referencia` = :referencia,
          `curp` = :curp,
          `rfc` = :rfc,
          `noSeguro` = :noSeguro,
          `fechaNacimiento` = :fechaNacimiento,
          `lugarNacimiento` = :lugarNacimiento,
          `estadoCivil` = :estadoCivil,
          `hijos` = :hijos,
          `numeroCel` = :numeroCel,
          `calle` = :calle,
          `numero` = :numero,
          `colonia` = :colonia,
          `codigoPostal` = :codigoPostal,
          `localidad` = :localidad,
          `estado` = :estado,
          `egresadoDe` = :egresadoDe,
          `universidad` = :universidad,
          `fechaEgreso` = :fechaEgreso,
          `maestria` = :maestria,
          `fechaEgresoMaestria` = :fechaEgresoMaestria,
          `aniosExperienciaLaboral` = :aniosExperienciaLaboral
          WHERE `idPersona` = :idPersona AND `idTrabajador` = :idTrabajador ";
          $sql = $connection->prepare($query);
          $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $sql->bindParam("idTrabajador", $idTrabajador, PDO::PARAM_INT);
          $sql->bindParam("noTrabajador", $noTrabajador, PDO::PARAM_INT);
          $sql->bindValue("fechaInicioLabores",!empty($fechaInicioLabores) ? $fechaInicioLabores : NULL, PDO::PARAM_STR);
          $sql->bindValue("fechaFinLabores",!empty($fechaFinLabores) ? $fechaFinLabores : NULL, PDO::PARAM_STR);
          $sql->bindParam("puesto", $puesto, PDO::PARAM_STR);
          $sql->bindValue("sueldo",!empty($sueldo) ? $sueldo : NULL, PDO::PARAM_STR);
          $sql->bindParam("banco", $banco, PDO::PARAM_STR);
          $sql->bindParam("noCuenta", $noCuenta, PDO::PARAM_INT);
          $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
          $sql->bindParam("curp", $curp, PDO::PARAM_STR);
          $sql->bindParam("rfc", $rfc, PDO::PARAM_STR);
          $sql->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
          $sql->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
          $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
          $sql->bindParam("estadoCivil", $estadoCivil, PDO::PARAM_STR);
          $sql->bindParam("hijos", $hijos, PDO::PARAM_STR);
          $sql->bindParam("numeroCel", $numeroCel, PDO::PARAM_STR);
          $sql->bindParam("calle", $calle, PDO::PARAM_STR);
          $sql->bindParam("numero", $numero, PDO::PARAM_STR);
          $sql->bindParam("colonia", $colonia, PDO::PARAM_STR);
          $sql->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
          $sql->bindParam("localidad", $localidad, PDO::PARAM_STR);
          $sql->bindParam("estado", $estado, PDO::PARAM_STR);
          $sql->bindParam("egresadoDe", $egresadoDe, PDO::PARAM_STR);
          $sql->bindParam("universidad", $universidad, PDO::PARAM_STR);
          $sql->bindValue("fechaEgreso",!empty($fechaEgreso) ? $fechaEgreso : NULL, PDO::PARAM_STR);
          $sql->bindParam("maestria", $maestria, PDO::PARAM_STR);
          $sql->bindValue("fechaEgresoMaestria",!empty($fechaEgresoMaestria) ? $fechaEgresoMaestria : NULL, PDO::PARAM_STR);
          $sql->bindParam("aniosExperienciaLaboral", $aniosExperienciaLaboral, PDO::PARAM_INT);

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
            $sql = $connection->prepare("DELETE FROM `trabajadores` WHERE `idPersona` = :idPersona");
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