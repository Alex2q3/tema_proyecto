<?php

include("datos.php");

$nombre   = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$email   = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$password   = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
# Aquí pon la clave secreta que obtuviste en la página de developers de Google
#define("CLAVE_SECRETA", "TU_CLAVE_VA_AQUÍ");
define("CLAVE_SECRETA", "6LcH9J0fAAAAABrDc8qHJDKj3wVg2EpF5OUvEQlS");

/*echo "parametros correctos";
echo $nombre;
echo $username;
echo $password;
echo $email;*/

  #Obtenemos IP de conexión
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
#Definimos fecha y hora
#La configuración de dependera de las zona horaria en el servidor.
$date = date('Y-m-d H:i:s');

//Login
if (isset($_POST["btn_ingresar"])) {
       
# Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
$token = $_POST["g-recaptcha-response"];
$verificado = verificarToken($token, CLAVE_SECRETA);
# Si no ha pasado la prueba
if ($verificado) {
    /**
     * El usuario no es un robot. 
     * Comprobamos las credenciales
     */
 
     if($username != null || $password != null){
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username = '$username' AND password='$password'");
        $nr = mysqli_num_rows($query);
      
        #Usuario autenticado
        if ($nr == 1) {
                $password = 'SECRET';
                $logueo = 'CORRECTO';
                $sqlgrabar = "INSERT INTO usuarios_acceso (username,password,ip,fecha_acceso,logueo) values ('$username','$password','$ip','$date','$logueo')";
                mysqli_query($conexion, $sqlgrabar);
                echo "<script> alert('Bienvenido $username, TU ip es $ip  -- $password  -- $logueo' ); window.location= '../formularios/clientes.html' </script>";
        } else {
            #usuario no autenticado
                $logueo = 'INCORRECTO - NO REGISTRADO';
                $sqlgrabar = "INSERT INTO usuarios_acceso (username,password,ip,fecha_acceso,logueo) values ('$username','$password','$ip','$date','$logueo')";
                mysqli_query($conexion, $sqlgrabar);
                echo "<script> alert('Usuario y clave no coinciden - $logueo'); window.location='../login/login.html' </script>";
        }
    } else{
        echo "<script> window.location='../login/login.html'; alert('Ingrese el Usuario y su Contraseña..!!') </script>";
    }
    } else {
    #usuario no autenticado o sin reCAPTCHA
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username = '$username' AND password='$password'");
        $nr = mysqli_num_rows($query);
        if ($nr == 1) {
            #Se olvido wl reCAPTCHA
            $password = 'SECRET';
            $logueo = 'INCORRECTO - SIN reCAPTCHA';
        } else {
            #Intento de ingreso
            $logueo = 'POSIBLE ROBOT';
        }
        $sqlgrabar = "INSERT INTO usuarios_acceso (username,password,ip,fecha_acceso,logueo) values ('$username','$password','$ip','$date','$logueo')";
        mysqli_query($conexion, $sqlgrabar);
        echo "<script> window.location='../login/login.html'; alert('No te olvides del reCAPTCHA..!! $logueo') </script>";
    
    }
}

//Registrar
if (isset($_POST["btn_registrar"])) {
        $sqlgrabar = "INSERT INTO usuarios (username,password,email,nombre) values ('$username','$password','$email','$nombre')";
        #Validamos registro de nuevo Usuario.
        if (mysqli_query($conexion, $sqlgrabar)) {
                echo "<script> alert('Usuario registrado con exito: $username'); window.location='../index.html' </script>";
        } else {
                echo "Error: " . $sqlgrabar . "<br>" . mysql_error($conexion);
        }
}

/**
 * Verifica el token del captcha y regresa true o false
 * true en caso de que el usuario haya pasado la prueba
 * false en caso contrario
 */
function verificarToken($token, $claveSecreta)
{
    # La API en donde verificamos el token
    $url = "https://www.google.com/recaptcha/api/siteverify";
    # Los datos que enviamos a Google
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url, false, $contexto);
    # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
    # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
    # al servidor de Google
    if ($resultado === false) {
        # Error haciendo petición
        return false;
    }

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}

?>