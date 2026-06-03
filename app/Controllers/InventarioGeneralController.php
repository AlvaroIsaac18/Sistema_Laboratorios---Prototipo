<?php
namespace App\Controllers;

require_once 'app/Models/InsumosModel.php';
use App\Models\InsumosModel;

$successMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$model = new InsumosModel();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $model->delete((int)$_GET['id']);
    $_SESSION['success_message'] = 'Insumo eliminado correctamente.';
    header('Location: index.php?route=inventarioGeneral');
    exit;
}

$insumos = $model->getAll();

$pageTitle = "Inventario General - Sistema de Laboratorios";
$activeRoute = "inventarioGeneral";
$viewPath = "app/Views/inventarioGeneral.php";
include "app/Views/layouts/main.php";
