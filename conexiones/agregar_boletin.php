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

/*echo "parametros correctos";
echo $nombre_org_pry;
echo $nombre;
echo $apellido;
echo $telefono;
echo $email;
echo $pentesting;
echo $ciudad;
echo $direccion;
echo $comentario;*/




if(isset($_POST["btn_enviar"]))
{

      if($pentesting == null){ $pentesting = 0; }else{ $pentesting = 1;}
      if($sistema_backups == null){ $sistema_backups = 0; }else{ $sistema_backups = 1;}
      if($itil == null){ $itil = 0; }else{ $itil = 1;}
      if($owasp == null){ $owasp = 0; }else{ $owasp = 1;}
      if($desarrollo_seguro == null){ $desarrollo_seguro = 0; }else{ $desarrollo_seguro = 1;}
 

        $sqlgrabar = "INSERT INTO boletin (nombre_org_pry,nombre,apellido,telefono,email,pentesting,sistema_backups,itil,owasp,
        desarrollo_seguro,ciudad,direccion,comentario) values ('$nombre_org_pry','$nombre','$apellido','$telefono',
        '$email',$pentesting,$sistema_backups,$itil,$owasp,$desarrollo_seguro,'$ciudad','$direccion','$comentario')";

        //echo $sqlgrabar;

        if(mysqli_query($conexion,$sqlgrabar))
        {
                echo "<script> alert('Se ha recgistrado correctamente a nuestro boletín'); window.location='../index.html' </script>";
        }else
        {
                echo "Error: ".$sqlgrabar."<br>".mysql_error($conexion);
        }
}
?>