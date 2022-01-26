<?php

include("datos.php");

$nombre = filter_var($_POST["nombre"],FILTER_SANITIZE_STRING);
$apellido   = filter_var($_POST["apellido"],FILTER_SANITIZE_STRING);
$telefono   = filter_var($_POST["telefono"],FILTER_SANITIZE_STRING);
$email   = filter_var($_POST["email"],FILTER_SANITIZE_STRING);
$email_institucional   = filter_var($_POST["email_institucional"],FILTER_SANITIZE_STRING);
$identificacion   = filter_var($_POST["identificacion"],FILTER_SANITIZE_STRING);
$profesion   = filter_var($_POST["profesion"],FILTER_SANITIZE_STRING);
$institucion   = filter_var($_POST["institucion"],FILTER_SANITIZE_STRING);
$ciudad   = filter_var($_POST["ciudad"],FILTER_SANITIZE_STRING);
$sexo   = $_POST["sexo"];

if(isset($_POST["btn_guardar"]))
{

        if($sexo == 'M'){ $sexo = 'M'; }else{ $sexo = 'F';}

        $sqlgrabar = "INSERT INTO cliente (nombre,apellido,telefono,email,email_institucional,identificacion,profesion,institucion,
        ciudad,sexo) values ('$nombre','$apellido','$telefono',
        '$email','$email_institucional','$identificacion','$profesion','$institucion','$ciudad','$sexo')";

        if(mysqli_query($conexion,$sqlgrabar))
        {
                echo "<script> alert('Se ha registrado con exito: $name'); </script>";
        }else
        {
                echo "Error: ".$sqlgrabar."<br>".mysql_error($conexion);
        }
}
?>