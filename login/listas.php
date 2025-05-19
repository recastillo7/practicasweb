<?php
// Activa la visualización de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicia la sesión para manejar datos de usuario
session_start();

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si el usuario ha iniciado sesión, si no, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

// Consulta para obtener todas las listas ordenadas por ID de forma descendente
$query = "SELECT * FROM listas ORDER BY id DESC";
$resultado = mysqli_query($conexion, $query); // Ejecuta la consulta
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listas de escaneo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace al archivo CSS externo -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Título de la página -->
  <h2>📋 Listas de Escaneo</h2>

  <!-- Tabla para mostrar las listas -->
  <table>
    <tr>
      <th>Código</th>
      <th>Nombre</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
    <?php
    // Verifica si hay resultados en la consulta
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Itera sobre cada fila de resultados y las muestra en la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>{$fila['codigo']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['fecha']}</td>
                    <td>
                        <a class='boton' href='escanear.php?lista_id={$fila['id']}'>Escanear</a>
                    </td>
                  </tr>";
        }
    } else {
        // Si no hay listas registradas, muestra un mensaje
        echo "<tr><td colspan='4'>No hay listas registradas.</td></tr>";
    }
    ?>
  </table>

  <!-- Botón para volver al panel -->
  <div class="volver">
    <a href="panel.php" class="boton">⬅️ Volver al Panel</a>
  </div>

  <!-- Pie de página -->
  <footer>
    <p>© <?php echo date("Y"); ?> Todos los derechos reservados.</p>
    <p>Desarrollado con 💻 por <strong>Rolando Castillo</strong></p>
  </footer>

</body>
</html>
