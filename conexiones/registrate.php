<?php

// Incluimos los datos de conexión y las funciones:
include("datos.php");


//Validamos que hayan llegado estas variables, y que no esten vacias:

if (isset($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["phone"]!="" ){
//traspasamos a variables locales, para evitar complicaciones con las comillas:
$nombre   = $_POST["nombre"];
$username = $_POST["username"];
$email   = $_POST["email"];
$password   = $_POST["password"];

//Preparamos la orden SQL
$consulta = mysqli_query($conexion,"INSERT INTO contactos
(contactid,fname,lname,email,phone) VALUES ('0','$fname','$lname','$email','$phone')");

echo "<script> alert('Registro agregado: $fname'); window.location='index.html'</script>";

} else {
echo"<p>Servicio interrumpido</p>";

}
?>

