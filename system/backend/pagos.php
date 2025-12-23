<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);

  if ($accion=="createPago") {
    
    if(isset($_POST['alumno'])){
      
      $idAlumno = trim($_POST['alumno']);
      $alumno = trim($_POST['alumno']);
      $idUsuario = $_SESSION['idUsuario'];
      $nivelEscolar = trim($_POST['nivelEscolar']);
      $gradoyGrupo = trim($_POST['gradoyGrupo']);
      $cicloEscolar = trim($_POST['cicloEscolar']);
      $referencia = trim($_POST['referencia']);
      $concepto = trim($_POST['concepto']);

      $monto = ucwords(mb_strtolower(trim($_POST['monto'])));
      $fechaRegistro = date("Y/m/d");
      $fechaPago = trim($_POST['fechaPago']);
      $formaPago = ucwords(mb_strtolower(trim($_POST['formaPago'])));
      $folio = ucwords(mb_strtolower(trim($_POST['folio'])));
      $estatusPago = trim($_POST['estatusPago']);
      $observaciones = trim($_POST['observaciones']);
      
      $comprobante = ucwords(mb_strtolower(trim($_POST['comprobante'])));
      
      if (trim($_POST['comprobante'])!="") {
        $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
        $comprobante ="../../../archivos/comprobantesPago/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$alumno)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
      }

      
      try{
        $query = $connection->prepare("SELECT * FROM pagos WHERE fechaRegistro=:fechaRegistro and idAlumno=:idAlumno and concepto=:concepto");
        $query->bindParam("fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
        $query->bindParam("idAlumno", $alumno, PDO::PARAM_STR);
        $query->bindParam("concepto", $concepto, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos esta información'
            )
          );
        }else{
          $query = $connection->prepare(
            "INSERT INTO pagos(idAlumno,idUsuario,nivelEscolar,gradoyGrupo,cicloEscolar,referencia,concepto,monto,fechaRegistro,fechaPago,formaPago,folio,observaciones,estatusPago,comprobante) 
            VALUES (:idAlumno,:idUsuario,:nivelEscolar,:gradoyGrupo,:cicloEscolar,:referencia,:concepto,:monto,:fechaRegistro,:fechaPago,:formaPago,:folio,:observaciones,:estatusPago,:comprobante)");
          $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $query->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
          $query->bindParam("nivelEscolar", $nivelEscolar, PDO::PARAM_STR);
          $query->bindParam("gradoyGrupo", $gradoyGrupo, PDO::PARAM_STR);
          $query->bindParam("cicloEscolar", $cicloEscolar, PDO::PARAM_STR);
          $query->bindParam("referencia", $referencia, PDO::PARAM_STR);
          $query->bindParam("concepto", $concepto, PDO::PARAM_STR);
          $query->bindParam("monto", $monto, PDO::PARAM_STR);
          $query->bindParam("fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
          $query->bindParam("fechaPago", $fechaPago, PDO::PARAM_STR);
          $query->bindParam("formaPago", $formaPago, PDO::PARAM_STR);
          $query->bindParam("folio", $folio, PDO::PARAM_STR);
          $query->bindValue("estatusPago",!empty($estatusPago) ? $estatusPago : 'Sin aprobar', PDO::PARAM_STR);
          $query->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
          $query->bindParam("comprobante", $comprobante, PDO::PARAM_STR);
          $result = $query->execute();
      
          if($result){
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
  }elseif ($accion=="updatePago") {
    if(isset($_POST['alumno'])){
      $alumno = $_POST['idAlumno']." - ".trim($_POST['alumno']);
      $concepto = trim($_POST['concepto']);
      $fechaRegistro = trim($_POST['fechaRegistro']);
      
      $idPago = trim($_POST['idPago']);
      $referencia = trim($_POST['referencia']);
      $monto = trim($_POST['monto']);
      $fechaPago = trim($_POST['fechaPago']);
      $formaPago = trim($_POST['formaPago']);
      $observaciones = trim($_POST['observaciones']);
      $folio = trim($_POST['folio']);
      $estatusPago = trim($_POST['estatusPago']);
      $comprobante = trim($_POST['comprobante']);
      
      
      
      if ($estatusPago!="Sin aprobar") {
        $idUsuarioAprobo = $_SESSION['idUsuario'];
        $fechaAprobacion = date("Y/m/d");
      }else{
        $idUsuarioAprobo = "";
        $fechaAprobacion = "";
      }

      
      if (trim($_POST['comprobante'])!="") {
        $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
        $comprobante ="../../../archivos/comprobantesPago/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$alumno)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
      }

      
      try{
        $query = "UPDATE pagos 
        SET 
        `referencia` = :referencia,
        `monto` = :monto,
        `fechaPago` = :fechaPago,
        `formaPago` = :formaPago,
        `observaciones` = :observaciones,
        `folio` = :folio,
        `estatusPago` = :estatusPago,
        `comprobante` = :comprobante,
        `idUsuarioAprobo` = :idUsuarioAprobo,
        `fechaAprobacion` = :fechaAprobacion
        WHERE `idPago` = :idPago";
        $sql = $connection->prepare($query);
        $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
        $sql->bindParam("monto", $monto, PDO::PARAM_STR);
        $sql->bindParam("fechaPago", $fechaPago, PDO::PARAM_STR);
        $sql->bindParam("formaPago", $formaPago, PDO::PARAM_STR);
        $sql->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
        $sql->bindParam("folio", $folio, PDO::PARAM_STR);
        $sql->bindParam("estatusPago", $estatusPago, PDO::PARAM_STR);
        $sql->bindParam("comprobante", $comprobante, PDO::PARAM_STR);
        $sql->bindParam("idPago", $idPago, PDO::PARAM_INT);
        $sql->bindValue("idUsuarioAprobo",!empty($idUsuarioAprobo) ? $idUsuarioAprobo : null, PDO::PARAM_INT);
        $sql->bindValue("fechaAprobacion",!empty($fechaAprobacion) ? $fechaAprobacion : null, PDO::PARAM_STR);

      $sql->execute();
  
      if($sql->rowCount() > 0){
        $idColegiatura = trim($_POST['idColegiatura']);
        $lastIdPago=$idPago;
        $idAlumno = $_POST['idAlumno'];
        $cicloEscolar = $_POST['cicloEscolar'];
        $mesColegiatura = trim($_POST["mesColegiatura"]);
        $montoConcat = $monto." | ".$fechaPago;
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
            if ($mesColegiatura!="") {
              $query = "UPDATE `colegiaturas".$cicloEscolar."` SET `".$mesColegiatura."` = NULL WHERE idAlumno = :idAlumno";
              $sql = $connection->prepare($query);
              $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
        
              $result = $sql->execute();
              $jsonresult = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '0',
                  'message' => "El registro y la colegiatura se han eliminado correctamente."
                )
              );
            } else {
              # code...
            }
            
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
  }elseif ($accion=="deleteRecargSaldo") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idRecargasSaldo'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idRecargasSaldo=trim($_POST['idRecargasSaldo']);
      $tipoPersona=trim($_POST['tipoPersona']);
      $idPersona=0;
      $monto=0;
      $saldo=0;
      $flag=false;
      try{
          // SE OBTIENE EL idPersona DE LA TABLA DE RECARGAS Y EL MONTO POR ELIMINAR PARA RESTARLO AL SALDO DE LA PERSONA
          $sql = $connection->prepare("SELECT * FROM recargas_saldo WHERE `idRecargasSaldo` = :idRecargasSaldo");
          $sql->bindParam('idRecargasSaldo', $idRecargasSaldo,PDO::PARAM_INT);
          $sql->execute();
          $results=$sql->fetchAll();
          foreach ($results as $output){
            $idPersona=$output["idPersona"];
            $monto=$output["monto"];
          }
          if ($tipoPersona=="Alumno") {
            // SE OBTIENE EL SALDO DEL ALUMNO PARA RESTARLE EL MONTO A ELIMINAR
            $sql = $connection->prepare("SELECT * FROM alumnos WHERE `idPersona` = :idPersona");
            $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
            $sql->execute();
            $results=$sql->fetchAll();
            foreach ($results as $output){
              $saldo=$output["saldo"];
            }
            $saldo=$saldo-$monto;

            // SE ACTUALIZA EL SALDO
            $sql = $connection->prepare("UPDATE `alumnos` SET `saldo` = :saldo WHERE idPersona=:idPersona");
            $sql->bindParam('saldo', $saldo,PDO::PARAM_STR);
            $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
            $sql->execute();
        
            if($sql->rowCount() > 0){
              $flag=true;
            }else{
              $flag=false;
            }
          } else {
            // SE OBTIENE EL SALDO DEL trabajador PARA RESTARLE EL MONTO A ELIMINAR
            $sql = $connection->prepare("SELECT * FROM trabajadores WHERE `idPersona` = :idPersona");
            $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
            $sql->execute();
            $results=$sql->fetchAll();
            foreach ($results as $output){
              $saldo=$output["saldo"];
            }
            $saldo=$saldo-$monto;

            // SE ACTUALIZA EL SALDO
            $sql = $connection->prepare("UPDATE `trabajadores` SET `saldo` = :saldo WHERE idPersona=:idPersona");
            $sql->bindParam('saldo', $saldo,PDO::PARAM_STR);
            $sql->bindParam('idPersona', $idPersona,PDO::PARAM_INT);
        
            $sql->execute();
        
            if($sql->rowCount() > 0){
              $flag=true;
            }else{
              $flag=false;
            }
          }
          
        
        /*<!-------------------------deleteuser TABLE------------------------->*/
        if ($flag=true) {
          $sql = $connection->prepare("DELETE FROM `recargas_saldo` WHERE `idRecargasSaldo` = :idRecargasSaldo");
          $sql->bindParam('idRecargasSaldo', $idRecargasSaldo,PDO::PARAM_INT);
          
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
        } else {
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
  }elseif ($accion=="deletePago") {
    /*<!-------------------------DELETE PHP------------------------->*/
    if(isset($_POST['idPago'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idPago=trim($_POST['idPago']);
      $idAlumno =$_POST['idAlumno'];
      $mesColegiatura =$_POST['mesColegiatura'];
      $cicloEscolar =$_POST['cicloEscolar'];
      
      /*<!-------------------------deleteuser TABLE------------------------->*/
      try{
        $sql = $connection->prepare( 
          "DELETE FROM `pagos` WHERE `idPago` = :idPago");
        $sql->bindParam('idPago', $idPago,PDO::PARAM_INT);
        
        $sql->execute();
        
        if($sql){
          if($mesColegiatura!=""){
            $query = "UPDATE `colegiaturas".$cicloEscolar."` SET `".$mesColegiatura."` = NULL WHERE idAlumno = :idAlumno";
            $sql = $connection->prepare($query);
            $sql->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
      
            $result = $sql->execute();
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => "El registro y la colegiatura se han eliminado correctamente."
              )
            );
          }else{
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'El registro se ha eliminado correctamente.'
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