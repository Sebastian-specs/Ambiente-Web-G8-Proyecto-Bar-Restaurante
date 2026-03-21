<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Registrar reserva</h3>
                <form method="POST" action="/proyecto-final/public/index.php?route=reservas.store" id="formReserva">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Hora</label>
                            <input type="time" name="hora" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Cantidad de personas</label>
                        <input type="number" name="personas" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label>Comentario</label>
                        <textarea name="comentario" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Guardar reserva</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>