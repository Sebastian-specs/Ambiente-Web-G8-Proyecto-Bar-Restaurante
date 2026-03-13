<?php
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

            // Simulación de notificación por correo
            file_put_contents(__DIR__ . '/../../tmp_reset_link.txt',
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