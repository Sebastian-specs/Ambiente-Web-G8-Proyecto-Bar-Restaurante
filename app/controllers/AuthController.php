<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../helpers/utils.php';

class AuthController {
    private $usuario;

    public function __construct($db) {
        $this->usuario = new Usuario($db);
    }

    public function showLogin() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        $email = clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            set_flash('danger', 'Debe completar todos los campos.');
            redirect('/proyecto-final/public/index.php?route=login');
        }

        $user = $this->usuario->buscarPorEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'email' => $user['email'],
                'rol' => $user['rol']
            ];

            set_flash('success', 'Bienvenido, ' . $user['nombre']);
            redirect('/proyecto-final/public/index.php?route=dashboard');
        }

        set_flash('danger', 'Credenciales incorrectas.');
        redirect('/proyecto-final/public/index.php?route=login');
    }

    public function showRegister() {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function register() {
        $nombre = clean($_POST['nombre'] ?? '');
        $email = clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if (empty($nombre) || empty($email) || empty($password) || empty($confirm)) {
            set_flash('danger', 'Todos los campos son obligatorios.');
            redirect('/proyecto-final/public/index.php?route=register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash('danger', 'Correo electrónico inválido.');
            redirect('/proyecto-final/public/index.php?route=register');
        }

        if ($password !== $confirm) {
            set_flash('danger', 'Las contraseñas no coinciden.');
            redirect('/proyecto-final/public/index.php?route=register');
        }

        if ($this->usuario->buscarPorEmail($email)) {
            set_flash('warning', 'Ese correo ya está registrado.');
            redirect('/proyecto-final/public/index.php?route=register');
        }

        $this->usuario->crear($nombre, $email, $password, 'cliente');
        set_flash('success', 'Registro exitoso. Ahora puede iniciar sesión.');
        redirect('/proyecto-final/public/index.php?route=login');
    }

    public function logout() {
        session_destroy();
        redirect('/proyecto-final/public/index.php?route=login');
    }

    public function showForgot() {
        require_once __DIR__ . '/../views/auth/forgot.php';
    }

    public function forgot() {
        $email = clean($_POST['email'] ?? '');
        $user = $this->usuario->buscarPorEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(16));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $this->usuario->guardarToken($email, $token, $expira);

            file_put_contents(
                __DIR__ . '/../../tmp_reset_link.txt',
                'Enlace de recuperación: http://localhost/proyecto-final/public/index.php?route=reset&token=' . $token
            );
        }

        set_flash('info', 'Si el correo existe, se generó un enlace de recuperación.');
        redirect('/proyecto-final/public/index.php?route=forgot');
    }

    public function showReset() {
        require_once __DIR__ . '/../views/auth/reset.php';
    }

    public function reset() {
        $token = clean($_POST['token'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            set_flash('danger', 'Las contraseñas no coinciden.');
            redirect('/proyecto-final/public/index.php?route=reset&token=' . $token);
        }

        $user = $this->usuario->buscarPorToken($token);

        if (!$user) {
            set_flash('danger', 'Token inválido o expirado.');
            redirect('/proyecto-final/public/index.php?route=forgot');
        }

        $this->usuario->actualizarPassword($user['id'], $password);
        set_flash('success', 'Contraseña actualizada correctamente.');
        redirect('/proyecto-final/public/index.php?route=login');
    }
}