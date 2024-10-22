<?php
require 'EnvLoader.php';

try {
    $dbHost = EnvLoader::get('DB_HOST');
    $dbName = EnvLoader::get('DB_NAME');
    $dbUser = EnvLoader::get('DB_USER');
    $dbPassword = EnvLoader::get('DB_PASSWORD');

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['name'] ?? null; 
        $edad = $_POST['age'] ?? null;
        $telefono = $_POST['phone'] ?? null;
        $correo = $_POST['email'] ?? null;
        $contrasena = $_POST['password'] ?? null;
        $contrasenaConfirmada = $_POST['password-confirm'] ?? null;

        if (is_null($nombre) || is_null($edad) || is_null($telefono) || is_null($correo) || is_null($contrasena) || is_null($contrasenaConfirmada)) {
            die('Por favor, completa todos los campos.');
        }

        if ($contrasena !== $contrasenaConfirmada) {
            die('Las contraseñas no coinciden.');
        }

        // Inserción en la base de datos
        try {
            $stmt = $conn->prepare("INSERT INTO Usuario (nombre, genero, edad, telefono, correo, contraseña) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $_POST['gender'], (int)$edad, $telefono, $correo, password_hash($contrasena, PASSWORD_DEFAULT)]);
            header('Location: ../html/login.html');
        } catch (PDOException $e) {
            echo "Error en la consulta SQL: " . $stmt->queryString . "<br>";
            echo "Error: " . $e->getMessage();
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
