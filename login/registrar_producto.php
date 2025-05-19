<?php
// Inicia la sesión para manejar datos de usuario
session_start();

// Verifica si el usuario ha iniciado sesión, si no, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html"); // Redirige al archivo index.html si no hay sesión activa
    exit(); // Detiene la ejecución del script
}

// Establece la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "login_db");

// Obtiene los datos enviados desde el formulario
$codigo = $_POST['codigo']; // Código del producto
$nombre = $_POST['nombre']; // Nombre del producto

// Prepara la consulta SQL para insertar el producto en la base de datos
$query = "INSERT INTO productos (codigo, nombre) VALUES ('$codigo', '$nombre')";

// Ejecuta la consulta y verifica si fue exitosa
if (mysqli_query($conexion, $query)) {
    // Si la consulta fue exitosa, muestra un mensaje de éxito
    echo "✅ Producto registrado correctamente.";
} else {
    // Si ocurrió un error, muestra un mensaje de error
    echo "❌ Error al registrar producto.";
}

// Muestra un enlace para volver a la página de productos
echo "<br><a href='productos.php'>← Volver</a>";
?>
