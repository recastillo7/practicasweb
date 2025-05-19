<?php
// Inicia la sesión para manejar datos de usuario
session_start();

// Verifica si el usuario ha iniciado sesión, si no, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html"); // Redirige al archivo index.html
    exit(); // Detiene la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace al archivo CSS externo -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Contenedor principal -->
  <div class="container">
    <!-- Muestra un mensaje de bienvenida con el nombre del usuario -->
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> 😎</h2>

    <!-- Lista de opciones del panel -->
    <ul>
      <li><a href="listas.php">📋 Listas independientes</a></li>
      <li><a href="crear_lista.php">➕ Crear lista</a></li>
      <li><a href="logout.php">🔒 Cerrar sesión</a></li>
    </ul>
  </div>

  <!-- Pie de página -->
  <footer>
    <p>© <?php echo date("Y"); ?> Todos los derechos reservados.</p>
    <p>Desarrollado con 💻 por <strong>Rolando Castillo</strong></p>
  </footer>

</body>
</html>
