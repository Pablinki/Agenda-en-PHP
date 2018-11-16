<?php
function insertData($tabla, $datos){
  $sql = "INSERT INTO ".$tabla." (";
  $i = 1;
  foreach ($datos as $key => $value) {
    $sql .= $key;
    if ($i < count($datos)) {
      $sql .= ", ";
    } else {
      $sql .= ")";
    }
    $i++;

  }
  $sql .= " VALUES (";
  $i = 1;
  foreach ($datos as $key => $value) {
    $sql .= "'".$value."'";
    if ($i < count($datos)) {
      $sql .= ", ";
    } else {
      $sql .= ")";
    }
    $i++;

  }

  return $sql;
  // return $this->ejecutarQuery($sql);

}
$datos['titulo'] = "cita";
$datos['ini'] = "2018-11-18";
$datos['fin'] = "2018-11-18";
$datos['ini_hora'] = "07:00:00";
$datos['fin_hora'] = "07:30:00";
echo insertData('eventos', $datos);
 ?>
