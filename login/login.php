<?php
// Inicia la sesión para manejar datos de usuario
session_start();

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si el formulario fue enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos ingresados por el usuario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para buscar al usuario en la base de datos
    $query = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = mysqli_query($conexion, $query);

    // Verifica si se encontró un usuario con el nombre ingresado
    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);

        // Verifica si la contraseña ingresada coincide con la almacenada (usando `password_verify`)
        if (password_verify($contrasena, $fila['contrasena'])) {
            // Si la contraseña es correcta, guarda el usuario en la sesión y redirige al panel
            $_SESSION['usuario'] = $usuario;
            header("Location: panel.php");
            exit();
        } else {
            // Si la contraseña es incorrecta, muestra un mensaje de error
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        // Si no se encuentra el usuario, muestra un mensaje de error
        $error = "❌ Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <h2>🔐 Iniciar sesión</h2>

            <!-- Muestra un mensaje de error si existe -->
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Formulario para iniciar sesión -->
            <form method="POST" action="">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>

            <!-- Enlace para registrarse si no tiene cuenta -->
            <div class="bottom-link">
                <p>¿No tienes cuenta? <a href="registrar.php">Registrarse</a></p>
            </div>
        </div>
    </div>
    
    <!-- Pie de página -->
    <footer>
        <p>© <?php echo date("Y"); ?> Todos los derechos reservados.</p>
        <p>Desarrollado con 💻 por <strong>Rolando Castillo</strong></p>
    </footer>
</body>
</html>
