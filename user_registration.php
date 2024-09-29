<?php
require 'db.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = strtoupper($_POST['usuario']); // Convertir el nombre de usuario a mayúsculas
    $clave = strtolower($_POST['clave']); // Convertir la clave a minúsculas

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, clave) VALUES (?, ?)");
        $stmt->execute([$usuario, $clave]);

        http_response_code(200);
        echo "Usuario registrado correctamente";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Error al registrar usuario";
    }
}
?>
