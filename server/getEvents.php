<?php

  require('./conector.php');

  session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD('localhost','root','root');
    if ($con->initConexion('pf_agenda_php') == "OK") {
      $resultado = $con->consultar(['eventos'], ['*'], 'id_usuario="'.$_SESSION['username']['id'].'"');
      $i=0;
      while ($fila = $resultado->fetch_assoc()) {
          $evento['id'] = $fila['id'];
          $evento['title'] = $fila['titulo'];
          if ($fila['dia_completo'] == 1) {
             $evento['start'] = $fila['ini'];
             $evento['allDay'] = true;
          } else {
             $evento['start'] = $fila['ini'].'T'.$fila['ini_hora'];
             $evento['end'] = $fila['fin'].'T'.$fila['fin_hora'];
             $evento['allDay'] = false;
          }
          
          $response['eventos'][$i] = $evento;
          $i++;
      }
      $response['msg'] = "OK";

    } else {
      $response['msg'] = "No se pudo conectar a la base de datos.";
    }

  } else {
    $response['msg'] = "No se ha iniciado sesion.";
  }

  echo json_encode($response);

 ?>
