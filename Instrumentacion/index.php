<?php
session_start();

if (!isset($_SESSION['id_usuario']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    // El usuario no ha iniciado sesión y la página actual no es la página de inicio de sesión,
    // redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumentación</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
</head>
<body>

<div class="container1">
 <!-- Mostrar mensaje de bienvenida -->
 <?php if (isset($_SESSION['nombre_usuario'])) : ?>
    <img src="img/logo.png" alt="logo.png">  <h1>  <p>Bienvenido <?php echo $_SESSION['nombre_usuario']; ?></p></h1>
    <a href="cerrar_sesion.php" class="btn-cerrar">Cerrar Sesión</a>  
    <a href="https://www.instagram.com/saul_herrers/" class="btn-cerrar">Informacion</a>  
    <?php endif; ?>
        </div>

        <div class="container1">
<!-- Contenedor para el gráfico -->
<div style="width: 80%; margin: auto;">
    <canvas id="graficoCalibraciones"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
 <!-- Contador de calibraciones totales -->
 <div id="contadorTotal"></div>
 <script>
        $(document).ready(function() {
            // Función para obtener los datos del archivo obtenerdatos.php
            function obtenerDatos() {
                $.ajax({
                    url: 'obtenerdatos.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Mostrar el contador de calibraciones totales
                        $('#contadorTotal').text('Total de registros : ' + data.total_registros);

                        // Crear el gráfico con los datos obtenidos
                        crearGrafico(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
// Función para crear el gráfico
    function crearGrafico(datos) {
        var ctx = document.getElementById('graficoCalibraciones').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Calibraciones'],
                datasets: [{
                    label: 'Pasadas',
                    data: [datos.pasadas],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',   // Rojo
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Prontas',
                    data: [datos.prontas],
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',  // Amarillo
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }, {
                    label: 'Futuras',
                    data: [datos.futuras],
                    backgroundColor: 'rgba(126, 185, 136)',  // Verde
                    borderColor: 'rgba(126,185,150)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
           
       // Llamar a la función para obtener los datos y crear el gráfico al cargar la página
            obtenerDatos();
        });
    </script>
</div>
</div>


  
<div class="container1">
<h1>Panel de Administrador</h1>
<button id="nuevoRegistro" class="btn-agregar">Agregar Nuevo Registro</button>
<!-- Agregar botón para abrir el modal de agregar nuevo usuario -->
<button id="nuevoUsuario" class="btn-agregar">Agregar Nuevo Usuario</button>

</div>
    <div class="container1">
        <h1>Buscar Instrumentación</h1>
        <form id="searchForm" class="form" method="POST">
            <div class="form-group">
                <label for="area">Área:</label>
                <select name="area" id="area">
                    <option value="todos">Todas las áreas</option>
                    <option value="co2">CO2</option>
                    <option value="calderas">Calderas</option>
                    <option value="refrigeracion">Refrigeración</option>
                </select>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <select name="marca" id="marca">
                    <option value="todos">Todas las marcas</option>
                    <option value="dewit">Dewit</option>
                    <option value="wika">Wika</option>
                    <option value="mpm">MPM</option>
                    <option value="deweston">Deweston</option>
                    <option value="afriso">Afriso</option>
                    <option value="jumo">Jumo</option>
                    <option value="saacke">Saacke</option>
                </select>
            </div>
            <div class="form-group">
                <label for="calibracion">Calibración:</label>
                <select name="calibracion" id="calibracion">
                    <option value="todos">Todas las calibraciones</option>
                    <option value="pasadas">Calibraciones pasadas</option>
                    <option value="prontas">Calibraciones prontas</option>
                    <option value="futuras">Calibraciones futuras</option>
                </select>
            </div>
            <button type="submit">Buscar</button>
        </form>
    </div>
    <div class="container">
        <h2>Resultados:</h2>
        <div id="resultados" class="table-container">
            <!-- Aquí se mostrarán los resultados de la búsqueda -->
        </div>
    </div>

    <!-- Modal de edición -->
    <div id="editarModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Registro</h2>
            <form id="editarForm" class="form">
                <!-- Aquí se cargarán los campos de edición -->
            </form>
            <button id="guardarEdicion">Guardar Cambios</button>
        </div>
    </div>
<!-- Modal para agregar nuevo registro -->
<div id="agregarModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Agregar Nuevo Registro</h2>
        <form id="agregarForm" class="form" method="POST">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" name="marca" required>
            </div>
            <div class="form-group">
                <label for="variable">Variable:</label>
                <input type="text" name="variable">
            </div>
            <div class="form-group">
                <label for="calibracion_conforme">Calibración Conforme:</label>
                <input type="text" name="calibracion_conforme">
            </div>
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo">
            </div>
            <div class="form-group">
                <label for="ultima_calibracion">Última Calibración:</label>
                <input type="date" name="ultima_calibracion">
            </div>
            <div class="form-group">
                <label for="proxima_calibracion">Próxima Calibración:</label>
                <input type="date" name="proxima_calibracion">
            </div>
            <div class="form-group">
                <label for="int_cal">Int Cal:</label>
                <input type="text" name="int_cal">
            </div>
            <div class="form-group">
                <label for="informe">Informe:</label>
                <input type="text" name="informe">
            </div>
            <div class="form-group">
                <label for="observacion">Observación:</label>
                <input type="text" name="observacion">
            </div>
            <div class="form-group">
                <label for="pdf">PDF:</label>
                <input type="text" name="pdf">
            </div>
            <div class="form-group">
    <label for="area">Área:</label>
    <select id="area" name="area" class="form-control">
        <option value="co2">CO2</option>
        <option value="refrigeracion">Refrigeración</option>
        <option value="calderas">Calderas</option>
    </select>
</div>
            <div class="form-group">
                <label for="maquina">Máquina:</label>
                <input type="text" name="maquina">
            </div>
            <button type="submit">Guardar Nuevo Registro</button>
        </form>
    </div>
</div>

    


<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'crud.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#resultados').html(response);
                }
            });
        });

        // Abrir modal para agregar nuevo registro
        $('#nuevoRegistro').click(function() {
            $('#agregarModal').show();
        });
// Guardar nuevo registro al hacer clic en el botón "Guardar Nuevo Registro"
$('#agregarForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'agregar_usuario.php',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    $('#agregarModal').hide();
                    $('#searchForm').submit();
                }
            });
        });
        // Capturar clic en botón de editar
        $('#resultados').on('click', '.editar-btn', function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'editar_registro.php',
                data: { id: id },
                success: function(response) {
                    $('#editarForm').html(response);
                    $('#editarModal').show();
                }
            });
        });
        // Cerrar el modal al hacer clic en la X
        $('.close').click(function() {
            $('#editarModal, #agregarModal').hide();
        });
        // Cerrar el modal al hacer clic fuera de él
        $(window).click(function(event) {
            if (event.target == $('#editarModal')[0] || event.target == $('#agregarModal')[0]) {
                $('#editarModal, #agregarModal').hide();
            }
        });
        // Guardar los cambios al hacer clic en el botón "Guardar Cambios"
        $('#guardarEdicion').click(function() {
            $.ajax({
                type: 'POST',
                url: 'guardar_edicion.php',
                data: $('#editarForm').serialize(),
                success: function(response) {
                    alert(response);
                    $('#editarModal').hide();
                    $('#searchForm').submit();
                }
            });
        });
        // Capturar clic en botón de eliminar
        $('#resultados').on('click', '.eliminar-btn', function() {
            if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: 'eliminar_registro.php',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        // Recargar la tabla después de eliminar
                        $('#searchForm').submit();
                    }
                });
            }
        });
    });
</script>


<!-- Modal para agregar nuevo usuario -->
<div id="agregarUsuarioModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Agregar Nuevo Usuario</h2>
        <form id="agregarUsuarioForm" class="form" method="POST">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="rol">Tipo de Usuario:</label>
                <select name="rol" id="rol">
                    <option value="admin">Admin</option>
                    <option value="invitado">Invitado</option>
                </select>
            </div>
            <button type="submit">Agregar Usuario</button>
        </form>
    </div>
</div>
<script>
  // Abrir modal para agregar nuevo usuario
$('#nuevoUsuario').click(function() {
    $('#agregarUsuarioModal').show();
});

// Guardar nuevo usuario al hacer clic en el botón "Agregar Usuario"
$('#agregarUsuarioForm').submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'agregar_user.php',
        data: $(this).serialize(),
        success: function(response) {
            alert(response);
            $('#agregarUsuarioModal').hide();
        }
    });
});
// Cerrar el modal al hacer clic en la X
$('.close').click(function() {
    $('.modal').hide();
});

// Cerrar el modal al hacer clic fuera de él
$(window).click(function(event) {
    if (event.target.classList.contains('modal')) {
        $('.modal').hide();
    }
});

    </script>


</body>
</html>