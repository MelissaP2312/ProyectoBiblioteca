<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $generos = $_POST['generos'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    // Manejo de la imagen
    $imagen = $_FILES['imagen'];
    $rutaImagen = 'uploads/' . basename($imagen['name']);
    
    // Verifica el tipo de archivo
    $tipoArchivo = strtolower(pathinfo($rutaImagen, PATHINFO_EXTENSION));
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($tipoArchivo, $tiposPermitidos) && $imagen['size'] <= 500000) { // Limitar a 500 KB
        // Verifica si el archivo se subió correctamente
        if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
            // Conectar a la base de datos
            $conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Preparar la declaración
            $stmt = $conn->prepare("INSERT INTO libros (nombre, autor, generos, descripcion, cantidad, portada) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nombre, $autor, $generos, $descripcion, $cantidad, $rutaImagen);

            // Ejecutar y verificar
            if ($stmt->execute()) {
                echo "Libro registrado con éxito";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Cerrar la declaración y conexión
            $stmt->close();
            $conn->close();
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Tipo de archivo no permitido o el archivo es demasiado grande.";
    }
}
?>
