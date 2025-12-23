<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="create"){
    if (isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno'])) {
      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      $matricula = mb_strtoupper(trim($_POST['matricula']));
      $referencia = ucwords(mb_strtolower(trim($_POST['referencia'])));
      $idGrupo = mb_strtoupper(trim($_POST['idGrupo']));
      $medicoFamiliar = ucwords(mb_strtolower(trim($_POST['medicoFamiliar'])));
      $telefonoMF = ucwords(mb_strtolower(trim($_POST['telefonoMF'])));
      $enCasoDeEmergencia = ucwords(mb_strtolower(trim($_POST['enCasoDeEmergencia'])));
      $alergias = ucwords(mb_strtolower(trim($_POST['alergias'])));
      $cuidadosEspeciales = ucwords(mb_strtolower(trim($_POST['cuidadosEspeciales'])));
      $curp = ucwords(mb_strtolower(trim($_POST['curp'])));
      $noSeguro = ucwords(mb_strtolower(trim($_POST['noSeguro'])));
      $fechaNacimiento = ucwords(mb_strtolower(trim($_POST['fechaNacimiento'])));
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $nacionalidad = ucwords(mb_strtolower(trim($_POST['nacionalidad'])));
      $religion = ucwords(mb_strtolower(trim($_POST['religion'])));
      $tipoSangre = ucwords(mb_strtolower(trim($_POST['tipoSangre'])));
      $peso = ucwords(mb_strtolower(trim($_POST['peso'])));
      $talla = ucwords(mb_strtolower(trim($_POST['talla'])));
      $calle = ucwords(mb_strtolower(trim($_POST['calle'])));
      $numero = ucwords(mb_strtolower(trim($_POST['numero'])));
      $colonia = ucwords(mb_strtolower(trim($_POST['colonia'])));
      $codigoPostal = ucwords(mb_strtolower(trim($_POST['codigoPostal'])));
      $localidad = ucwords(mb_strtolower(trim($_POST['localidad'])));
      $ciudad = ucwords(mb_strtolower(trim($_POST['ciudad'])));
      $estado = ucwords(mb_strtolower(trim($_POST['estado'])));
      
      try{
        $query = $connection->prepare("SELECT * FROM personas p INNER JOIN alumnos a ON p.idPersona=a.idPersona WHERE nombre=:nombre and apellidoPaterno=:apellidoPaterno and apellidoMaterno=:apellidoMaterno OR referencia=:referencia");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("apellidoPaterno", $apellidoPaterno, PDO::PARAM_STR);
        $query->bindParam("apellidoMaterno", $apellidoMaterno, PDO::PARAM_STR);
        $query->bindParam("referencia", $referencia, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos nombres y apellidos o referencia.'
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
              "INSERT INTO alumnos(idPersona,matricula,referencia,idGrupo,medicoFamiliar,telefonoMF,enCasoDeEmergencia,alergias,cuidadosEspeciales,curp,noSeguro,fechaNacimiento,lugarNacimiento,nacionalidad,religion,tipoSangre,peso,talla,calle,numero,colonia,codigoPostal,localidad,ciudad,estado) 
                          VALUES (:idPersona,:matricula,:referencia,:idGrupo,:medicoFamiliar,:telefonoMF,:enCasoDeEmergencia,:alergias,:cuidadosEspeciales,:curp,:noSeguro,:fechaNacimiento,:lugarNacimiento,:nacionalidad,:religion,:tipoSangre,:peso,:talla,:calle,:numero,:colonia,:codigoPostal,:localidad,:ciudad,:estado)");
            $query->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
            $query->bindParam("matricula", $matricula, PDO::PARAM_STR);
            $query->bindParam("referencia", $referencia, PDO::PARAM_STR);
            $query->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
            $query->bindParam("medicoFamiliar", $medicoFamiliar, PDO::PARAM_STR);
            $query->bindParam("telefonoMF", $telefonoMF, PDO::PARAM_STR);
            $query->bindParam("enCasoDeEmergencia", $enCasoDeEmergencia, PDO::PARAM_STR);
            $query->bindParam("alergias", $alergias, PDO::PARAM_STR);
            $query->bindParam("cuidadosEspeciales", $cuidadosEspeciales, PDO::PARAM_STR);
            $query->bindParam("curp", $curp, PDO::PARAM_STR);
            $query->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
    				$query->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
            $query->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
            $query->bindParam("nacionalidad", $nacionalidad, PDO::PARAM_STR);
            $query->bindParam("religion", $religion, PDO::PARAM_STR);
            $query->bindParam("tipoSangre", $tipoSangre, PDO::PARAM_STR);
            $query->bindParam("peso", $peso, PDO::PARAM_INT);
            $query->bindParam("talla", $talla, PDO::PARAM_STR);
            $query->bindParam("calle", $calle, PDO::PARAM_STR);
            $query->bindParam("numero", $numero, PDO::PARAM_STR);
            $query->bindParam("colonia", $colonia, PDO::PARAM_STR);
            $query->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
            $query->bindParam("localidad", $localidad, PDO::PARAM_STR);
            $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
            $query->bindParam("estado", $estado, PDO::PARAM_STR);
            
            $result = $query->execute();
            if($result){
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'idPersona' => $idPersona,
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
  }elseif ($accion=="update") {
    /*<!-------------------------UPDATE PHP------------------------->*/
    if(isset($_POST['idPersona'])&&isset($_POST['nombre'])&&isset($_POST['apellidoPaterno'])&&isset($_POST['apellidoMaterno'])){
      $idAlumno=$_POST['idAlumno'];
      $idPersona=$_POST['idPersona'];

      $nombreAlumno = ucwords(mb_strtolower(trim($_POST['nombreAlumno'])));
      $apellidoPaternoAlumno = ucwords(mb_strtolower(trim($_POST['apellidoPaternoAlumno'])));
      $apellidoMaternoAlumno = ucwords(mb_strtolower(trim($_POST['apellidoMaternoAlumno'])));

      $nombre = ucwords(mb_strtolower(trim($_POST['nombre'])));
      $apellidoPaterno = ucwords(mb_strtolower(trim($_POST['apellidoPaterno'])));
      $apellidoMaterno = ucwords(mb_strtolower(trim($_POST['apellidoMaterno'])));
      $matricula = mb_strtoupper(trim($_POST['matricula']));
      $referencia = ucwords(mb_strtolower(trim($_POST['referencia'])));
      $idGrupo = trim($_POST['idGrupo']);
      $medicoFamiliar = ucwords(mb_strtolower(trim($_POST['medicoFamiliar'])));
      $telefonoMF = ucwords(mb_strtolower(trim($_POST['telefonoMF'])));
      $enCasoDeEmergencia = ucwords(mb_strtolower(trim($_POST['enCasoDeEmergencia'])));
      $alergias = ucwords(mb_strtolower(trim($_POST['alergias'])));
      $cuidadosEspeciales = ucwords(mb_strtolower(trim($_POST['cuidadosEspeciales'])));
      $curp = ucwords(mb_strtolower(trim($_POST['curp'])));
      $noSeguro = ucwords(mb_strtolower(trim($_POST['noSeguro'])));
      $fechaNacimiento = ucwords(mb_strtolower(trim($_POST['fechaNacimiento'])));
      $lugarNacimiento = ucwords(mb_strtolower(trim($_POST['lugarNacimiento'])));
      $nacionalidad = ucwords(mb_strtolower(trim($_POST['nacionalidad'])));
      $religion = ucwords(mb_strtolower(trim($_POST['religion'])));
      $tipoSangre = ucwords(mb_strtolower(trim($_POST['tipoSangre'])));
      $peso = ucwords(mb_strtolower(trim($_POST['peso'])));
      $talla = ucwords(mb_strtolower(trim($_POST['talla'])));
      $calle = ucwords(mb_strtolower(trim($_POST['calle'])));
      $numero = ucwords(mb_strtolower(trim($_POST['numero'])));
      $colonia = ucwords(mb_strtolower(trim($_POST['colonia'])));
      $codigoPostal = ucwords(mb_strtolower(trim($_POST['codigoPostal'])));
      $localidad = ucwords(mb_strtolower(trim($_POST['localidad'])));
      $ciudad = ucwords(mb_strtolower(trim($_POST['ciudad'])));
      $estado = ucwords(mb_strtolower(trim($_POST['estado'])));
      try{
        if ($nombreAlumno!=$nombre || $apellidoPaternoAlumno!=$apellidoPaterno || $apellidoMaternoAlumno!=$apellidoMaterno ) {
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
              // UPDATE DE ALUMNO
              $query = "UPDATE alumnos 
                SET 
                `matricula` = :matricula,
                `referencia` = :referencia,
                `idGrupo` = :idGrupo,
                `medicoFamiliar` = :medicoFamiliar,
                `telefonoMF` = :telefonoMF,
                `enCasoDeEmergencia` = :enCasoDeEmergencia,
                `alergias` = :alergias,
                `cuidadosEspeciales` = :cuidadosEspeciales,
                `curp` = :curp,
                `noSeguro` = :noSeguro,
                `fechaNacimiento` = :fechaNacimiento,
                `lugarNacimiento` = :lugarNacimiento,
                `nacionalidad` = :nacionalidad,
                `religion` = :religion,
                `tipoSangre` = :tipoSangre,
                `peso` = :peso,
                `talla` = :talla,
                `calle` = :calle,
                `numero` = :numero,
                `colonia` = :colonia,
                `codigoPostal` = :codigoPostal,
                `localidad` = :localidad,
                `ciudad` = :ciudad,
                `estado` = :estado
                WHERE `idAlumno` = :idAlumno AND `idPersona` = :idPersona ";
                $sql = $connection->prepare($query);
                $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
                $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
                $sql->bindParam("matricula", $matricula, PDO::PARAM_STR);
                $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
                $sql->bindParam("idGrupo", $idGrupo, PDO::PARAM_INT);
                $sql->bindParam("medicoFamiliar", $medicoFamiliar, PDO::PARAM_STR);
                $sql->bindParam("telefonoMF", $telefonoMF, PDO::PARAM_STR);
                $sql->bindParam("enCasoDeEmergencia", $enCasoDeEmergencia, PDO::PARAM_STR);
                $sql->bindParam("alergias", $alergias, PDO::PARAM_STR);
                $sql->bindParam("cuidadosEspeciales", $cuidadosEspeciales, PDO::PARAM_STR);
                $sql->bindParam("curp", $curp, PDO::PARAM_STR);
                $sql->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
                $sql->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
                $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
                $sql->bindParam("nacionalidad", $nacionalidad, PDO::PARAM_STR);
                $sql->bindParam("religion", $religion, PDO::PARAM_STR);
                $sql->bindParam("tipoSangre", $tipoSangre, PDO::PARAM_STR);
                $sql->bindParam("peso", $peso, PDO::PARAM_INT);
                $sql->bindParam("talla", $talla, PDO::PARAM_STR);
                $sql->bindParam("calle", $calle, PDO::PARAM_STR);
                $sql->bindParam("numero", $numero, PDO::PARAM_STR);
                $sql->bindParam("colonia", $colonia, PDO::PARAM_STR);
                $sql->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
                $sql->bindParam("localidad", $localidad, PDO::PARAM_STR);
                $sql->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
                $sql->bindParam("estado", $estado, PDO::PARAM_STR);

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
          // UPDATE DE ALUMNO
          $query = "UPDATE alumnos 
          SET 
          `matricula` = :matricula,
          `referencia` = :referencia,
          `idGrupo` = :idGrupo,
          `medicoFamiliar` = :medicoFamiliar,
          `telefonoMF` = :telefonoMF,
          `enCasoDeEmergencia` = :enCasoDeEmergencia,
          `alergias` = :alergias,
          `cuidadosEspeciales` = :cuidadosEspeciales,
          `curp` = :curp,
          `noSeguro` = :noSeguro,
          `fechaNacimiento` = :fechaNacimiento,
          `lugarNacimiento` = :lugarNacimiento,
          `nacionalidad` = :nacionalidad,
          `religion` = :religion,
          `tipoSangre` = :tipoSangre,
          `peso` = :peso,
          `talla` = :talla,
          `calle` = :calle,
          `numero` = :numero,
          `colonia` = :colonia,
          `codigoPostal` = :codigoPostal,
          `localidad` = :localidad,
          `ciudad` = :ciudad,
          `estado` = :estado
          WHERE `idAlumno` = :idAlumno AND `idPersona` = :idPersona ";
          $sql = $connection->prepare($query);
          $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $sql->bindParam("idPersona", $idPersona, PDO::PARAM_INT);
          $sql->bindParam("matricula", $matricula, PDO::PARAM_STR);
          $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
          $sql->bindParam("idGrupo", $idGrupo, PDO::PARAM_STR);
          $sql->bindParam("medicoFamiliar", $medicoFamiliar, PDO::PARAM_STR);
          $sql->bindParam("telefonoMF", $telefonoMF, PDO::PARAM_STR);
          $sql->bindParam("enCasoDeEmergencia", $enCasoDeEmergencia, PDO::PARAM_STR);
          $sql->bindParam("alergias", $alergias, PDO::PARAM_STR);
          $sql->bindParam("cuidadosEspeciales", $cuidadosEspeciales, PDO::PARAM_STR);
          $sql->bindParam("curp", $curp, PDO::PARAM_STR);
          $sql->bindParam("noSeguro", $noSeguro, PDO::PARAM_STR);
          $sql->bindValue("fechaNacimiento",!empty($fechaNacimiento) ? $fechaNacimiento : NULL, PDO::PARAM_STR);
          $sql->bindParam("lugarNacimiento", $lugarNacimiento, PDO::PARAM_STR);
          $sql->bindParam("nacionalidad", $nacionalidad, PDO::PARAM_STR);
          $sql->bindParam("religion", $religion, PDO::PARAM_STR);
          $sql->bindParam("tipoSangre", $tipoSangre, PDO::PARAM_STR);
          $sql->bindParam("peso", $peso, PDO::PARAM_INT);
          $sql->bindParam("talla", $talla, PDO::PARAM_STR);
          $sql->bindParam("calle", $calle, PDO::PARAM_STR);
          $sql->bindParam("numero", $numero, PDO::PARAM_STR);
          $sql->bindParam("colonia", $colonia, PDO::PARAM_STR);
          $sql->bindParam("codigoPostal", $codigoPostal, PDO::PARAM_STR);
          $sql->bindParam("localidad", $localidad, PDO::PARAM_STR);
          $sql->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
          $sql->bindParam("estado", $estado, PDO::PARAM_STR);

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
            $sql = $connection->prepare("DELETE FROM `alumnos` WHERE `idPersona` = :idPersona");
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
  }elseif ($accion=="bajaAlta") {
    $idAlumno=$_POST['idAlumno'];
    $nuevoEstatusAlumno=$_POST['nuevoEstatusAlumno'];

    try{
        $query = "UPDATE alumnos 
          SET 
          `estatusAlumno`       = :nuevoEstatusAlumno
          WHERE `idAlumno`   = :idAlumno";
          $sql = $connection->prepare($query);
          $sql->bindParam("nuevoEstatusAlumno", $nuevoEstatusAlumno, PDO::PARAM_STR);
          $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);

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
        'code' => '1',
        'message' => '¡Error 555!'
      )
    );
  }
  echo json_encode($jsonresult);
?>