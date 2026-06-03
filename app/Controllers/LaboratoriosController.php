<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/LaboratoriosModel.php';

use App\Models\LaboratoriosModel;

$model = new LaboratoriosModel();
$laboratorios = $model->getAll();
$resumen = $model->getResumen();

$pageTitle = "Laboratorios - Sistema de Laboratorios";
$activeRoute = "laboratorios";
$viewPath = "app/Views/laboratorios.php";
include "app/Views/layouts/main.php";
