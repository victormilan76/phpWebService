<?php
  function conectarse()
  {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dataBase = "bd_nube";

    $link = mysqli_connect($host,$user,$pass,$dataBase) or die ("No se pudo conectar a la base de datos: ".mysqli_connect_error());
    return $link;
  }
?>