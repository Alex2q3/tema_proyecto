<?php
//la conexión depende de cada ambiente configurado en el servidor
$host="127.0.0.1";
$usuario="adproject";
$clave="Telecom321%";
$base="pry_honeypot";
$conexion=mysqli_connect($host,$usuario,$clave) or die();
$base=mysqli_select_db($conexion, $base);

echo "Conexion lista";

?>
