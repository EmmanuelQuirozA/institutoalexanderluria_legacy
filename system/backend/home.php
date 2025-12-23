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
  if ($accion=="createPago") {
    $alumno = trim($_POST["alumno"]);

    $idAlumno = $_POST['alumno'];
    $idUsuario = $_SESSION['idUsuario'];
    $nivelEscolar = trim($_POST["nivelEscolar"]);
    $gradoyGrupo = trim($_POST["gradoyGrupo"]);
    $referencia = trim($_POST["referencia"]);
    $concepto = trim($_POST["concepto"]);
    $monto = trim($_POST["monto"]);
    $fechaRegistro = date("Y/m/d");
    $fechaPago = trim($_POST["fechaPago"]);
    $formaPago = trim($_POST["formaPago"]);
    $estatusPago = trim($_POST["estatusPago"]);
    $comprobante = trim($_POST["comprobante"]);
    if (trim($_POST['comprobante'])!="") {
      $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
      $comprobante ="../../../archivos/comprobantesPago/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$alumno)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
    }
		$cicloEscolar = substr($_POST['cicloEscolar'], 12);
    $mesColegiatura = trim($_POST["mesColegiatura"]);
    $observaciones = trim($_POST["observaciones"]);
    $folio = trim($_POST["folio"]);

		$montoConcat = $monto." | ".$fechaPago;

    if ($estatusPago!="Sin aprobar") {
      $idUsuarioAprobo = $_SESSION['idUsuario'];
      $fechaAprobacion = date("Y/m/d");
    }else{
      $idUsuarioAprobo = "";
      $fechaAprobacion = "";
    }

    //flags
    $alumnoExiste=false;//Alumno no existe
    $pagoNoExiste=true;//Pago sí existe
    //Para que se pueda procesar el pago, el alumno debe de existir y el pago no $alumnoExiste=true&&$pagoNoExiste==true
    try {
      //Busca el alumno existe
      $query = $connection->prepare("SELECT * FROM alumnos WHERE idAlumno=:idAlumno");
      $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
      $query->execute();
      if ($query->rowCount() > 0) {
        $alumnoExiste=true;
      }
      //Busca si el pago existe
      if($concepto=="Colegiatura" && isset($_POST['mesColegiatura'])){//Primero ve si es colegiatura u otro tipo de pago y si está aceptado el pago
        $query = $connection->prepare("SELECT * FROM pagos WHERE idAlumno=:idAlumno AND mesColegiatura=:mesColegiatura AND cicloEscolar=:cicloEscolar AND estatusPago <> 'Rechazado'");
        $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
        $query->bindParam("mesColegiatura", $mesColegiatura, PDO::PARAM_STR);
        $query->bindParam("cicloEscolar", $cicloEscolar, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {//Valida que no haya una colegiatura ya registrada y que no esté rechazada aún
          $pagoNoExiste=false;
        }
      }
      if ($alumnoExiste&&$pagoNoExiste) {//si el alumno sí existe y el pago no se encuentra registrado, procede a guardar el registro en la tabla de pagos
        $query = $connection->prepare(
          "INSERT INTO pagos (idAlumno,idUsuario,nivelEscolar,gradoyGrupo,referencia,concepto,monto,fechaRegistro,fechaPago,formaPago,estatusPago,comprobante,cicloEscolar,mesColegiatura,observaciones,folio,idUsuarioAprobo,fechaAprobacion) 
          VALUES          (:idAlumno,:idUsuario,:nivelEscolar,:gradoyGrupo,:referencia,:concepto,:monto,:fechaRegistro,:fechaPago,:formaPago,:estatusPago,:comprobante,:cicloEscolar,:mesColegiatura,:observaciones,:folio,:idUsuarioAprobo,:fechaAprobacion)");
        $query->bindParam(":idAlumno", $idAlumno, PDO::PARAM_INT);
        $query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $query->bindParam(":nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
        $query->bindParam(":gradoyGrupo", $gradoyGrupo, PDO::PARAM_STR);
        $query->bindParam(":referencia", $referencia, PDO::PARAM_STR);
        $query->bindParam(":concepto", $concepto, PDO::PARAM_STR);
        $query->bindParam(":monto", $monto, PDO::PARAM_STR);
        $query->bindParam(":fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
        $query->bindParam(":fechaPago", $fechaPago, PDO::PARAM_STR);
        $query->bindValue(':fechaPago',!empty($fechaPago) ? $fechaPago : NULL, PDO::PARAM_STR);
        $query->bindParam(":formaPago", $formaPago, PDO::PARAM_STR);
        $query->bindValue(':estatusPago',!empty($estatusPago) ? $estatusPago : NULL, PDO::PARAM_STR);
        $query->bindParam(":comprobante", $comprobante, PDO::PARAM_STR);
        $query->bindParam(":cicloEscolar", $cicloEscolar, PDO::PARAM_STR);
        $query->bindParam(":mesColegiatura", $mesColegiatura, PDO::PARAM_STR);
        $query->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);
        $query->bindParam(":folio", $folio, PDO::PARAM_STR);
        $query->bindValue(':idUsuarioAprobo',!empty($idUsuarioAprobo) ? $idUsuarioAprobo : NULL, PDO::PARAM_STR);
        $query->bindValue(':fechaAprobacion',!empty($fechaAprobacion) ? $fechaAprobacion : NULL, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
          if($concepto=="Colegiatura" && isset($_POST['mesColegiatura'])){
            if($estatusPago=="Aceptado"){
              $lastIdPago = $connection->lastInsertId();
              
              $query = $connection->prepare("SELECT * FROM `colegiaturas".$cicloEscolar."` WHERE idAlumno=:idAlumno");
              $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
              $query->execute();
              if ($query->rowCount() > 0) {//Busca si el alumno ya tiene un renglón de colegiaturas, si sí, actualiza el renglón con la información 
                $query = "UPDATE `colegiaturas".$cicloEscolar."`
                  SET 
                  `".$mesColegiatura."`    = :monto
                WHERE `idAlumno` = :idAlumno";
                $sql = $connection->prepare($query);
                $sql->bindParam("monto", $montoConcat, PDO::PARAM_STR);
                $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);

                $result2 = $sql->execute();
                $lastIdColegiatura = $connection->lastInsertId();

                if ($result2) {
                  $query = "UPDATE pagos SET `idColegiatura` = :idColegiatura WHERE `idPago` = :idPago";
                  $sql = $connection->prepare($query);
                  $sql->bindParam(":idColegiatura", $lastIdColegiatura, PDO::PARAM_INT);
                  $sql->bindParam(":idPago", $lastIdPago, PDO::PARAM_INT);
                  $sql->execute();
                }
              }else{
                $query = $connection->prepare(//si el alumno no tiene un renglón ya registrado, lo registra
                  "INSERT INTO `colegiaturas".$cicloEscolar."` (`idAlumno`,`alumno`,`".$mesColegiatura."`) 
                  VALUES          (:idAlumno,:alumno,:monto)");
                $query->bindParam(":idAlumno", $idAlumno, PDO::PARAM_INT);
                $query->bindParam(":alumno", $alumno, PDO::PARAM_STR);
                $query->bindParam(":monto", $montoConcat, PDO::PARAM_STR);

                $result2 = $query->execute();
                $lastIdColegiatura = $connection->lastInsertId();

                if ($result2) {
                  $query = "UPDATE pagos SET `idColegiatura` = :idColegiatura WHERE `idPago` = :idPago";
                  $sql = $connection->prepare($query);
                  $sql->bindParam(":idColegiatura", $lastIdColegiatura, PDO::PARAM_INT);
                  $sql->bindParam(":idPago", $lastIdPago, PDO::PARAM_INT);
                  $sql->execute();
                }
              }
              if ($result2) {
                if (trim($_POST['comprobante'])!="") {
                  $jsonresult = array(
                    'response' => array(
                      'status' => 'success',
                      'code' => '0',
                      'comprobanteNombre' => $comprobante,
                      'message' => 'La colegiatura se ha agregado correctamente.'
                    )
                  );
                }else{
                  $jsonresult = array(
                    'response' => array(
                      'status' => 'success',
                      'code' => '0',
                      'comprobanteNombre' => "",
                      'message' => 'La colegiatura se ha agregado correctamente.'
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
            }else{
              if (trim($_POST['comprobante'])!="") {
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'comprobanteNombre' => $comprobante,
                    'message' => 'El registro se ha agregado correctamente.'
                  )
                );
              }else{
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'comprobanteNombre' => "",
                    'message' => 'El registro se ha agregado correctamente.'
                  )
                );
              }
            }
          }else{
            if (trim($_POST['comprobante'])!="") {
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'comprobanteNombre' => $comprobante,
                  'message' => 'El registro se ha agregado correctamente.'
                )
              );
            }else{
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'comprobanteNombre' => "",
                  'message' => 'El registro se ha agregado correctamente.'
                )
              );
            }
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
      } else {
        if (!$alumnoExiste) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'No se encuentra el alumno'
            )
          );
        } else if(!$pagoNoExiste) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'La colegiatura del alumno ya se encuentra registrada, intenta cambiar el estatus si no está aceptada aún.'
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

  }elseif ($accion=="updatePago") {
    if(isset($_POST['alumno'])){

      $idPago = trim($_POST['idPago']);
      $alumno = $_POST['idAlumno']." - ".trim($_POST['alumno']);
      $concepto = trim($_POST['concepto']);
      $fechaRegistro = trim($_POST['fechaRegistro']);
      
      $observaciones = trim($_POST['observaciones']);
      $estatusPago = trim($_POST['estatusPago']);

      $fechaPago = trim($_POST["fechaPago"]);
      $monto = $_POST['monto'];
      $lastIdPago=$idPago;
      $idAlumno = $_POST['idAlumno'];
      $cicloEscolar = substr($_POST['cicloEscolar'], 12);
      $mesColegiatura = trim($_POST["mesColegiatura"]);
      $montoConcat = $monto." | ".$fechaPago;

      if ($estatusPago!="Sin aprobar") {
        $idUsuarioAprobo = $_SESSION['idUsuario'];
        $fechaAprobacion = date("Y/m/d");
      }else{
        $idUsuarioAprobo = "";
        $fechaAprobacion = "";
      }

      $comprobante = ucwords(mb_strtolower(trim($_POST['comprobante'])));
      
      if (trim($_POST['comprobante'])!="") {
        $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
        $comprobante ="../../../archivos/comprobantesPago/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$alumno)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
      }

      
      try{
        $query = "UPDATE pagos 
        SET 
        `observaciones` = :observaciones,
        `estatusPago` = :estatusPago,
        `comprobante` = :comprobante,
        `idUsuarioAprobo` = :idUsuarioAprobo,
        `fechaAprobacion` = :fechaAprobacion
        WHERE `idPago` = :idPago";
        $sql = $connection->prepare($query);
        $sql->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
        $sql->bindParam("estatusPago", $estatusPago, PDO::PARAM_STR);
        $sql->bindParam("comprobante", $comprobante, PDO::PARAM_STR);
        $sql->bindParam("idPago", $idPago, PDO::PARAM_INT);
        $sql->bindValue("idUsuarioAprobo",!empty($idUsuarioAprobo) ? $idUsuarioAprobo : null, PDO::PARAM_INT);
        $sql->bindValue("fechaAprobacion",!empty($fechaAprobacion) ? $fechaAprobacion : null, PDO::PARAM_STR);

      $sql->execute();
  
      if($sql->rowCount() > 0){
        if($concepto=="Colegiatura" && isset($_POST['mesColegiatura'])){
          if($estatusPago=="Aceptado"){
            $lastIdPago = $connection->lastInsertId();
            
            $query = $connection->prepare("SELECT * FROM `colegiaturas".$cicloEscolar."` WHERE idAlumno=:idAlumno");
            $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
            $query->execute();
            if ($query->rowCount() > 0) {//Busca si el alumno ya tiene un renglón de colegiaturas, si sí, actualiza el renglón con la información 
              $query = "UPDATE `colegiaturas".$cicloEscolar."`
                SET 
                `".$mesColegiatura."`    = :monto
              WHERE `idAlumno` = :idAlumno";
              $sql = $connection->prepare($query);
              $sql->bindParam("monto", $montoConcat, PDO::PARAM_STR);
              $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);

              $result2 = $sql->execute();
              $lastIdColegiatura = $connection->lastInsertId();

              if ($result2) {
                $query = "UPDATE pagos SET `idColegiatura` = :idColegiatura WHERE `idPago` = :idPago";
                $sql = $connection->prepare($query);
                $sql->bindParam(":idColegiatura", $lastIdColegiatura, PDO::PARAM_INT);
                $sql->bindParam(":idPago", $lastIdPago, PDO::PARAM_INT);
                $sql->execute();
              }
            }else{
              $query = $connection->prepare(//si el alumno no tiene un renglón ya registrado, lo registra
                "INSERT INTO `colegiaturas".$cicloEscolar."` (`idAlumno`,`alumno`,`".$mesColegiatura."`) 
                VALUES          (:idAlumno,:alumno,:monto)");
              $query->bindParam(":idAlumno", $idAlumno, PDO::PARAM_INT);
              $query->bindParam(":alumno", $alumno, PDO::PARAM_STR);
              $query->bindParam(":monto", $montoConcat, PDO::PARAM_STR);

              $result2 = $query->execute();
              $lastIdColegiatura = $connection->lastInsertId();

              if ($result2) {
                $query = "UPDATE pagos SET `idColegiatura` = :idColegiatura WHERE `idPago` = :idPago";
                $sql = $connection->prepare($query);
                $sql->bindParam(":idColegiatura", $lastIdColegiatura, PDO::PARAM_INT);
                $sql->bindParam(":idPago", $lastIdPago, PDO::PARAM_INT);
                $sql->execute();
              }
            }
            if ($result2) {
              if (trim($_POST['comprobante'])!="") {
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'comprobanteNombre' => $comprobante,
                    'message' => 'La colegiatura se ha agregado correctamente.'
                  )
                );
              }else{
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'comprobanteNombre' => "",
                    'message' => 'La colegiatura se ha agregado correctamente.'
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
          }else{
            if (trim($_POST['comprobante'])!="") {
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'comprobanteNombre' => $comprobante,
                  'message' => 'El registro se ha agregado correctamente.'
                )
              );
            }else{
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'comprobanteNombre' => "",
                  'message' => 'El registro se ha agregado correctamente.'
                )
              );
            }
          }
        }else{
          if (trim($_POST['comprobante'])!="") {
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'comprobanteNombre' => $comprobante,
                'message' => 'El registro se ha agregado correctamente.'
              )
            );
          }else{
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'comprobanteNombre' => "",
                'message' => 'El registro se ha agregado correctamente.'
              )
            );
          }
        }
      }else{
        $jsonresult = array(
          'response' => array(
            'status' => 'error',
            'code' => '1',
            'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
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
  }elseif ($accion=="delete") {
    /*<!-------------------------DELETE PHP------------------------->*/
    
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