<?php
  // PHP program to delete a file named gfg.txt
  // using unlink() function
    
  $file_pointer = $_POST['comprobanteNombre'];
    
  // Use unlink() function to delete a file
  if (!unlink($file_pointer)) {
    $jsonresult = array(
      'response' => array(
        'status' => 'error',
        'code' => '5',
        'message' => "El registro se ha eliminado, pero el comprobante no se ha podido eliminar"
      )
    );
  }
  else {
    $jsonresult = array(
      'response' => array(
        'status' => 'success',
        'code' => '0',
        'message' => 'El registro y el comprobante se han eliminado satisfactoriamente.'
      )
    );
  }
 
  echo json_encode($jsonresult);
?>