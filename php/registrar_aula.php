<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia según tu configuración
$username = "tu_usuario";   // Cambia según tu configuración
$password = "tu_contraseña"; // Cambia según tu configuración
$dbname = "tu_base_de_datos"; // Cambia según tu configuración

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_aula = $_POST['nombre_aula'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO aulas (nombre_aula, capacidad, ubicacion) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nombre_aula, $capacidad, $ubicacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Aula registrada exitosamente.";
    } else {
        echo "Error al registrar el aula: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
