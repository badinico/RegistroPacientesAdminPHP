<?php
// Archivo db.php - Conexión a la base de datos SQLite

try {
    // Crear una nueva conexión PDO a la base de datos SQLite
    $pdo = new PDO('sqlite:clinica.db');
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tablas si no existen
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS pacientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            apellido TEXT NOT NULL,
            rut TEXT NOT NULL,
            sexo TEXT NOT NULL,
            direccion TEXT NOT NULL,
            telefono TEXT NOT NULL,
            correo TEXT NOT NULL,
            motivo TEXT NOT NULL
        );
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT NOT NULL,
            clave TEXT NOT NULL
        );
    ");
} catch (PDOException $e) {
    // Mostrar mensaje de error si la conexión falla
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
