<?php
	include '../../../build/config.php';
  session_start();
  if(isset($_POST['get_option'])){
    $cicloEscolar = $_POST['get_option'];
    ## Fetch records
    $stmt = $connection->prepare('SHOW fields FROM `colegiaturas'.$cicloEscolar.'` WHERE Field LIKE "%20%" AND Field NOT LIKE "%colegiaturas%";');

    $stmt->execute();
    $empRecords = $stmt->fetchAll();

    echo ("<option></option>");
    foreach($empRecords as $row){
      echo ("<option>".$row['Field']."</option>");
    }
    exit;
    // $state = $_POST['get_option'];
    // $find=mysql_query("select city from places where state='$state'");
    // while($row=mysql_fetch_array($find))
    // {
    //   echo "<option>".$row['city']."</option>";
    // }
    // exit;

  }
?>