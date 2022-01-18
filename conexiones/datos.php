<?php
$host="localhost";
$usuario="adproject";
$clave="Telecom321%";
$base="registro";
$conexion=mysqli_connect("$host","usuario","clave") or die();
$base=mysqli_select_db($conexion, $base);
?>
