<?php
// Configuración de conexión
$host = 'localhost';
$user = 'root'; // Cambia esto según tu configuración
$password = ''; // Cambia esto según tu configuración

// Crear conexión
$conn = new mysqli($host, $user, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Leer el archivo SQL
$sql = file_get_contents('database.sql');

if ($sql === false) {
    die("Error al leer el archivo SQL.");
}

// Ejecutar múltiples consultas
if ($conn->multi_query($sql)) {
    do {
        // Manejo de resultados
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results()() && $conn->next_result());
    echo "Base de datos importada con éxito.";
} else {
    echo "Error en la importación: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
