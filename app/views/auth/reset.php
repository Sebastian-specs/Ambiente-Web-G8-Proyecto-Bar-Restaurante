<?php include __DIR__ . '/../layout/header.php'; ?>
<?php $token = $_GET['token'] ?? ''; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Restablecer contraseña</h3>
                <form method="POST" action="/proyecto-final/public/index.php?route=reset.post">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                    <div class="mb-3">
                        <label>Nueva contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Actualizar contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>