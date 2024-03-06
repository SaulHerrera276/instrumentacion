<?php
include 'config.php'; // Asegúrate de que la ruta al archivo sea correcta

// Consulta SQL para obtener el total de registros
$sqlTotalRegistros = "SELECT COUNT(*) AS total_registros FROM instrumentacion";
$resultTotalRegistros = $conn->query($sqlTotalRegistros);

$datos = array();

if ($resultTotalRegistros->num_rows > 0) {
    $rowTotalRegistros = $resultTotalRegistros->fetch_assoc();
    $datos['total_registros'] = $rowTotalRegistros['total_registros'];
} else {
    $datos['total_registros'] = 0;
}

// Consulta SQL para obtener el total de registros pasados, prontos y futuros
$sqlPasadas = "SELECT COUNT(*) AS total_pasadas FROM instrumentacion WHERE proxima_calibracion < CURRENT_DATE";
$sqlProntas = "SELECT COUNT(*) AS total_prontas FROM instrumentacion WHERE proxima_calibracion >= CURRENT_DATE AND proxima_calibracion <= DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY)";
$sqlFuturas = "SELECT COUNT(*) AS total_futuras FROM instrumentacion WHERE proxima_calibracion > DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY)";

$resultPasadas = $conn->query($sqlPasadas);
$resultProntas = $conn->query($sqlProntas);
$resultFuturas = $conn->query($sqlFuturas);

if ($resultPasadas->num_rows > 0) {
    $rowPasadas = $resultPasadas->fetch_assoc();
    $datos['pasadas'] = $rowPasadas['total_pasadas'];
} else {
    $datos['pasadas'] = 0;
}

if ($resultProntas->num_rows > 0) {
    $rowProntas = $resultProntas->fetch_assoc();
    $datos['prontas'] = $rowProntas['total_prontas'];
} else {
    $datos['prontas'] = 0;
}

if ($resultFuturas->num_rows > 0) {
    $rowFuturas = $resultFuturas->fetch_assoc();
    $datos['futuras'] = $rowFuturas['total_futuras'];
} else {
    $datos['futuras'] = 0;
}

echo json_encode($datos); // Devolver los datos como JSON
$conn->close();
?>
