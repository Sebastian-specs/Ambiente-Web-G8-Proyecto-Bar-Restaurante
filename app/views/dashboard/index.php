<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="p-4 bg-light rounded shadow-sm">
    <h2>Bienvenido al sistema</h2>
    <p>Este sistema cumple con los requerimientos del proyecto: MVC, PHP, jQuery, Bootstrap, MySQL, usuarios, autenticación, recuperación de contraseña y reservas.</p>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Nueva reserva</h5>
                    <p>Registrar una nueva reserva en el sistema.</p>
                    <a href="/proyecto-final/public/index.php?route=reservas.create" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Ver reservas</h5>
                    <p>Consultar las reservas registradas.</p>
                    <a href="/proyecto-final/public/index.php?route=reservas.list" class="btn btn-success">Ir</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Rol activo</h5>
                    <p>
                        <?= isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin'
                            ? 'Administrador con control total.'
                            : 'Cliente con acceso a sus reservas.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>