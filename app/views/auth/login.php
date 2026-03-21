<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Iniciar sesión</h3>
                <form method="POST" action="/proyecto-final/public/index.php?route=login.post">
                    <div class="mb-3">
                        <label>Correo</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Ingresar</button>
                </form>
                <div class="mt-3 d-flex justify-content-between">
                    <a href="/proyecto-final/public/index.php?route=register">Crear cuenta</a>
                    <a href="/proyecto-final/public/index.php?route=forgot">Olvidé mi contraseña</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>