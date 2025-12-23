<?php

  //print_r($_FILES);
  $fileName = $_POST['pathNombre'];
  $fileType = $_FILES['file']['type'];
  $fileError = $_FILES['file']['error'];
  $fileContent = file_get_contents($_FILES['file']['tmp_name']);

  if($fileError == UPLOAD_ERR_OK){
    move_uploaded_file($_FILES["file"]["tmp_name"],$fileName);
    $jsonresult = array(
      'response' => array(
        'status' => 'success',
        'code' => '0',
        'message' => 'El material se ha subido satisfactoriamente.'
      )
    );
  }else{
    switch($fileError){
      case UPLOAD_ERR_INI_SIZE:   
        $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
        break;
      case UPLOAD_ERR_FORM_SIZE:  
        $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
        break;
      case UPLOAD_ERR_PARTIAL:    
        $message = 'Error: no terminó la acción de subir el archivo.';
        break;
      case UPLOAD_ERR_NO_FILE:    
        $message = 'Error: ningún archivo fue subido.';
        break;
      case UPLOAD_ERR_NO_TMP_DIR: 
        $message = 'Error: servidor no configurado para carga de archivos.';
        break;
      case UPLOAD_ERR_CANT_WRITE: 
        $message= 'Error: posible falla al grabar el archivo.';
        break;
      case  UPLOAD_ERR_EXTENSION: 
        $message = 'Error: carga de archivo no completada.';
        break;
      default: $message = 'Error: carga de archivo no completada.';
        break;
    }
    
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '5',
        'message' => $message
      )
    );
  }

  echo json_encode($jsonresult);
?>