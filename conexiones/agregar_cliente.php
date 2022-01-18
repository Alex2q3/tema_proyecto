<?php

include("datos.php");

$nombre = $_POST["nombre"];
$apellido   = $_POST["apellido"];
$telefono   = $_POST["telefono"];
$email   = $_POST["email"];
$email_institucional   = $_POST["email_institucional"];
$identificacion   = $_POST["identificacion"];
$profesion   = $_POST["profesion"];
$institucion   = $_POST["institucion"];
$ciudad   = $_POST["ciudad"];
$sexo   = $_POST["sexo"];

if(isset($_POST["btn_guardar"]))
{
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