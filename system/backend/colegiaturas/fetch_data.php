<?php
	include '../../../build/config.php';
	session_start();
  if(isset($_POST['get_option'])&&$_POST['get_option']!=""){
    $cicloEscolar = $_POST['get_option'];
    ## Fetch records
    $stmt = $connection->prepare('SHOW fields FROM `colegiaturas'.$cicloEscolar.'` ;');
    // SHOW COLUMNS FROM instituto_alumno.`colegiaturas2021-2022` ;
    $stmt->execute();
    $empRecords = $stmt->fetchAll();

    foreach($empRecords as $row){
      echo ("<th>".$row['Field']."</th>");
    }
    exit;

  }
?>