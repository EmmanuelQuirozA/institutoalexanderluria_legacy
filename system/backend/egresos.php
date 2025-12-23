<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);

  if ($accion=="create") {
    
    if(isset($_POST['receptor'])&&isset($_POST['concepto'])){

      $referencia = trim($_POST['referencia']);
      $receptor = trim($_POST['receptor']);
      $concepto = trim($_POST['concepto']);
      $tipoGasto = trim($_POST['tipoGasto']);
      $precioUnitario = trim($_POST['precioUnitario']);
      $cantidad = trim($_POST['cantidad']);
      $total = floatval($precioUnitario)*floatval($cantidad);
      $unidad = trim($_POST['unidad']);
      $fechaRegistro = date("Y/m/d");
      $fechaPago = trim($_POST['fechaPago']);
      $formaPago = trim($_POST['formaPago']);
      $observaciones = trim($_POST['observaciones']);
      $folio = trim($_POST['folio']);
      $estatusEgreso = trim($_POST['estatusEgreso']);
      
      $comprobante = trim($_POST['comprobante']);
      
      if (trim($_POST['comprobante'])!="") {
        $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
        $comprobante ="../../../archivos/comprobantesEgreso/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$receptor)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
      }
      $idUsuario = $_SESSION['idUsuario'];
      if ($estatusEgreso!="Sin aprobar") {
        $fechaAprobado = date("Y/m/d");
      }else{
        $fechaAprobado = "";
      }

      try{
        $query = $connection->prepare("SELECT * FROM egresos WHERE fechaRegistro=:fechaRegistro and receptor=:receptor and concepto=:concepto");
        $query->bindParam("fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
        $query->bindParam("receptor", $receptor, PDO::PARAM_STR);
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
            "INSERT INTO egresos(referencia,receptor,concepto,tipoGasto,precioUnitario,cantidad,total,unidad,fechaRegistro,fechaPago,formaPago,observaciones,folio,estatusEgreso,comprobante,idUsuario,fechaAprobado) 
            VALUES (:referencia,:receptor,:concepto,:tipoGasto,:precioUnitario,:cantidad,:total,:unidad,:fechaRegistro,:fechaPago,:formaPago,:observaciones,:folio,:estatusEgreso,:comprobante,:idUsuario,:fechaAprobado)");

          $query->bindParam("referencia", $referencia, PDO::PARAM_STR);
          $query->bindParam("receptor", $receptor, PDO::PARAM_STR);
          $query->bindParam("concepto", $concepto, PDO::PARAM_STR);
          $query->bindParam("tipoGasto", $tipoGasto, PDO::PARAM_STR);
          $query->bindParam("precioUnitario", $precioUnitario, PDO::PARAM_STR);
          $query->bindParam("cantidad", $cantidad, PDO::PARAM_STR);
          $query->bindParam("total", $total, PDO::PARAM_STR);
          $query->bindParam("unidad", $unidad, PDO::PARAM_STR);
          $query->bindParam("fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
          $query->bindValue("fechaPago",!empty($fechaPago) ? $fechaPago : null, PDO::PARAM_STR);
          $query->bindParam("formaPago", $formaPago, PDO::PARAM_STR);
          $query->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
          $query->bindParam("folio", $folio, PDO::PARAM_STR);
          $query->bindValue("estatusEgreso",!empty($estatusEgreso) ? $estatusEgreso : "Sin aprobar", PDO::PARAM_STR);
          $query->bindParam("comprobante", $comprobante, PDO::PARAM_STR);
          $query->bindParam("idUsuario", $idUsuario, PDO::PARAM_STR);
          $query->bindValue("fechaAprobado",!empty($fechaAprobado) ? $fechaAprobado : null, PDO::PARAM_STR);
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

  }elseif ($accion=="update") {
    if(isset($_POST['idEgreso'])){

      $idEgreso = trim($_POST['idEgreso']);
      $referencia = trim($_POST['referencia']);
      $receptor = trim($_POST['receptor']);
      $concepto = trim($_POST['concepto']);
      $tipoGasto = trim($_POST['tipoGasto']);
      $precioUnitario = trim($_POST['precioUnitario']);
      $cantidad = trim($_POST['cantidad']);
      $total = floatval($precioUnitario)*floatval($cantidad);
      $unidad = trim($_POST['unidad']);
      $fechaRegistro = trim($_POST['fechaRegistro']);
      $fechaPago = trim($_POST['fechaPago']);
      $formaPago = trim($_POST['formaPago']);
      $observaciones = trim($_POST['observaciones']);
      $folio = trim($_POST['folio']);
      $estatusEgreso = trim($_POST['estatusEgreso']);
      $comprobante = trim($_POST['comprobante']);
      // $idUsuario = trim($_POST['idUsuario']);
      // $fechaAprobado = trim($_POST['fechaAprobado']);

      if ($estatusEgreso!="Sin aprobar") {
        $fechaAprobado = date("Y/m/d");
      }else{
        $fechaAprobado = "";
      }

      $comprobante = ucwords(mb_strtolower(trim($_POST['comprobante'])));
      
      if (trim($_POST['comprobante'])!="") {
        $comprobanteExtensiom = substr(strrchr($comprobante, '.'), 1);
        $comprobante ="../../../archivos/comprobantesEgreso/".str_replace("/","_",$fechaRegistro)."_".str_replace(" ","_",$receptor)."_".str_replace(" ","",$concepto).".".$comprobanteExtensiom;
      }

      
      try{
        $query = "UPDATE egresos 
        SET 
        `referencia` = :referencia,
        `receptor` = :receptor,
        `concepto` = :concepto,
        `tipoGasto` = :tipoGasto,
        `precioUnitario` = :precioUnitario,
        `cantidad` = :cantidad,
        `total` = :total,
        `unidad` = :unidad,
        `fechaRegistro` = :fechaRegistro,
        `fechaPago` = :fechaPago,
        `formaPago` = :formaPago,
        `observaciones` = :observaciones,
        `folio` = :folio,
        `estatusEgreso` = :estatusEgreso,
        `comprobante` = :comprobante,
        `fechaAprobado` = :fechaAprobado
        WHERE `idEgreso` = :idEgreso";
        $sql = $connection->prepare($query);
        $sql->bindParam("referencia", $referencia, PDO::PARAM_STR);
        $sql->bindParam("receptor", $receptor, PDO::PARAM_STR);
        $sql->bindParam("concepto", $concepto, PDO::PARAM_STR);
        $sql->bindParam("tipoGasto", $tipoGasto, PDO::PARAM_STR);
        $sql->bindParam("precioUnitario", $precioUnitario, PDO::PARAM_STR);
        $sql->bindParam("cantidad", $cantidad, PDO::PARAM_INT);
        $sql->bindParam("total", $total, PDO::PARAM_STR);
        $sql->bindParam("unidad", $unidad, PDO::PARAM_STR);
        $sql->bindParam("fechaRegistro", $fechaRegistro, PDO::PARAM_STR);
        $sql->bindValue("fechaPago",!empty($fechaPago) ? $fechaPago : null, PDO::PARAM_STR);
        $sql->bindParam("formaPago", $formaPago, PDO::PARAM_STR);
        $sql->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
        $sql->bindParam("folio", $folio, PDO::PARAM_STR);
        $sql->bindParam("estatusEgreso", $estatusEgreso, PDO::PARAM_STR);
        $sql->bindParam("comprobante", $comprobante, PDO::PARAM_STR);
        $sql->bindValue("fechaAprobado",!empty($fechaAprobado) ? $fechaAprobado : null, PDO::PARAM_INT);
        $sql->bindParam("idEgreso", $idEgreso, PDO::PARAM_INT);

      $sql->execute();
  
      if($sql->rowCount() > 0){
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
    if(isset($_POST['idEgreso'])){
      /*<!-------------------------FORM INFORMATION SENT------------------------->*/
      $idEgreso=trim($_POST['idEgreso']);
      try{
        /*<!-------------------------deleteuser TABLE------------------------->*/
        $sql = $connection->prepare("DELETE FROM `egresos` WHERE `idEgreso` = :idEgreso");
        $sql->bindParam('idEgreso', $idEgreso,PDO::PARAM_INT);
        
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