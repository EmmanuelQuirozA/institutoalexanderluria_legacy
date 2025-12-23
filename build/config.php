<?php
  date_default_timezone_set('America/Mexico_City');

  //Conexión a DB SERVER PRODUCT--------------------------------------------------------------------------------------------------------------------
  $server = "193.203.166.220";
  $dbusername = "u714374949_institutoBckup";
  $dbpassword = "MonarchSIAL23042021$$$$";
  $dbname = "u714374949_institutoBckup";

  // Create connection
  try{
    $connection = new PDO("mysql:host=$server;dbname=$dbname","$dbusername","$dbpassword");
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
    die('Imposible conectar con base de datos!!');
  }
?>