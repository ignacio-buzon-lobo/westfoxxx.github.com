<?php
// Este archivo se usa para configurar las variables de la base de datos y luego conectar nuestra aplicación a la base de datos MySQL
// Se crea una cadena de conexión que contiene el nombre del host (localhost) y el nombre de la base de datos (licorex).
$dsn = "mysql:host=db4free.net;dbname=licorex";
// Se establece el nombre de usuario para la conexión a la base de datos.
$username = "prueba10";
// Se establece la contraseña para la conexión a la base de datos, que en este caso no habrá.
$password = "prueba10";

try {
    // Se está intentando establecer una conexión a la base de datos utilizando la clase PDO de PHP. 
    // Los parámetros que pasa son la cadena de conexión, el nombre de usuario y la contraseña.
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    // Si la conexión falla, se captura la excepción de tipo PDOException y se muestra un mensaje de error.
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$conn = null;
?>