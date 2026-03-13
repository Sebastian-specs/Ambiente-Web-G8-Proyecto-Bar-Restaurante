<?php
function is_logged_in() {
    return isset($_SESSION['user']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: /proyecto-final/public/index.php?route=login');
        exit;
    }
}

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin';
}

function require_admin() {
    if (!is_admin()) {
        header('Location: /proyecto-final/public/index.php?route=dashboard');
        exit;
    }
}