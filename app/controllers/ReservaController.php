<?php
require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../helpers/utils.php';

class ReservaController {
    private $reserva;

    public function __construct($db) {
        $this->reserva = new Reserva($db);
    }

    public function createView() {
        require_once __DIR__ . '/../views/reservas/create.php';
    }

    public function store() {
        $fecha = clean($_POST['fecha'] ?? '');
        $hora = clean($_POST['hora'] ?? '');
        $personas = (int)($_POST['personas'] ?? 0);
        $comentario = clean($_POST['comentario'] ?? '');
        $usuario_id = $_SESSION['user']['id'];

        if (empty($fecha) || empty($hora) || $personas <= 0) {
            set_flash('danger', 'Debe completar correctamente los datos de la reserva.');
            redirect('/proyecto-final/public/index.php?route=reservas.create');
        }

        $this->reserva->crear($usuario_id, $fecha, $hora, $personas, $comentario);
        set_flash('success', 'Reserva registrada correctamente.');
        redirect('/proyecto-final/public/index.php?route=reservas.list');
    }

    public function list() {
        if ($_SESSION['user']['rol'] === 'admin') {
            $reservas = $this->reserva->listarTodas();
        } else {
            $reservas = $this->reserva->listarPorUsuario($_SESSION['user']['id']);
        }

        require_once __DIR__ . '/../views/reservas/list.php';
    }

    public function updateStatus() {
        if ($_SESSION['user']['rol'] !== 'admin') {
            set_flash('danger', 'Acceso denegado.');
            redirect('/proyecto-final/public/index.php?route=dashboard');
        }

        $id = (int)($_POST['id'] ?? 0);
        $estado = clean($_POST['estado'] ?? 'pendiente');
        $permitidos = ['pendiente','aprobada','rechazada'];

        if ($id > 0 && in_array($estado, $permitidos)) {
            $this->reserva->cambiarEstado($id, $estado);
            set_flash('success', 'Estado actualizado correctamente.');
        }

        redirect('/proyecto-final/public/index.php?route=reservas.list');
    }
}