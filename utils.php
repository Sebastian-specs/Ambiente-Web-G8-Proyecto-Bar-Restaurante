<?php
function redirect($url) {
    header("Location: $url");
    exit;
}

function base_url($path = '') {
    $base = '/proyecto-final/public';
    return $base . $path;
}

function clean($text) {
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

function set_flash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function get_flash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}