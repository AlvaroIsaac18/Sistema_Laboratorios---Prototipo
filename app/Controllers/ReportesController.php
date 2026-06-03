<?php
namespace App\Controllers;

require_once 'app/Models/ReportesModel.php';
use App\Models\ReportesModel;

$model = new ReportesModel();
$usoLaboratorios = $model->getUsoLaboratorios();
$stockResumen = $model->getStockResumen();

$pageTitle = "Reportes - Sistema de Laboratorios";
$activeRoute = "reportes";
$viewPath = "app/Views/reportes.php";
include "app/Views/layouts/main.php";
