<?php
	include '../../build/config.php';
	session_start();
  $accion=trim($_POST['accion']);
  
  if($accion=="createCicloEscolar"){
    if (
    isset($_POST['username'])&&
    isset($_POST['password'])&&
    isset($_POST['cicloEscolar'])&&
    isset($_POST['fechaInicio'])&&
    isset($_POST['fechaFin'])&&
    $_POST['username']!=""&&
    $_POST['password']!=""&&
    $_POST['cicloEscolar']!=""&&
    $_POST['fechaInicio']!=""&&
    $_POST['fechaFin']!="") {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $cicloEscolar = trim($_POST['cicloEscolar']);
      $fechaInicio = trim($_POST['fechaInicio']);
      $fechaFin = trim($_POST['fechaFin']);
      if($fechaInicio<$fechaFin){
        try {
          $query = $connection->prepare("SELECT * FROM usuarios LEFT JOIN personas on usuarios.idPersona = personas.idPersona WHERE USERNAME=:username");
          $query->bindParam("username", $username, PDO::PARAM_STR);
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
      
          if (!$result) {
            // session_destroy();
            $jsonresult = array(
              'response' => array(
                'status' => 'errorNoExiste',
                'code' => '0',
                'message' => 'Nombre de usuario no existe.'
              )
            );  
          
          }else{
            $query = $connection->prepare("SELECT * FROM ciclosescolares WHERE cicloEscolar=:cicloEscolar");
            $query->bindParam("cicloEscolar", $cicloEscolar, PDO::PARAM_STR);
            $query->execute();
      
            if ($query->rowCount() > 0) {
              $jsonresult = array(
                'response' => array(
                  'status' => 'error',
                  'code' => '5',
                  'message' => 'El ciclo escolar ya se encuentra registrado'
                )
              );
            } else {
              if (password_verify($password, $result['password'])) {
                /*CODE TO CREATE A NEW COLEGIATURAS TABLE*/
                  $start    = new DateTime($fechaInicio);
                  $start->modify('first day of this month');
                  $end      = new DateTime($fechaFin);
                  $end->modify('first day of next month');
                  $interval = DateInterval::createFromDateString('1 month');
                  $period   = new DatePeriod($start, $interval, $end);
  
                  $sql1="";
                  $sql2="";
                  $sql3="";
  
                  $array= array();
                  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                  foreach ($period as $dt) {
                    array_push($array,$meses[$dt->format("m")-1]."-".$dt->format("Y"));
                  }
                  $sql1=("CREATE TABLE `colegiaturas".$cicloEscolar."` (
                      `idcolegiaturas".$cicloEscolar."` INT NOT NULL AUTO_INCREMENT,
                      `idAlumno` VARCHAR(45) NOT NULL,
                      `alumno` VARCHAR(45) NOT NULL,");
                  $array2= array();
                  foreach ($array as $column) {
                    array_push($array2,"`".$column."` VARCHAR(45) NULL",",");
                  }
                  // array_pop($array2);  
                  foreach ($array2 as $column) {
                    $sql2= $sql2.$column;
                  }
                  $sql3=("PRIMARY KEY (`idcolegiaturas".$cicloEscolar."`),
                  UNIQUE INDEX `idcicloEscolar".$cicloEscolar."_UNIQUE` (`idcolegiaturas".$cicloEscolar."` ASC) VISIBLE);");
                  // echo($sql1." ".$sql2." ".$sql3);
  
                  $queryColegiaturas = $connection->prepare($sql1." ".$sql2." ".$sql3);
                  $resultColegiaturas = $queryColegiaturas->execute();
                /*CODE TO CREATE A NEW COLEGIATURAS TABLE*/
  
                $queryCiclosEscolares = $connection->prepare(
                  "INSERT INTO ciclosescolares(cicloEscolar,fechaInicio,fechaFin) 
                  VALUES      (:cicloEscolar,:fechaInicio,:fechaFin)");
                $queryCiclosEscolares->bindParam("cicloEscolar", $cicloEscolar, PDO::PARAM_STR);
                $queryCiclosEscolares->bindParam("fechaInicio", $fechaInicio, PDO::PARAM_STR);
                $queryCiclosEscolares->bindParam("fechaFin", $fechaFin, PDO::PARAM_STR);
                $resultCiclosEscolares = $queryCiclosEscolares->execute();
        
                if($resultCiclosEscolares&&$resultColegiaturas){
                  $jsonresult = array(
                    'response' => array(
                      'status' => 'success',
                      'code' => '1',
                      'message' => 'El ciclo escolar se ha agregado corréctamente.'
                    )
                  ); 
                }else{
                  $query = $connection->prepare(
                    "DROP TABLE IF EXISTS `colegiaturas".$cicloEscolar."`;");
                  $result = $query->execute();
                  $jsonresult = array(
                    'response' => array(
                      'status' => 'error',
                      'code' => '1',
                      'message' => 'Algo salió mal. ¡Intenta de nuevo!'
                    )
                  );   
                }
              } else {
                $jsonresult = array(
                  'response' => array(
                    'status' => 'errorNoCoincide',
                    'code' => '2',
                    'message' => 'Nombre de usuario y contraseña no coincide.'
                  )
                ); 
              }
            }
          }
        } catch (Exception $e) {
          $jsonresult = array(
            'response' => array(
              'status' => 'errorInesperado',
              'code' => '0',
              'message' => $e->getMessage()
            )
          );  
        }
      }else{
        $jsonresult = array(
          'response' => array(
            'status' => 'error',
            'code' => '3',
            'message' => 'La fecha inicial no puede ser mayor a la fecha final'
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