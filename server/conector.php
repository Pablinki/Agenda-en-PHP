<?php
  class ConectorBD{
      private $host;
      private $user;
      private $password;
      private $conexion;

      function __construct($host, $user, $password)
      {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
      }

      function initConexion($nombre_db)
      {
        $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
        if ($this->conexion->connect_error) {
          return "Error: ". $this->conexion->connect_error;

        } else {
          return "OK";
        }

      }

      function valida($id)
      {
        $sql = "select id from usuarios where id='".$id."';";
        return $this->ejecutarQuery($sql);
      }

      function nuevoUsuario($id, $email, $nom, $pass)
      {
        $sql = "CALL guardarNuevoUsuario('".$id."', '".$email."', '".$nom."', '".$pass."',);";
        return $this->ejecutarQuery($sql);
      }

      function ejecutarQuery($query){
        return $this->conexion->query($query);
      }

      function cerrarConexion(){
        return $this->conexion->close();
      }

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
          // $sql .= $value;
          if ($i < count($datos)) {
            $sql .= ", ";
          } else {
            $sql .= ");";
          }
          $i++;

        }
        return $this->ejecutarQuery($sql);

      }

      function actualizarRegistro($tabla, $datos, $condicion)
      {
        $sql = 'UPDATE ' . $tabla . ' SET ';
        		$i = 1;
        		foreach ($datos as $key => $value) {
        			$sql .= $key . '="' . $value. '"';
        			if ($i < sizeof($datos)) {
        				$sql .= ', ';
        			} else
        				$sql .= ' WHERE ' . $condicion . ';';
        			$i++;
        		}
        		return $this -> ejecutarQuery($sql);
      }

      function eliminarRegistro($tabla, $condicion)
      {
        $sql = "DELETE FROM ".$tabla.' WHERE '.$condicion.";";
        return $this->ejecutarQuery($sql);
      }

      function consultar($tablas, $campos, $condicion="")
      {
        $sql = "SELECT ";
        $a = array_keys($campos);
        $ultima_key = end($a);
        foreach ($campos as $key => $value) {
          $sql .= $value;
          if ($key != $ultima_key) {
            $sql .= ", ";
          } else {
            $sql .= " FROM ";
          }
        }

        $a = array_keys($tablas);
        $ultima_key = end($a);
        foreach ($tablas as $key => $value) {
          $sql .= $value;
          if ($key != $ultima_key) {
            $sql .= ", ";
          } else {
            $sql .= " ";
          }

        }

        if ($condicion == "") {
          $sql .= ";";
        } else {
          $sql .= " WHERE ".$condicion.";";
        }

        return $this->ejecutarQuery($sql);
      }
  }
 ?>
