<?php require_once __DIR__ . '/../../helpers/utils.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema SC-502</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/proyecto-final/public/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/proyecto-final/public/index.php?route=dashboard">Sistema PHP MVC</a>
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <span class="text-white me-3"><?= $_SESSION['user']['nombre'] ?> (<?= $_SESSION['user']['rol'] ?>)</span>
                <a class="btn btn-outline-light btn-sm" href="/proyecto-final/public/index.php?route=logout">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-4">
<?php $flash = get_flash(); ?>
<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
        <?= $flash['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>