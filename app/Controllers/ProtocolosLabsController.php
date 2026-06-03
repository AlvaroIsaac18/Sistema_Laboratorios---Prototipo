<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/ProtocolosModel.php';

use App\Models\ProtocolosModel;

$model = new ProtocolosModel();
$cards = $model->getActiveCards();
$downloads = $model->getActiveDownloads();

$pageTitle = "Protocolos - Sistema de Laboratorios";
$activeRoute = "protocolosLabs";
$viewPath = "app/Views/protocolosLabs.php";
include "app/Views/layouts/main.php";
