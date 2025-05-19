<?php
// Inicia la sesión para verificar si el usuario está autenticado
session_start();

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si el usuario ha iniciado sesión, si no, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html"); // Redirige al archivo index.html
    exit(); // Detiene la ejecución del script
}

// Verifica si se ha proporcionado el parámetro 'lista_id' en la URL
if (!isset($_GET['lista_id'])) {
    die("Lista no especificada."); // Muestra un mensaje de error y detiene la ejecución
}

// Convierte el parámetro 'lista_id' en un número entero para evitar inyecciones SQL
$lista_id = intval($_GET['lista_id']);

// Consulta para obtener el nombre de la lista con el ID proporcionado
$lista_query = mysqli_query($conexion, "SELECT nombre FROM listas WHERE id = $lista_id");
$lista = mysqli_fetch_assoc($lista_query); // Obtiene los resultados de la consulta como un arreglo asociativo
$nombre_lista = $lista['nombre'] ?? 'lista_exportada'; // Si no se encuentra un nombre, usa 'lista_exportada' como predeterminado

// Consulta para obtener los datos de los escaneos asociados a la lista
$query = "SELECT codigo_1, codigo_2, fecha FROM escaneos WHERE lista_id = $lista_id ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $query); // Ejecuta la consulta

// Configura los encabezados HTTP para forzar la descarga del archivo como CSV
header('Content-Type: text/csv; charset=utf-8'); // Especifica el tipo de contenido como CSV
header('Content-Disposition: attachment; filename=' . $nombre_lista . '.csv'); // Define el nombre del archivo descargado

// Crea un archivo CSV en la salida estándar (php://output)
$output = fopen('php://output', 'w'); // Abre un flujo de escritura hacia la salida estándar

// Escribe la fila de encabezados en el archivo CSV
fputcsv($output, ['Código 1', 'Código 2', 'Fecha']); // Encabezados de las columnas

// Itera sobre los resultados de la consulta y escribe cada fila en el archivo CSV
while ($fila = mysqli_fetch_assoc($resultado)) {
    fputcsv($output, [$fila['codigo_1'], $fila['codigo_2'], $fila['fecha']]); // Escribe los datos de cada fila
}

// Cierra el flujo de escritura
fclose($output);

// Termina la ejecución del script
exit();
?>
