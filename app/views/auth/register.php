<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Registro de usuario</h3>
                <form method="POST" action="/proyecto-final/public/index.php?route=register.post">
                    <div class="mb-3">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button class="btn btn-success w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>