<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $variable = $_POST['variable'];
    $calibracion_conforme = $_POST['calibracion_conforme'];
    $codigo = $_POST['codigo'];
    $ultima_calibracion = $_POST['ultima_calibracion'];
    $proxima_calibracion = $_POST['proxima_calibracion'];
    $int_cal = $_POST['int_cal'];
    $informe = $_POST['informe'];
    $observacion = $_POST['observacion'];
    $pdf = $_POST['pdf'];
    $area = $_POST['area'];
    $maquina = $_POST['maquina'];

      // Consultar la cantidad de registros
      $count_sql = "SELECT COUNT(*) as total FROM instrumentacion";
      $result = $conn->query($count_sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Obtener el siguiente ID secuencial
        $next_id = $row['total'] + 1;
    } else {
        $next_id = 1; // Si no hay registros, empezar desde 1
    }

    
    // Preparar la sentencia SQL
    $sql = "INSERT INTO instrumentacion (nombre, marca, variable, calibracion_conforme, 
    codigo, ultima_calibracion, proxima_calibracion, int_cal, informe, observacion, pdf, area, maquina) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("sssssssssssss", $nombre, $marca, $variable, $calibracion_conforme,
     $codigo, $ultima_calibracion, $proxima_calibracion, $int_cal, $informe, $observacion, $pdf, $area, $maquina);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "Registro agregado correctamente.";
    } else {
        echo "Error al agregar el registro: " . $conn->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
