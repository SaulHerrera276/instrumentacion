
<?php
include 'config.php';

// Obtener parámetros del formulario
$area = isset($_POST['area']) ? $_POST['area'] : 'todos';
$marca = isset($_POST['marca']) ? $_POST['marca'] : 'todos';
$calibracion = isset($_POST['calibracion']) ? $_POST['calibracion'] : 'todos';

// Construir consulta SQL según los parámetros recibidos
$sql = "SELECT * FROM instrumentacion WHERE 1=1";

if ($area != 'todos') {
    $sql .= " AND area = '$area'";
}

if ($marca != 'todos') {
    $sql .= " AND marca = '$marca'";
}

if ($calibracion != 'todos') {
    if ($calibracion == 'pasadas') {
        $sql .= " AND proxima_calibracion < NOW()";
    } elseif ($calibracion == 'prontas') {
        $sql .= " AND proxima_calibracion >= NOW() AND proxima_calibracion <= DATE_ADD(NOW(), INTERVAL 1 MONTH)";
    } elseif ($calibracion == 'futuras') {
        $sql .= " AND proxima_calibracion > DATE_ADD(NOW(), INTERVAL 1 MONTH)";
    }
}

// Ejecutar la consulta
$result = $conn->query($sql);

// Mostrar los resultados en una tabla
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Variable</th><th>Calibración Conforme</th><th>Código</th><th>Última Calibración</th><th>Próxima Calibración</th><th>Int Cal</th><th>Informe</th><th>Observación</th><th>PDF</th><th>Área</th><th>Maquina</th><th>Acciones</th><th></th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_instrumentacion'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['variable'] . "</td>";
        echo "<td>" . $row['calibracion_conforme'] . "</td>";
        echo "<td>" . $row['codigo'] . "</td>";
        echo "<td>" . $row['ultima_calibracion'] . "</td>";
        echo "<td class='" . obtenerClaseCalibracion($row['proxima_calibracion']) . "'>" . $row['proxima_calibracion'] . "</td>";
        echo "<td>" . $row['int_cal'] . "</td>";
        echo "<td>" . $row['informe'] . "</td>";
        echo "<td>" . $row['observacion'] . "</td>";
        echo "<td>" . $row['pdf'] . "</td>";
        echo "<td>" . $row['area'] . "</td>";
        echo "<td>" . $row['maquina'] . "</td>";
        echo "<td><button class='editar-btn' data-id='" . $row['id_instrumentacion'] . "'>Editar</button></td>";
        echo "<td><button class='eliminar-btn' data-id='" . $row['id_instrumentacion'] . "'>Eliminar</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión
$conn->close();

function obtenerClaseCalibracion($fecha) {
    $hoy = date('Y-m-d');
    $unMesDespues = date('Y-m-d', strtotime('+1 month'));

    if ($fecha < $hoy) {
        return 'calibracion-pasada';
    } elseif ($fecha <= $unMesDespues) {
        return 'calibracion-pronta';
    } else {
        return 'calibracion-futura';
    }
}

?>



