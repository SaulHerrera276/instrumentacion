<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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

    $sql = "UPDATE instrumentacion SET nombre='$nombre', marca='$marca', variable='$variable', calibracion_conforme='$calibracion_conforme', codigo='$codigo', ultima_calibracion='$ultima_calibracion', proxima_calibracion='$proxima_calibracion', int_cal='$int_cal', informe='$informe', observacion='$observacion', pdf='$pdf', area='$area', maquina='$maquina' WHERE id_instrumentacion=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente.";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>