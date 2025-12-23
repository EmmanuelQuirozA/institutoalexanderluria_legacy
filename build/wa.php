<?php
  //TOKEN QUE NOS DA FACEBOOK
  $token = 'EAAKDY7LGIk8BAANjeZArk4ZBRDL1XhSAlTkIVscMO9LgtZBOZAguoM1pVrgMlh6OdVKNlINukcWt4Bm5M2807JM8Tl3hZBK18EWuiHdxUaH8OPSKGb9m3n6T2RH6cdEsZBrSMm0iP0ufqriYKf4LWR3cTUL1pZA5VQantScOqUEDmVlfIUwVuiJ9Q8qwi3URD7eOkbSbcZCFZAAZDZD';
  //NUESTRO TELEFONO
  $telefono = '524432012980';
  //URL A DONDE SE MANDARA EL MENSAJE
  $url = 'https://graph.facebook.com/v15.0/103919029302014/messages';

  //CONFIGURACION DEL MENSAJE
  $mensaje = ''
          . '{'
          . '"messaging_product": "whatsapp", '
          . '"to": "'.$telefono.'", '
          . '"type": "template", '
          . '"template": '
          . '{'
          . '     "name": "adeudo",'
          . '     "language":{ "code": "" } '
          . '} '
          . '}';
  //DECLARAMOS LAS CABECERAS
  $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
  //INICIAMOS EL CURL
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
  $response = json_decode(curl_exec($curl), true);
  //IMPRIMIMOS LA RESPUESTA 
  print_r($response);
  //OBTENEMOS EL CODIGO DE LA RESPUESTA
  $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  //CERRAMOS EL CURL
  curl_close($curl);
?>