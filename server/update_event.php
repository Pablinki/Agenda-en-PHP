<?php


require('./conector.php');

function validateDate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','root','root');
  if ($con->initConexion('pf_agenda_php') == "OK") {

    // $id = "'.$_POST['id'].'";
    // $start = "'.$_POST['start_date'].'";
    // $end = "'.$_POST['end_date']'";
    // $start_hour = "'.$_POST['start_hour'].'";
    // $end_hour = "'.$_POST['end_hour'].'";
    
    if(validateDate($_POST['start_date'], 'Y-m-d'))
			$datos['ini'] = $_POST['start_date'];
		if(validateDate($_POST['start_hour'], 'H:i:s'))
			$datos['ini_hora'] = $_POST['start_hour'];
		if(validateDate($_POST['end_date'], 'Y-m-d'))
			$datos['fin'] = $_POST['end_date'];
		if(validateDate($_POST['end_hour'], 'H:i:s'))
			$datos['fin_hora'] = $_POST['end_hour'];

    $actualizar_registro = $con->actualizarRegistro('eventos',$datos, 'id='.$_POST['id']);
    
    if ($actualizar_registro) {
      
      $response['msg'] = "OK";
    } else {
      $response['msg'] = "No se pudo actualizar el evento.";
    }

  } else {
    $response['msg'] = "No se pudo conectar a la base de datos.";
  }

} else {
  $response['msg'] = "No se ha iniciado sesion.";
}

echo json_encode($response);


 ?>
