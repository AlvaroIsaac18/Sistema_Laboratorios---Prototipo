<?php
namespace App\Controllers;

require_once 'app/Models/InsumosModel.php';
use App\Models\InsumosModel;

$errorMessage = '';
$model = new InsumosModel();

if (!isset($_GET['id']) || !($insumo = $model->getById((int)$_GET['id']))) {
    http_response_code(404);
    echo "<h1>404 - Insumo no encontrado</h1>";
    echo "<a href='index.php?route=inventarioGeneral' class='btn btn-primary'>Volver al inventario</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nomInsumos' => trim($_POST['nombre'] ?? ''),
        'categoriaInsumos' => trim($_POST['categoria'] ?? ''),
        'descripInsumos' => trim(($_POST['codigoLote'] ?? '') . ' | ' . ($_POST['ubicacion'] ?? '') . ' | Vence: ' . ($_POST['fechaVencimiento'] ?? 'N/A')),
        'cantidadStock' => trim($_POST['cantidadStock'] ?? '0'),
        'cantidadDispInsumos' => trim($_POST['cantidadDispInsumos'] ?? '0'),
        'cantidadMinInsumos' => trim($_POST['stockMinimo'] ?? '0'),
        'unidadMedidaInsumos' => trim($_POST['unidadMedida'] ?? ''),
    ];

    if ($data['nomInsumos'] === '' || $data['categoriaInsumos'] === '' || $data['unidadMedidaInsumos'] === '') {
        $errorMessage = 'Los campos Nombre, Categoría y Unidad de Medida son obligatorios.';
    } else {
        if ($model->update((int)$_GET['id'], $data)) {
            $_SESSION['success_message'] = 'Insumo actualizado correctamente.';
            header('Location: index.php?route=inventarioGeneral');
            exit;
        } else {
            $errorMessage = 'Error al actualizar el insumo.';
        }
    }
}

$descripParts = explode(' | ', $insumo['descripInsumos'] ?? '');

$pageTitle = "Editar Insumo";
$activeRoute = "inventarioGeneral";
$viewPath = "app/Views/editarInsumo.php";
include "app/Views/layouts/main.php";