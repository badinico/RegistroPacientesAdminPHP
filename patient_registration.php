<?php
require 'db.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rut = $_POST['rut'];
    $sexo = $_POST['sexo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $motivo = $_POST['motivo'];

    try {
        // Preparar la inserción en la base de datos
        $stmt = $pdo->prepare("INSERT INTO pacientes (nombre, apellido, rut, sexo, direccion, telefono, correo, motivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $rut, $sexo, $direccion, $telefono, $correo, $motivo]);

        // Enviar respuesta exitosa
        http_response_code(200);
        echo "Paciente registrado correctamente";
    } catch (Exception $e) {
        // Enviar error si algo falla
        http_response_code(500);
        echo "Error al registrar paciente";
    }
}
?>
