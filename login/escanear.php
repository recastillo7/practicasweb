<?php
// Activa la visualización de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicia la sesión para manejar datos de usuario
session_start();

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si se ha proporcionado el parámetro 'lista_id' en la URL
if (!isset($_GET['lista_id'])) {
    echo "Error: lista_id no especificada.";
    exit();
}

// Convierte el parámetro 'lista_id' en un número entero para evitar inyecciones SQL
$lista_id = intval($_GET['lista_id']);
if ($lista_id <= 0) {
    echo "Error: ID de lista no válido.";
    exit();
}

// Consulta para obtener los datos de la lista con el ID proporcionado
$query = "SELECT * FROM listas WHERE id = $lista_id";
$resultado = mysqli_query($conexion, $query);

// Verifica si la lista existe
if ($fila = mysqli_fetch_assoc($resultado)) {
    $nombre_lista = $fila['nombre']; // Obtiene el nombre de la lista
} else {
    echo "Lista no encontrada.";
    exit();
}

// Si se envía el formulario para eliminar un registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    
    // Consulta para eliminar el registro con el ID proporcionado
    $query_delete = "DELETE FROM escaneos WHERE id = $delete_id";
    $resultado_delete = mysqli_query($conexion, $query_delete);
    
    // Muestra un mensaje de éxito o error según el resultado de la eliminación
    if ($resultado_delete) {
        echo "<p style='color: green; font-weight: bold;'>✅ Registro eliminado con éxito.</p>";
    } else {
        echo "<p style='color: red;'>❌ Error al eliminar el registro: " . mysqli_error($conexion) . "</p>";
    }
    
    // Recargar la página para actualizar la tabla
    header("Location: escanear.php?lista_id=$lista_id");
    exit();
}

// Si el formulario se envía (método POST), guarda los códigos en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapa los valores ingresados por el usuario para evitar inyecciones SQL
    $codigo1 = mysqli_real_escape_string($conexion, $_POST['codigo1']);
    $codigo2 = mysqli_real_escape_string($conexion, $_POST['codigo2']);
    
    // Inserta los códigos en la tabla 'escaneos'
    $query = "INSERT INTO escaneos (lista_id, codigo_1, codigo_2) VALUES ('$lista_id', '$codigo1', '$codigo2')";
    $resultado_insert = mysqli_query($conexion, $query);
    
    // Muestra un mensaje de éxito o error según el resultado de la inserción
    if ($resultado_insert) {
        echo "<p style='color: green; font-weight: bold;'>✅ Escaneo guardado con éxito.</p>";
    } else {
        echo "<p style='color: red;'>❌ Error al guardar el escaneo: " . mysqli_error($conexion) . "</p>";
    }
}

// Consulta para obtener los escaneos registrados en la lista
$res = mysqli_query($conexion, "SELECT * FROM escaneos WHERE lista_id = $lista_id ORDER BY fecha DESC");
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear códigos</title>
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Título de la página -->
<h2>📦 Escanear códigos para la lista: <?php echo htmlspecialchars($nombre_lista); ?></h2>

<!-- Formulario para ingresar los códigos -->
<div class="form-container">
    <form method="POST">
        <label for="codigo1">Código de producto:</label>
        <input type="text" name="codigo1" id="codigo1" required autofocus>

        <label for="codigo2">Número de serie:</label>
        <input type="text" name="codigo2" id="codigo2" required>

        <button type="submit" class="boton">Guardar escaneo</button>
    </form>
</div>

<!-- Tabla para mostrar los escaneos registrados -->
<h3>📄 Escaneos registrados</h3>
<table>
    <tr>
        <th>Código 1</th>
        <th>Código 2</th>
        <th>Fecha</th>
        <th>Acciones</th> <!-- Nueva columna -->
    </tr>
    <?php
    // Si hay registros, los muestra en la tabla
    if (mysqli_num_rows($res) > 0) {
        while ($esc = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>" . htmlspecialchars($esc['codigo_1']) . "</td>
                    <td>" . htmlspecialchars($esc['codigo_2']) . "</td>
                    <td>" . htmlspecialchars($esc['fecha']) . "</td>
                    <td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_id' value='" . $esc['id'] . "'>
                            <button type='submit' class='boton-eliminar'>❌ Eliminar</button>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        // Si no hay registros, muestra un mensaje
        echo "<tr><td colspan='4'>No hay escaneos registrados.</td></tr>";
    }
    ?>
</table>

<!-- Enlace para volver a la página de listas -->
<div class="volver">
    <a href="listas.php">← Volver a las Listas</a>
</div>

<!-- Enlace para exportar la lista a un archivo -->
<a href="exportar_lista.php?lista_id=<?php echo $lista_id; ?>" class="boton">📥 Descargar en Excel</a>

<!-- Pie de página -->
<footer class="footer">
  <div class="footer-content">
    <p>© <?php echo date("Y"); ?> Todos los derechos reservados.</p>
    <p>Desarrollado con 💻 por <strong>Rolando Castillo</strong></p>
  </div>
</footer>

</body>
</html>
