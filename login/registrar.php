<?php
include 'db.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Hashear contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Verificar si el usuario ya existe
$check = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
if (mysqli_num_rows($check) > 0) {
    echo "❌ El usuario ya existe.";
    exit();
}

// Insertar nuevo usuario
$query = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$hash')";
if (mysqli_query($conexion, $query)) {
    echo "✅ Usuario registrado. <a href='index.html'>Iniciar sesión</a>";
} else {
    echo "❌ Error al registrar.";
}
?>
