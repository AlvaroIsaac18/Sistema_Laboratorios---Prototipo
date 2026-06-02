<?php
namespace App\Controllers;

require_once 'app/Models/GestionUsuariosModel.php';
use App\Models\GestionUsuariosModel;

$successMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$model = new GestionUsuariosModel();
$usuarios = $model->getAll();

$pageTitle = "Gestión de Usuarios";
$activeRoute = "gestionUsuarios";
$viewPath = "app/Views/gestionUsuarios.php";
include "app/Views/layouts/main.php";
