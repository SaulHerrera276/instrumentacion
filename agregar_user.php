<?php
session_start();

include 'config.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['username'];
    $contrasena = $_POST['password'];
    $rol = $_POST['rol'];

    // Verificar si el nombre de usuario ya existe en la base de datos
    $sql = "SELECT id FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // El nombre de usuario ya existe, mostrar un mensaje de error
        echo "El nombre de usuario ya existe.";
    } else {
        // Verificar si el nombre de usuario y la contraseña tienen al menos 5 caracteres
        if (strlen($nombre_usuario) < 5 || strlen($contrasena) < 5) {
            echo "El nombre de usuario y la contraseña deben tener al menos 5 caracteres.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $sql_insert = "INSERT INTO usuarios (username, pass, rol) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sss", $nombre_usuario, $contrasena, $rol);
            
            if ($stmt_insert->execute()) {
                echo "Usuario agregado correctamente.";
            } else {
                echo "Error al agregar el usuario: " . $stmt_insert->error;
            }
        }
    }
}
?>
