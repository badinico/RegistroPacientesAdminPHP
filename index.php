<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pacientes y Usuarios Administrativos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="container mt-5">
        <!-- Título principal -->
        <h1 class="text-center">Sistema de Registro para Clínica El Bienestar</h1>
        <p class="text-center text-muted">Registra a pacientes y personal administrativo de manera sencilla y eficiente.</p>

        <!-- Card para Registro de Pacientes -->
        <div class="row mt-5">
            <div class="col-12 col-md-6 mb-4">
                <!-- Card para el formulario de pacientes -->
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="mb-4">Registro de Pacientes</h2>
                        <p>Por favor, ingrese los datos del paciente que serán registrados en nuestro sistema.</p>
                        <form id="patientForm" onsubmit="submitPatientForm(event)">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa el nombre" minlength="3" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingresa el apellido" minlength="3" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="rut">RUT (Ej: 12.345.678-9):</label>
                                <input type="text" id="rut" name="rut" class="form-control" placeholder="Ej: 12.345.678-9" pattern="\d{1,2}\.\d{3}\.\d{3}-[\dkK]" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sexo">Sexo:</label>
                                <select id="sexo" name="sexo" class="form-control" required>
                                    <option value="" disabled selected>Selecciona el sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección:</label>
                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa la dirección" minlength="3" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono (Ej: +56912345678):</label>
                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ej: +56912345678" pattern="\+569\d{8}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="correo">Correo Electrónico:</label>
                                <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingresa el correo" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="motivo">Motivo de la Consulta:</label>
                                <textarea id="motivo" name="motivo" class="form-control" placeholder="Describe el motivo de la consulta" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Registrar Paciente</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de Pacientes Registrados -->
            <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="text-center">Pacientes Registrados</h3>
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>RUT</th>
                                    <th>Sexo</th>
                                    <th>Motivo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="patientTable">
                                <?php
                                require 'db.php'; // Conexión a la base de datos
                                $stmt = $pdo->query("SELECT * FROM pacientes");
                                while ($row = $stmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td>{$row['nombre']}</td>";
                                    echo "<td>{$row['apellido']}</td>";
                                    echo "<td>{$row['rut']}</td>";
                                    echo "<td>{$row['sexo']}</td>";
                                    // Columna de Motivo con ícono para abrir modal (Font Awesome)
                                    echo "<td><button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#motivoModal{$row['id']}'><i class='fas fa-comment-dots'></i></button></td>";
                                    echo "<td><button class='btn btn-danger btn-sm' onclick='deletePatient({$row['id']})'>Eliminar</button></td>";
                                    echo "</tr>";

                                    // Modal para mostrar el motivo de la consulta
                                    echo "
                                    <div class='modal fade' id='motivoModal{$row['id']}' tabindex='-1' aria-labelledby='motivoModalLabel{$row['id']}' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='motivoModalLabel{$row['id']}'>Motivo de la Consulta</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    {$row['motivo']}
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card para Registro de Usuarios Administrativos -->
        <div class="row mt-5">
            <div class="col-12 col-md-6 mb-4">
                <!-- Card para el formulario de usuarios -->
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="mb-4">Registro de Usuarios Administrativos</h2>
                        <p>Registre a los usuarios del personal administrativo con un nombre de usuario y clave.</p>
                        <form id="userForm" onsubmit="submitUserForm(event)">
                            <div class="form-group mb-3">
                                <label for="usuario">Nombre de Usuario (Máx 10 caracteres):</label>
                                <input type="text" id="usuario" name="usuario" maxlength="10" class="form-control" placeholder="Ingresa el usuario" style="text-transform:uppercase;" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="clave">Clave (Mínimo 8 caracteres):</label>
                                <input type="password" id="clave" name="clave" minlength="8" class="form-control" placeholder="Ingresa la clave" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Registrar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de Usuarios Registrados -->
            <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="text-center">Usuarios Registrados</h3>
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Clave</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="userTable">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM usuarios");
                                while ($row = $stmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td>{$row['usuario']}</td>";
                                    echo "<td>{$row['clave']}</td>";
                                    echo "<td><button class='btn btn-danger btn-sm' onclick='deleteUser({$row['id']})'>Eliminar</button></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript para manejar los formularios y la eliminación -->
    <script>
        function submitPatientForm(event) {
            event.preventDefault(); // Evitar el comportamiento por defecto del formulario

            $.ajax({
                url: 'patient_registration.php',
                type: 'POST',
                data: $('#patientForm').serialize(),
                success: function(response) {
                    location.reload(); // Recargar la página después de un envío exitoso
                },
                error: function() {
                    alert('Error al registrar paciente');
                }
            });
        }

        function submitUserForm(event) {
            event.preventDefault();

            $.ajax({
                url: 'user_registration.php',
                type: 'POST',
                data: $('#userForm').serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    alert('Error al registrar usuario');
                }
            });
        }

        function deletePatient(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este paciente?')) {
                $.ajax({
                    url: 'delete_patient.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert('Error al eliminar paciente');
                    }
                });
            }
        }

        function deleteUser(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert('Error al eliminar usuario');
                    }
                });
            }
        }
    </script>
</body>
</html>
