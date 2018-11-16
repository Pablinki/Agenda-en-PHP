<?php
  require('./conector.php');

  session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD('localhost','root','root');
    if ($con->initConexion('pf_agenda_php') == "OK") {
      $datos['titulo'] = $_POST['titulo'];
      $datos['ini'] = $_POST['start_date'];
      if ($_POST['allDay'] == 'true') {
          $datos['dia_completo'] = "1";
      } else {

          $datos['fin'] = $_POST['end_date'];
          $datos['ini_hora'] = $_POST['start_hour'];
          $datos['fin_hora'] = $_POST['end_hour'];
          $datos['dia_completo'] = "0";

      }
      $datos['id_usuario'] = $_SESSION['username']['id'];


      if ($con->insertData('eventos', $datos)) {
        // $response['msg'] =  "OK";
        $response['msg'] = "OK";
      } else {
        $response['msg'] = "No se pudo realizar la insercion de los datos.";


      }

    } else {
      $response['msg'] = "No se pudo conectar a la base de datos.";
    }

  } else {
    $response['msg'] = "No se ha iniciado sesion.";
  }

  echo json_encode($response);

 ?>
