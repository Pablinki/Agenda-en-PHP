<?php

  include('conector.php');

  $id = 4;
  $email = "lpv@cmail.com";
  $nombre = "Lope de Vega";
  $password = password_hash("12345", PASSWORD_DEFAULT);

  $con = new ConectorBD('localhost', 'root', 'root');
  $response['conexion'] = $con->initConexion('pf_agenda_php');

  if ($response['conexion'] == "OK") {
    $resultado = $con->valida($id);
    if ($resultado->num_rows == true) {
      $response['msg'] = "El email ya esta registrado.";
    }else{
      if ($con->nuevoUsuario($id,$email,$nom,$pass)) {
          $response['msg'] = "El usuario ha sido guardado.";
      } else {
          $response['msg'] = "Hubo un error y los datos no han sido cargados";
      }
    }

  echo json_encode($response);

?>
