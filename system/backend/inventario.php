<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="createInventario"){
    $descripcion = trim($_POST['descripcion']);
    $existencia = 0;
    $unidad = trim($_POST['unidad']);
    $precioCompra = trim($_POST['precioCompra']);
    $precioSugerido = trim($_POST['precioSugerido']);
    $fechaAlta = date("Y-m-d");
    $idUsuario = $_SESSION['idUsuario'];
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['descripcion']) && isset($_POST['unidad']) && isset($_POST['precioCompra']) && isset($_POST['precioSugerido'])){
  
      try{
        $query = $connection->prepare("SELECT * FROM inventario WHERE descripcion=:descripcion AND unidad=:unidad");
        $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
        $query->bindParam("unidad", $unidad, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos datos.'
            )
          );
        }else{
          $query = $connection->prepare(
            "INSERT INTO inventario(descripcion,existencia,unidad,precioCompra,precioSugerido,fechaAlta,idUsuario)
            VALUES      (:descripcion,:existencia,:unidad,:precioCompra,:precioSugerido,:fechaAlta,:idUsuario)");
          $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
          $query->bindParam("existencia", $existencia, PDO::PARAM_INT);
          $query->bindParam("unidad", $unidad, PDO::PARAM_STR);
          $query->bindParam("precioCompra", $precioCompra, PDO::PARAM_STR);
          $query->bindParam("precioSugerido", $precioSugerido, PDO::PARAM_STR);
          $query->bindParam("fechaAlta", $fechaAlta, PDO::PARAM_STR);
          $query->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
          $result = $query->execute();
  
          if($result){
            $jsonresult = array(
              'response' => array(
                'status' => 'success',
                'code' => '0',
                'message' => 'Registro agregado al inventario correctamente.'
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
  }elseif ($accion=="createEntrada") {
    $idInventario = trim($_POST['idInventario']);
    // $idEgreso = 0;
    $idUsuario = $_SESSION['idUsuario'];
    $fechaEntrada = date("Y-m-d");
    $cantidad = trim($_POST['cantidad']);
    $costoUnitario = trim($_POST['costoUnitario']);
    $proveedor = trim($_POST['proveedor']);
    $observaciones = trim($_POST['observaciones']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idInventario']) && isset($_POST['cantidad']) && isset($_POST['costoUnitario'])){
  
      try{
        $query = $connection->prepare("SELECT * FROM inventario WHERE descripcion=:descripcion AND unidad=:unidad");
        $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
        $query->bindParam("unidad", $unidad, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos datos.'
            )
          );
        }else{
          $query=$connection->prepare("SELECT * FROM inventario WHERE idInventario=:idInventario");
          $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
          $query->execute();
          $result=$query->fetchAll();
        
          if (!$result) {
            $jsonresult = array(
              'response' => array(
                'status' => 'error',
                'code' => '5',
                'message' => 'No se encuentra el artículo en el inventario.'
              )
            );
          }else{
            foreach ($result as $output){
              $existenciaActual=$output["existencia"];
              $unidad=$output["unidad"];
            }

            $query = $connection->prepare(
              "INSERT INTO entradas(idInventario,idUsuario,fechaEntrada,cantidad,costoUnitario,proveedor,observaciones)
              VALUES      (:idInventario,:idUsuario,:fechaEntrada,:cantidad,:costoUnitario,:proveedor,:observaciones)");
            $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
            $query->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
            $query->bindParam("fechaEntrada", $fechaEntrada, PDO::PARAM_STR);
            $query->bindParam("cantidad", $cantidad, PDO::PARAM_STR);
            $query->bindParam("costoUnitario", $costoUnitario, PDO::PARAM_STR);
            $query->bindParam("proveedor", $proveedor, PDO::PARAM_STR);
            $query->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
            $result = $query->execute();
    
            if($result){
              $nuevaExistencia = $existenciaActual+$cantidad;
              $query = "UPDATE inventario 
                SET 
                `existencia`      		= :existencia
                WHERE `idInventario`   = :idInventario";
                $sql = $connection->prepare($query);
                $sql->bindParam("existencia", $nuevaExistencia, PDO::PARAM_STR);
                $sql->bindParam("idInventario", $idInventario, PDO::PARAM_INT);

              $sql->execute();
          
              if($sql->rowCount() > 0){
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'message' => 'Entrada registrada. Se han agregado '.$cantidad.' '.$unidad.' al inventario.'
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
                  'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
                )
              );
            }
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
  }elseif ($accion=="createSalida") {
    $idInventario = trim($_POST['idInventario']);
    $idUsuario = $_SESSION['idUsuario'];
    $idAlumno = trim($_POST['idAlumno']);
    $fechaSalida = date("Y-m-d");
    $cantidad = trim($_POST['cantidad']);
    $costoUnitario = trim($_POST['costoUnitario']);
    $observaciones = trim($_POST['observaciones']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idInventario']) && isset($_POST['cantidad']) && isset($_POST['costoUnitario'])){

      try{
        $query = $connection->prepare("SELECT * FROM inventario WHERE descripcion=:descripcion AND unidad=:unidad");
        $query->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
        $query->bindParam("unidad", $unidad, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '5',
              'message' => 'Ya existe un registro con estos datos.'
            )
          );
        }else{
          $query=$connection->prepare("SELECT * FROM inventario WHERE idInventario=:idInventario");
          $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
          $query->execute();
          $resultInventario=$query->fetchAll();

          $query=$connection->prepare("SELECT * FROM alumnos WHERE idAlumno=:idAlumno");
          $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
          $query->execute();
          $resultAlumno=$query->fetchAll();

          if (!$resultInventario||(!$resultAlumno&&$idAlumno)) {
            if (!$resultInventario) {
              $jsonresult = array(
                'response' => array(
                  'status' => 'error',
                  'code' => '5',
                  'message' => 'No se encuentra el artículo en el inventario.'
                )
              );
            } else if(!$resultAlumno&&$idAlumno) {
              $jsonresult = array(
                'response' => array(
                  'status' => 'error',
                  'code' => '5',
                  'message' => 'No se encuentra el alumno.'
                )
              );
            }
          }else{
            foreach ($resultInventario as $output){
              $existenciaActual=$output["existencia"];
              $unidad=$output["unidad"];
            }

            $query = $connection->prepare(
              "INSERT INTO salidas(idInventario,idUsuario,idAlumno,fechaSalida,cantidad,costoUnitario,observaciones)
              VALUES      (:idInventario,:idUsuario,:idAlumno,:fechaSalida,:cantidad,:costoUnitario,:observaciones)");
            $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
            $query->bindParam("idUsuario", $idUsuario, PDO::PARAM_INT);
            $query->bindParam("idAlumno", $idAlumno, PDO::PARAM_INT);
            $query->bindParam("fechaSalida", $fechaSalida, PDO::PARAM_STR);
            $query->bindParam("cantidad", $cantidad, PDO::PARAM_STR);
            $query->bindParam("costoUnitario", $costoUnitario, PDO::PARAM_STR);
            $query->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
            $result = $query->execute();
    
            if($result){
              $nuevaExistencia = $existenciaActual-$cantidad;
              $query = "UPDATE inventario 
                SET 
                `existencia`      		= :existencia
                WHERE `idInventario`   = :idInventario";
                $sql = $connection->prepare($query);
                $sql->bindParam("existencia", $nuevaExistencia, PDO::PARAM_STR);
                $sql->bindParam("idInventario", $idInventario, PDO::PARAM_INT);

              $sql->execute();
          
              if($sql->rowCount() > 0){
                $jsonresult = array(
                  'response' => array(
                    'status' => 'success',
                    'code' => '0',
                    'message' => 'Salida registrada. Se han restado '.$cantidad.' '.$unidad.' al inventario.'
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
                  'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
                )
              );
            }
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
  }elseif ($accion=="updateInventario") {
    $idInventario = trim($_POST['idInventario']);
    $descripcion = trim($_POST['descripcion']);
    $unidad = trim($_POST['unidad']);
    $precioCompra = trim($_POST['precioCompra']);
    $precioSugerido = trim($_POST['precioSugerido']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idInventario']) && isset($_POST['unidad']) && isset($_POST['precioCompra']) && isset($_POST['precioSugerido'])){

      try{
        $query = "UPDATE inventario 
            SET 
            `descripcion` = :descripcion,
            `unidad` = :unidad,
            `precioCompra` = :precioCompra,
            `precioSugerido` = :precioSugerido
            WHERE `idInventario`   = :idInventario";
            $sql = $connection->prepare($query);
            $sql->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
            $sql->bindParam("unidad", $unidad, PDO::PARAM_STR);
            $sql->bindParam("precioCompra", $precioCompra, PDO::PARAM_STR);
            $sql->bindParam("precioSugerido", $precioSugerido, PDO::PARAM_STR);
            $sql->bindParam("idInventario", $idInventario, PDO::PARAM_INT);

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
  }elseif ($accion=="updateEntrada") {
    $idEntrada = trim($_POST['idEntrada']);
    $idInventario = trim($_POST['idInventario']);
    $costoUnitario = trim($_POST['costoUnitario']);
    $proveedor = trim($_POST['proveedor']);
    $observaciones = trim($_POST['observaciones']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idEntrada']) && isset($_POST['idInventario']) && isset($_POST['costoUnitario'])){

      try{
        $query = "UPDATE entradas 
            SET 
            `costoUnitario` = :costoUnitario,
            `proveedor` = :proveedor,
            `observaciones` = :observaciones
            WHERE `idEntrada`   = :idEntrada";
            $sql = $connection->prepare($query);
            $sql->bindParam("costoUnitario", $costoUnitario, PDO::PARAM_STR);
            $sql->bindParam("proveedor", $proveedor, PDO::PARAM_STR);
            $sql->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
            $sql->bindParam("idEntrada", $idEntrada, PDO::PARAM_INT);

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
  }elseif ($accion=="updateSalida") {
    $idSalida = trim($_POST['idSalida']);
    $idInventario = trim($_POST['idInventario']);
    $costoUnitario = trim($_POST['costoUnitario']);
    $observaciones = trim($_POST['observaciones']);
    /*<!-------------------------REGISTER PHP------------------------->*/
    if(isset($_POST['idSalida']) && isset($_POST['idInventario']) && isset($_POST['costoUnitario'])){

      try{
        $query = "UPDATE salidas 
            SET 
            `costoUnitario` = :costoUnitario,
            `observaciones` = :observaciones
            WHERE `idSalida`   = :idSalida";
            $sql = $connection->prepare($query);
            $sql->bindParam("costoUnitario", $costoUnitario, PDO::PARAM_STR);
            $sql->bindParam("observaciones", $observaciones, PDO::PARAM_STR);
            $sql->bindParam("idSalida", $idSalida, PDO::PARAM_INT);

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
  }elseif ($accion=="deleteInventario") {
    /*<!-------------------------DELETE PHP------------------------->*/
    $idInventario=trim($_POST['idInventario']);
    try{
      $query = $connection->prepare("SELECT * FROM entradas WHERE idInventario=:idInventario");
      $query->bindParam("idInventario", $idInventario, PDO::PARAM_STR);
      $query->execute();
    
      if ($query->rowCount() == 0) {
        $query = $connection->prepare("SELECT * FROM salidas WHERE idInventario=:idInventario");
        $query->bindParam("idInventario", $idInventario, PDO::PARAM_STR);
        $query->execute();
      
        if ($query->rowCount() == 0) {
          $sql = $connection->prepare("DELETE FROM `inventario` WHERE `idInventario` = :idInventario");
          $sql->bindParam('idInventario', $idInventario,PDO::PARAM_INT);
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
        }else{
          $jsonresult = array(
            'response' => array(
              'status' => 'error',
              'code' => '1',
              'message' => 'No puedes eliminar este registro, ya que cuenta con salidas registradas.'
            )
          );
        }
      }else{
        $jsonresult = array(
          'response' => array(
            'status' => 'error',
            'code' => '1',
            'message' => 'No puedes eliminar este registro, ya que cuenta con entradas registradas.'
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
  }elseif ($accion=="deleteEntrada") {
    /*<!-------------------------DELETE PHP------------------------->*/
    $idEntrada=trim($_POST['idEntrada']);
    $idInventario=trim($_POST['idInventario']);
    try{

      $query=$connection->prepare("SELECT * FROM inventario WHERE idInventario=:idInventario");
      $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
      $query->execute();
      $resultInventario=$query->fetchAll();
      if ($resultInventario) {
        foreach ($resultInventario as $output){
          $existenciaActual=$output["existencia"];
          $unidad=$output["unidad"];
        }
      }

      $query=$connection->prepare("SELECT * FROM entradas WHERE idEntrada=:idEntrada");
      $query->bindParam("idEntrada", $idEntrada, PDO::PARAM_INT);
      $query->execute();
      $resultEntrada=$query->fetchAll();
      if ($resultEntrada) {
        foreach ($resultEntrada as $output){
          $cantidadEntrada=$output["cantidad"];
        }
      }
      if ($resultInventario&&$resultEntrada) {
        $nuevaExistencia=$existenciaActual-$cantidadEntrada;
        $query = "UPDATE inventario 
        SET 
        `existencia`      		= :existencia
        WHERE `idInventario`   = :idInventario";
        $sql = $connection->prepare($query);
        $sql->bindParam("existencia", $nuevaExistencia, PDO::PARAM_STR);
        $sql->bindParam("idInventario", $idInventario, PDO::PARAM_INT);

        $sql->execute();
    
        if($sql->rowCount() > 0){
          $sql = $connection->prepare("DELETE FROM `entradas` WHERE `idEntrada` = :idEntrada");
          $sql->bindParam('idEntrada', $idEntrada,PDO::PARAM_INT);
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
              'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
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
  }elseif ($accion=="deleteSalida") {
    /*<!-------------------------DELETE PHP------------------------->*/
    $idSalida=trim($_POST['idSalida']);
    $idInventario=trim($_POST['idInventario']);
    try{

      $query=$connection->prepare("SELECT * FROM inventario WHERE idInventario=:idInventario");
      $query->bindParam("idInventario", $idInventario, PDO::PARAM_INT);
      $query->execute();
      $resultInventario=$query->fetchAll();
      if ($resultInventario) {
        foreach ($resultInventario as $output){
          $existenciaActual=$output["existencia"];
          $unidad=$output["unidad"];
        }
      }

      $query=$connection->prepare("SELECT * FROM salidas WHERE idSalida=:idSalida");
      $query->bindParam("idSalida", $idSalida, PDO::PARAM_INT);
      $query->execute();
      $resultSalida=$query->fetchAll();
      if ($resultSalida) {
        foreach ($resultSalida as $output){
          $cantidadSalida=$output["cantidad"];
        }
      }
      if ($resultInventario&&$resultSalida) {
        $nuevaExistencia=$existenciaActual+$cantidadSalida;
        $query = "UPDATE inventario 
        SET 
        `existencia`      		= :existencia
        WHERE `idInventario`   = :idInventario";
        $sql = $connection->prepare($query);
        $sql->bindParam("existencia", $nuevaExistencia, PDO::PARAM_STR);
        $sql->bindParam("idInventario", $idInventario, PDO::PARAM_INT);

        $sql->execute();
    
        if($sql->rowCount() > 0){
          $sql = $connection->prepare("DELETE FROM `salidas` WHERE `idSalida` = :idSalida");
          $sql->bindParam('idSalida', $idSalida,PDO::PARAM_INT);
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
              'message' => 'Algo salió mal ó no se realizaron cambios. ¡Intenta de nuevo!'
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
        'code' => '1',
        'message' => '¡Error 555!'
      )
    );
  }



  echo json_encode($jsonresult);
?>