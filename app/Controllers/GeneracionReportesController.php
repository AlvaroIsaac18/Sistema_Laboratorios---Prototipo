<?php
namespace App\Controllers;

require_once 'app/Models/ReportesModel.php';
use App\Models\ReportesModel;

$resultados = [];
$tipoSeleccionado = $_GET['tipo'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $fechaInicio = $_POST['fechaInicio'] ?? '';
    $fechaFin = $_POST['fechaFin'] ?? '';
    $filtroCampo = $_POST['filtroCampo'] ?? '';
    $filtroValor = $_POST['filtroValor'] ?? '';
    $tipoSeleccionado = $tipo;
} elseif ($tipoSeleccionado) {
    $fechaInicio = $_GET['fechaInicio'] ?? '';
    $fechaFin = $_GET['fechaFin'] ?? '';
    $filtroCampo = $_GET['filtroCampo'] ?? '';
    $filtroValor = $_GET['filtroValor'] ?? '';
}

if ($tipoSeleccionado) {
    $model = new ReportesModel();
    $resultados = $model->getReporte($tipoSeleccionado, $fechaInicio, $fechaFin, $filtroCampo, $filtroValor);
}

$pageTitle = "Generacion de Reportes - Sistema de Laboratorios";
$activeRoute = "generacionReportes";
$viewPath = "app/Views/generacionReportes.php";
include "app/Views/layouts/main.php";
