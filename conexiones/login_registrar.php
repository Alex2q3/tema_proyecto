<?php

include("datos.php");
include("reCaptcha.php");

$nombre   = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$email   = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$password   = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

/*echo "parametros correctos";
echo $nombre;
echo $username;
echo $password;
echo $email;*/


//Login
if (isset($_POST["btn_ingresar"])) {
        //$username = $db->mysqli_real_escape_string($username);
        //$password = $db->mysqli_real_escape_string(md5('YOUR_SECRET_STRING', $password));

        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username = '$username' AND password='$password'");
        $nr = mysqli_num_rows($query);
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                 $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
                 $ip = $_SERVER['REMOTE_ADDR'];
        }
        $date = date('Y-m-d H:i:s');

        if ($nr == 1) {
                $sqlgrabar = "INSERT INTO usuarios_acceso (username,password,ip,fecha_acceso) values ('$username','$password','$ip','$date')";
                mysqli_query($conexion, $sqlgrabar);
                echo "<script> alert('Bienvenido $username, TU ip es $ip'); window.location= '../formularios/clientes.html' </script>";
        } else {
                echo "<script> alert('Usuario y clave no coinciden'); window.location='../login/login.html' </script>";
        }
}

//Registrar
if (isset($_POST["btn_registrar"])) {
        $sqlgrabar = "INSERT INTO usuarios (username,password,email,nombre) values ('$username','$password','$email','$nombre')";

        //echo $sqlgrabar;
        if (mysqli_query($conexion, $sqlgrabar)) {
                echo "<script> alert('Usuario registrado con exito: $username'); window.location='../index.html' </script>";
        } else {
                echo "Error: " . $sqlgrabar . "<br>" . mysql_error($conexion);
        }
}

?>