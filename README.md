
# Sistema de Registro para Clínica El Bienestar

Este es un sistema web para registrar pacientes y usuarios administrativos en la Clínica El Bienestar. El sistema permite gestionar de manera eficiente la información de los pacientes y del personal administrativo mediante formularios y tablas.

## Requerimientos

- **PHP 7.3 o superior**
- **Servidor Web** (como Apache o Nginx)
- **SQLite3** como base de datos
- **Bootstrap 5** para el diseño frontend
- **Font Awesome** para los íconos

## Despliegue

Para desplegar el proyecto en tu entorno local, sigue los siguientes pasos:

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/tu-usuario/RegistroPacientesAdminPHP.git
   cd RegistroPacientesAdminPHP
   ```

2. **Configurar el servidor web**:
   - Asegúrate de que PHP esté correctamente configurado.
   - Coloca los archivos en el directorio raíz de tu servidor web.
   - Si usas Apache, puedes colocar el proyecto en la carpeta `htdocs` o configurarlo en un **VirtualHost**.

3. **Iniciar el servidor PHP embebido (opcional)**:
   Si no tienes un servidor como Apache, puedes usar el servidor embebido de PHP:
   ```bash
   php -S localhost:8000
   ```

4. **Acceder a la aplicación**:
   Abre tu navegador y navega a `http://localhost:8000`.

## Configuraciones

El archivo `db.php` gestiona la conexión a la base de datos SQLite. El sistema crea automáticamente las tablas necesarias en la base de datos `clinica.db`.

Si necesitas cambiar la ubicación de la base de datos o utilizar otro sistema de gestión de base de datos, ajusta las configuraciones en el archivo `db.php`.

### Estructura del proyecto

```
clinica-bienestar/
├── db.php                     # Configuración y conexión a la base de datos
├── index.php                  # Página principal con formularios y tablas
├── patient_registration.php    # Lógica de registro de pacientes
├── user_registration.php       # Lógica de registro de usuarios administrativos
├── delete_patient.php          # Lógica para eliminar pacientes
├── delete_user.php             # Lógica para eliminar usuarios
├── README.md                   # Este archivo
└── clinica.db                  # Base de datos SQLite (se crea automáticamente)
```

## Funcionalidades

### Registro de Pacientes

- Completa el formulario con los datos de los pacientes.
- El formulario incluye campos para nombre, apellido, RUT, sexo, dirección, teléfono, correo y motivo de consulta.
- Se muestra una tabla con todos los pacientes registrados.
- Puedes ver el motivo de la consulta en un modal al hacer clic en el ícono de mensaje.

### Registro de Usuarios Administrativos

- Completa el formulario con el nombre de usuario y la clave del personal administrativo.
- El nombre de usuario tiene un máximo de 10 caracteres en mayúsculas y la clave debe tener un mínimo de 8 caracteres.
- Se muestra una tabla con todos los usuarios registrados.
