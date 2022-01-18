<?php

include("datos.php");

$nombre_org_pry   = $_POST["nombre_org_pry"];
$nombre = $_POST["nombre"];
$apellido   = $_POST["apellido"];
$telefono   = $_POST["telefono"];
$email   = $_POST["email"];
$pentesting   = $_POST["pentesting"];
$sistema_backups   = $_POST["sistema_backups"];
$itil   = $_POST["itil"];
$owasp   = $_POST["owasp"];
$desarrollo_seguro   = $_POST["desarrollo_seguro"];
$ciudad   = $_POST["ciudad"];
$direccion   = $_POST["direccion"];
$comentario   = $_POST["comentario"];
if(isset($_POST["btn_enviar"]))
{
        $sqlgrabar = "INSERT INTO usuarios (nombre_org_pry,nombre,apellido,telefono,email,pentesting,sistema_backups,itil,owasp,
        desarrollo_seguro,ciudad,direccion,comentario) values ('$nombre_org_pry','$nombre','$apellido','$telefono',
        '$email','$pentesting','$sistema_backups','$itil','$owasp','$desarrollo_seguro','$ciudad','$direccion','$comentario')";

        if(mysqli_query($conexion,$sqlgrabar))
        {
                echo "<script> alert('Se ha registrado con exito: $name'); window.location='index.html' </script>";
        }else
        {
                echo "Error: ".$sqlgrabar."<br>".mysql_error($conexion);
        }
}
?>