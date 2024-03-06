<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    // Realizar la eliminación del registro
    $sql = "DELETE FROM instrumentacion WHERE id_instrumentacion = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
    // Cerrar conexión
    $conn->close();
}
?>
