<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','root');
  if ($con->initConexion('pf_agenda_php') == "OK") {
    if($con->eliminarRegistro('eventos', "id='".$_POST['id']."'")){
        $response['msg'] = "El evento ha sido borrado.";
    }else{
      $response['msg'] = "No se ha podido borrar el evento.";
    }

  } else {
    $response['msg'] = "No se pudo conectar a la base de datos.";
  }

} else {
  $response['msg'] = "No se ha iniciado sesion.";
}

echo json_encode($response);



 ?>
