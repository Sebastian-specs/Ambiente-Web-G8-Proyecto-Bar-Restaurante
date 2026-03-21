<?php
session_start();

require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/helpers/utils.php';
require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/ReservaController.php';

$db = (new Database())->getConnection();

$authController = new AuthController($db);
$reservaController = new ReservaController($db);
$dashboardController = new DashboardController();

$route = $_GET['route'] ?? 'login';

switch ($route) {
    case 'login':
        $authController->showLogin();
        break;

    case 'login.post':
        $authController->login();
        break;

    case 'register':
        $authController->showRegister();
        break;

    case 'register.post':
        $authController->register();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'forgot':
        $authController->showForgot();
        break;

    case 'forgot.post':
        $authController->forgot();
        break;

    case 'reset':
        $authController->showReset();
        break;

    case 'reset.post':
        $authController->reset();
        break;

    case 'dashboard':
        require_login();
        $dashboardController->index();
        break;

    case 'reservas.create':
        require_login();
        $reservaController->createView();
        break;

    case 'reservas.store':
        require_login();
        $reservaController->store();
        break;

    case 'reservas.list':
        require_login();
        $reservaController->list();
        break;

    case 'reservas.status':
        require_login();
        $reservaController->updateStatus();
        break;

    default:
        echo 'Ruta no encontrada';
        break;
}