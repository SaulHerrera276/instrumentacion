<?php
session_start();
include 'config.php';

// Verificar credenciales de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = $_POST['pass'];

    $sql = "SELECT id, rol FROM usuarios WHERE username = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id_usuario, $rol);
        $stmt->fetch();

        // Almacenar información de sesión
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['rol'] = $rol;
        $_SESSION['nombre_usuario'] = $usuario;

        // Redireccionar según el rol del usuario
        if ($rol == 'admin') {
            header("Location: index.php");
        } elseif ($rol == 'invitado') {
            header("Location: index_invitado.php");
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
        header("Location: login.php?error=" . urlencode($error)); // Redireccionar con mensaje de error
    }
}
?>

