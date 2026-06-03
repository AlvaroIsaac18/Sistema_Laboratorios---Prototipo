<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/MantenimientoModel.php';

use App\Models\MantenimientoModel;

$model = new MantenimientoModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipoAnomalia'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    if ($tipo && $descripcion) {
        $model->create(1, $descripcion, $tipo, 1);
        header("Location: index.php?route=mantenimientoLabs&success=1");
        exit;
    }
}

$anomalias = $model->getAllAnomalias();
$totalMantenimientos = $model->getCount();
$success = $_GET['success'] ?? 0;

$pageTitle = "Mantenimiento - Sistema de Laboratorios";
$activeRoute = "mantenimientoLabs";
$viewPath = "app/Views/mantenimientoLabs.php";
include "app/Views/layouts/main.php";
