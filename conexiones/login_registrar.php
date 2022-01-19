<?php

include("datos.php");

$nombre   = $_POST["nombre"];
$username = $_POST["username"];
$email   = $_POST["email"];
$password   = $_POST["password"];

echo $nombre;

//Login
if(isset($_POST["btn_ingresar"]))
{
        $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE username = '$username' AND password='$password'");
        $nr = mysqli_num_rows($query);

        if($nr==1)
        {
                echo "<script> alert('Bienvenido $username'); window.location='../formularios/clientes.html' </script>";
        }else
        {
                echo "<script> alert('Usuario y clave no coinciden'); window.location='login.html' </script>";
        }
}

//Registrar
if(isset($_POST["btn_registrar"]))
{
        $sqlgrabar = "INSERT INTO usuarios (username,password,email,nombre) values ('$username','$password','$email','$nombre')";
echo $sqlgrabar;
        if(mysqli_query($conexion,$sqlgrabar))
        {
                echo "<script> alert('Usuario registrado con exito: $username'); window.location='../index.html' </script>";
        }else
        {
                echo "Error: ".$sqlgrabar."<br>".mysql_error($conexion);
        }
}
?>
