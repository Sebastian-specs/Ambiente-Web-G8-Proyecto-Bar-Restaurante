<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Recuperar contraseña</h3>
                <form method="POST" action="/proyecto-final/public/index.php?route=forgot.post">
                    <div class="mb-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button class="btn btn-warning w-100">Generar enlace</button>
                </form>
                <p class="mt-3 text-muted small">Para pruebas, el enlace se guarda en un archivo local.</p>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>