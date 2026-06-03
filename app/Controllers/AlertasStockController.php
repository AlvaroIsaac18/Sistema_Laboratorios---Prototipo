<?php
namespace App\Controllers;

require_once 'app/Models/InsumosModel.php';
use App\Models\InsumosModel;

$model = new InsumosModel();
$insumos = $model->getAll();

$agotados = [];
$stockBajo = [];
$proximoVencer = [];

foreach ($insumos as $insumo) {
    $disp = (float)($insumo['cantidadDispInsumos'] ?? 0);
    $min = (float)($insumo['cantidadMinInsumos'] ?? 0);

    if ($disp <= 0) {
        $agotados[] = $insumo;
    } elseif ($disp <= $min) {
        $stockBajo[] = $insumo;
    }

    $descrip = $insumo['descripInsumos'] ?? '';
    if (preg_match('/Vence:\s*(\d{4}-\d{2}-\d{2})/', $descrip, $m)) {
        $fechaVence = strtotime($m[1]);
        $diasRestantes = ($fechaVence - time()) / 86400;
        if ($diasRestantes <= 30 && $diasRestantes >= 0) {
            $insumo['diasRestantes'] = (int)$diasRestantes;
            $insumo['fechaVence'] = $m[1];
            $proximoVencer[] = $insumo;
        }
    }
}

$pageTitle = "Alertas de Stock - Sistema de Laboratorios";
$activeRoute = "alertasStock";
$viewPath = "app/Views/alertasStock.php";
include "app/Views/layouts/main.php";
