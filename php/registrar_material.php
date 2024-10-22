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
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen'];
        $ruta_imagen = 'imagenes/' . basename($imagen['name']); // Ajusta la ruta según sea necesario

        // Mover el archivo subido a la carpeta deseada
        if (move_uploaded_file($imagen['tmp_name'], $ruta_imagen)) {
            // Preparar la consulta SQL
            $stmt = $conn->prepare("INSERT INTO materiales (tipo, descripcion, cantidad, imagen) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $tipo, $descripcion, $cantidad, $ruta_imagen);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Material registrado exitosamente.";
            } else {
                echo "Error al registrar el material: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "No se ha subido ninguna imagen o ha ocurrido un error.";
    }
}

$conn->close();
?>
