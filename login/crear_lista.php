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

// Comprueba si el método de la solicitud es POST (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el ID máximo actual de la tabla "listas"
    $resultado = mysqli_query($conexion, "SELECT MAX(id) AS max_id FROM listas");
    $fila = mysqli_fetch_assoc($resultado);
    $nuevo_id = $fila['max_id'] + 1; // Calcula el nuevo ID incrementándolo en 1

    // Genera un código único de 6 dígitos basado en el nuevo ID
    $codigo = str_pad($nuevo_id, 6, "0", STR_PAD_LEFT);

    // Genera un nombre para la lista basado en el código
    $nombre = "Lista " . $codigo;

    // Inserta la nueva lista en la base de datos
    $query = "INSERT INTO listas (codigo, nombre) VALUES ('$codigo', '$nombre')";
    if (mysqli_query($conexion, $query)) {
        // Si la inserción es exitosa, muestra un mensaje de éxito con HTML
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lista creada</title>
            <style>
                body {
                    margin: 0;
                    font-family: 'Segoe UI', sans-serif;
                    background: linear-gradient(to right, #0f172a, #1e293b);
                    color: #fff;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    padding: 20px;
                }

                .mensaje {
                    background-color: #22c55e;
                    padding: 20px 30px;
                    border-radius: 10px;
                    font-size: 18px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    text-align: center;
                }

                .boton {
                    margin-top: 20px;
                    display: inline-block;
                    padding: 12px 24px;
                    background-color: #2563eb;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: bold;
                    transition: background 0.3s ease;
                }

                .boton:hover {
                    background-color: #1d4ed8;
                    transform: scale(1.05);
                }
            </style>
        </head>
        <body>
            <div class='mensaje'>
                ✅ Lista creada automáticamente con código: <strong>$codigo</strong>
            </div>
            <a href='listas.php' class='boton'>← Ver todas las listas</a>
        </body>
        </html>";
        exit(); // Termina la ejecución del script
    } else {
        // Si ocurre un error al insertar, muestra un mensaje de error
        echo "❌ Error al crear lista.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Crear Lista Automática</title>

</head>
<body>

  <!-- Título de la página -->
  <h2>🆕 Crear nueva lista automáticamente</h2>

  <!-- Formulario para enviar la solicitud de creación de lista -->
  <form method="POST">
    <button type="submit">Generar nueva lista</button>
  </form>

  <!-- Enlace para volver a la página de listas -->
  <div class="volver">
    <a href="listas.php">← Volver</a>
  </div>

  <!-- Pie de página -->
  <footer>
    <p>© <?php echo date("Y"); ?> Todos los derechos reservados.</p>
    <p>Desarrollado con 💻 por <strong>Rolando Castillo</strong></p>
  </footer>

</body>
</html>
