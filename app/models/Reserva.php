<?php
class Reserva {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($usuario_id, $fecha, $hora, $personas, $comentario) {
        $stmt = $this->conn->prepare("CALL sp_insertar_reserva(:usuario_id, :fecha, :hora, :personas, :comentario)");
        return $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':personas' => $personas,
            ':comentario' => $comentario
        ]);
    }

    public function listarTodas() {
        $stmt = $this->conn->prepare("CALL sp_listar_reservas()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT * FROM reservas WHERE usuario_id = :usuario_id ORDER BY fecha DESC, hora DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id, $estado) {
        $sql = "UPDATE reservas SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $id
        ]);
    }
}