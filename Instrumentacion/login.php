<?php
$error = isset($_GET['error']) ? $_GET['error'] : ""; // Verificar si se pasó un error en la URL
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    
    <h2><img src="img/logo.png" alt="logo.png"></h2>
   
    <?php if(!empty($error)) { ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>
    <form action="verificar_login.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <label for="pass">Contraseña:</label>
        <input type="password" id="password" name="pass" required>
        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
