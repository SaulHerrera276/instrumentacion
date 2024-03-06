<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    // Obtener detalles del registro para editar
    $sql = "SELECT * FROM instrumentacion WHERE id_instrumentacion = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<input type='hidden' name='id' value='" . $row['id_instrumentacion'] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='nombre'>Nombre:</label>";
        echo "<input type='text' name='nombre' value='" . $row['nombre'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='marca'>Marca:</label>";
        echo "<input type='text' name='marca' value='" . $row['marca'] . "' required>";
        echo "</div>";
        // Aquí se pueden agregar más campos para editar
        echo "<div class='form-group'>";
        echo "<label for='variable'>Variable:</label>";
        echo "<input type='text' name='variable' value='" . $row['variable'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='calibracion_conforme'>Calibración Conforme:</label>";
        echo "<input type='text' name='calibracion_conforme' value='" . $row['calibracion_conforme'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='codigo'>Código:</label>";
        echo "<input type='text' name='codigo' value='" . $row['codigo'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='ultima_calibracion'>Última Calibración:</label>";
        echo "<input type='text' name='ultima_calibracion' value='" . $row['ultima_calibracion'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='proxima_calibracion'>Próxima Calibración:</label>";
        echo "<input type='text' name='proxima_calibracion' value='" . $row['proxima_calibracion'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='int_cal'>Int Cal:</label>";
        echo "<input type='text' name='int_cal' value='" . $row['int_cal'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='informe'>Informe:</label>";
        echo "<input type='text' name='informe' value='" . $row['informe'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='observacion'>Observación:</label>";
        echo "<input type='text' name='observacion' value='" . $row['observacion'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='pdf'>PDF:</label>";
        echo "<input type='text' name='pdf' value='" . $row['pdf'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='area'>Área:</label>";
        echo "<input type='text' name='area' value='" . $row['area'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='maquina'>Máquina:</label>";
        echo "<input type='text' name='maquina' value='" . $row['maquina'] . "' required>";
        echo "</div>";
    } else {
        echo "No se encontró el registro.";
    }
    // Cerrar conexión
    $conn->close();
}
?>

