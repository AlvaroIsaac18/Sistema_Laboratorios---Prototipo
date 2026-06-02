<?php
namespace App\Controllers;

require_once 'app/Models/GestionUsuariosModel.php';
use App\Models\GestionUsuariosModel;

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$rol = $_GET['rol'] ?? $_POST['rol'] ?? '';

if ($id <= 0 || $rol === '') {
    header('Location: index.php?route=gestionUsuarios');
    exit;
}

$model = new GestionUsuariosModel();
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($model->softDelete($id, $rol)) {
        $_SESSION['success_message'] = 'Usuario desactivado exitosamente.';
        header('Location: index.php?route=gestionUsuarios');
        exit;
    } else {
        $errorMessage = 'Error al desactivar el usuario.';
    }
}

$usuario = $model->getById($id, $rol);
if (!$usuario) {
    header('Location: index.php?route=gestionUsuarios');
    exit;
}

$pageTitle = "Desactivar Usuario";
$activeRoute = "gestionUsuarios";
$viewPath = "app/Views/eliminarUsuario.php";
include "app/Views/layouts/main.php";
