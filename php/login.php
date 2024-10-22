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
        $correo = $_POST['email'] ?? null;
        $contraseña = $_POST['password'] ?? null;

        // Búsqueda en la base de datos
        try {
            $stmt = $conn->prepare("SELECT contraseña FROM Usuario WHERE correo = ?");
            $stmt->execute([$correo]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($contraseña, $resultado['contraseña'])) {
                // La contraseña ingresada coincide con el hash almacenado
                echo "Usuario loggeado.";
            } else {
                // La contraseña o el correo no son correctos
                echo "Correo o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            echo "Error en la consulta SQL: " . $stmt->queryString . "<br>";
            echo "Error: " . $e->getMessage();
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
