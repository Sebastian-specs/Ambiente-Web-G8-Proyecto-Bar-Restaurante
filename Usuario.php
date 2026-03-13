<?php
class Usuario {
    private $conn;
    private $table = 'usuarios';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($nombre, $email, $password, $rol = 'cliente') {
        $sql = "INSERT INTO {$this->table} (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':rol' => $rol
        ]);
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardarToken($email, $token, $expira) {
        $sql = "UPDATE {$this->table} SET token_recuperacion = :token, token_expira = :expira WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':token' => $token,
            ':expira' => $expira,
            ':email' => $email
        ]);
    }

    public function buscarPorToken($token) {
        $sql = "SELECT * FROM {$this->table} WHERE token_recuperacion = :token AND token_expira >= NOW() LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPassword($id, $password) {
        $sql = "UPDATE {$this->table}
                SET password = :password, token_recuperacion = NULL, token_expira = NULL
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':id' => $id
        ]);
    }
}