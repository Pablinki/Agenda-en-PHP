<?php

include('conector.php');


// $datos['email'] = "'".$_POST['username']."'";
// $datos['password'] = "'".password_hash($_POST['password'], PASSWORD_DEFAULT)."'";

$con = new ConectorBD('localhost', 'root', 'root');
$response['conexion'] = $con->initConexion('pf_agenda_php');


if ($response['conexion'] == "OK") {
  $resultado_query = $con->consultar(['usuarios'], ['*'], "email='".$_POST['username']."'");
  if ($resultado_query->num_rows != 0) {

    while ($fila = $resultado_query->fetch_assoc()) {
      $res = $fila;
    }

    if (md5($_POST['password']) == $res['password']) { //password_verify($_POST['password'], $fila['password'])
      $response['msg'] = "OK";
      session_start();
      $_SESSION['username'] = $res;
    } else {
      $response['msg'] = 'Acceso rechazado';
    }

  } else {
    $response['msg'] = "Hubo un error y los datos no han sido consultados";
  }

} else {
  $response['msg'] = "No se pudo conectar a la base de datos";
}

echo json_encode($response);
//$con->cerrarConexion()

?>
