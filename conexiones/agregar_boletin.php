<?php

include("datos.php");

$nombre_org_pry   = filter_var($_POST["nombre_org_pry"],FILTER_SANITIZE_STRING);
$nombre =  filter_var($_POST["nombre"],FILTER_SANITIZE_STRING);
$apellido   =  filter_var($_POST["apellido"],FILTER_SANITIZE_STRING);
$telefono   =  filter_var($_POST["telefono"],FILTER_SANITIZE_STRING);
$email   =  filter_var($_POST["email"],FILTER_SANITIZE_STRING);
$pentesting   = $_POST["pentesting"];
$sistema_backups   = $_POST["sistema_backups"];
$itil   = $_POST["itil"];
$owasp   = $_POST["owasp"];
$desarrollo_seguro   = $_POST["desarrollo_seguro"];
$ciudad   =  filter_var($_POST["ciudad"],FILTER_SANITIZE_STRING);
$direccion   =  filter_var($_POST["direccion"],FILTER_SANITIZE_STRING);
$comentario   =  filter_var($_POST["comentario"],FILTER_SANITIZE_STRING);

echo "parametros correctos";


if(isset($_POST["btn_enviar"]))
{
        $sqlgrabar = "INSERT INTO boletin (nombre_org_pry,nombre,apellido,telefono,email,pentesting,sistema_backups,itil,owasp,
        desarrollo_seguro,ciudad,direccion,comentario) values ('$nombre_org_pry','$nombre','$apellido','$telefono',
        '$email','$pentesting','$sistema_backups','$itil','$owasp','$desarrollo_seguro','$ciudad','$direccion','$comentario')";

        if(mysqli_query($conexion,$sqlgrabar))
        {
                echo "<script> alert('Se ha registrado a nuestro boletín Exitosamente); window.location='index.html' </script>";
        }else
        {
                echo "Error: ".$sqlgrabar."<br>".mysql_error($conexion);
        }
}
?>