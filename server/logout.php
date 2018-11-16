<?php
  session_start();
  if (isset($_SESSION['username'])) {
    session_destroy();
    header( 'Location: http://localhost:8090/InteractuandoBD_PHP/ProyFinalAgendaPHP/client/index.html');
  }
 ?>
