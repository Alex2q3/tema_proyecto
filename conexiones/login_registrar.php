<?php

include("datos.php");


$nombre   = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$email   = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$password   = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
# Aquí pon la clave secreta que obtuviste en la página de developers de Google
#define("CLAVE_SECRETA", "TU_CLAVE_VA_AQUÍ");
define("6LcH9J0fAAAAABrDc8qHJDKj3wVg2EpF5OUvEQlS", "6LcH9J0fAAAAAOHRj6-luxLkTFK3c1eAUzBMskwV");

/*echo "parametros correctos";
echo $nombre;
echo $username;
echo $password;
echo $email;*/


//Login
if (isset($_POST["btn_ingresar"])) {
        //$username = $db->mysqli_real_escape_string($username);
        //$password = $db->mysqli_real_escape_string(md5('YOUR_SECRET_STRING', $password));
        # Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
$token = $_POST["g-recaptcha-response"];
$verificado = verificarToken($token, CLAVE_SECRETA);
# Si no ha pasado la prueba
if ($verificado) {
    /**
     * Llegados a este punto podemos confirmar que el usuario
     * no es un robot. Aquí debes hacer lo que se deba hacer, es decir,
     * comprobar las credenciales, darle acceso, etcétera, pues
     * ya ha pasado el captcha
     */
 

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
                include("reCaptcha.php");
                echo "<script> alert('Bienvenido $username, TU ip es $ip'); window.location= '../formularios/clientes.html' </script>";
        } else {
                echo "<script> alert('Usuario y clave no coinciden'); window.location='../login/login.html' </script>";
        }
        #echo "Has completado la prueba :)";
    } else {
        echo "<script> window.location='../login/login.html'; alert('No te olvides del reCaptcha..!!') </script>";
    
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

/**
 * Verifica el token del captcha y regresa true o false
 * true en caso de que el usuario haya pasado la prueba
 * false en caso contrario
 * 
 * Más información: https://parzibyte.me/blog/2019/08/21/peticion-http-php-json-formulario/
 *
 * @author parzibyte
 * @see https://parzibyte.me/blog
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

    # En caso de que no haya regresado false, decodificamos con JSON
    # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}

?>