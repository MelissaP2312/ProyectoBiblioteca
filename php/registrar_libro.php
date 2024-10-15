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

    // Verifica si el archivo se subió correctamente
    if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
        // Aquí deberías conectar a tu base de datos y guardar los datos
        // Ejemplo de conexión (asegúrate de usar tus propios datos)
        $conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Inserta los datos
        $sql = "INSERT INTO libros (nombre, autor, generos, descripcion, cantidad, portada) VALUES ('$nombre', '$autor', '$generos', '$descripcion', $cantidad, '$rutaImagen')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Libro registrado con éxito";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error al subir la imagen.";
    }
}
?>
