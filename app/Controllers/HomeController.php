<?php
namespace App\Controllers;

require_once 'app/Models/InsumosModel.php';
use App\Models\InsumosModel;

$model = new InsumosModel();
$insumos = $model->getAll();

$insumosCriticos = 0;
$stockBajo = [];

foreach ($insumos as $insumo) {
    $disp = (float)($insumo['cantidadDispInsumos'] ?? 0);
    $min = (float)($insumo['cantidadMinInsumos'] ?? 0);
    if ($disp <= $min) {
        $insumosCriticos++;
    }
    if ($disp <= 0) {
        $stockBajo[] = $insumo;
    }
}

$pageTitle = "Inicio - Dirección de Formación";
$activeRoute = "home";
$viewPath = "app/Views/home.php";
include "app/Views/layouts/main.php";
