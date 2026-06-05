<?php
namespace App\Laboratorios\Controllers;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'app/Models/InsumosModel.php';
require_once 'app/Models/MovimientosInsumosModel.php';
use App\Laboratorios\Models\InsumosModel;
use App\Laboratorios\Models\MovimientosInsumosModel;

$insumoModel  = new InsumosModel();
$movModel     = new MovimientosInsumosModel();

$successMessage = '';
$errorMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$rolActual = $_SESSION['user_rol'] ?? '';
$esAdmin = ($rolActual === 'Administrador');

$type = $_GET['type'] ?? 'list';

switch ($type) {

    case 'list':
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $insumoModel->delete((int)$_GET['id']);
            $_SESSION['success_message'] = 'Insumo eliminado correctamente.';
            header('Location: index.php?url=Insumo');
            exit;
        }
        $insumos = $insumoModel->getAll();
        $buscar  = trim($_GET['q'] ?? '');
        if ($buscar !== '') {
            $insumos = array_filter($insumos, function($i) use ($buscar) {
                $buscarLower = mb_strtolower($buscar);
                return mb_strpos(mb_strtolower($i['nomInsumos'] ?? ''), $buscarLower) !== false
                    || mb_strpos(mb_strtolower($i['categoriaInsumos'] ?? ''), $buscarLower) !== false
                    || mb_strpos(mb_strtolower($i['descripInsumos'] ?? ''), $buscarLower) !== false;
            });
        }
        $pageTitle   = "Inventario General - Sistema de Laboratorios";
        $activeRoute = "insumo";
        $viewPath    = "app/Views/inventarioGeneral.php";
        break;

    case 'register':
        if (!$esAdmin) {
            $_SESSION['error_message'] = 'Acceso denegado: solo Administradores pueden registrar insumos.';
            header('Location: index.php?url=Insumo');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cantidadInicial = max(0, (int)($_POST['cantidadInicial'] ?? '0'));
            $stockMinimo     = max(0, (int)($_POST['stockMinimo'] ?? '0'));
            $data = [
                'nomInsumos'             => $_POST['nombre']     ?? '',
                'descripInsumos'         => $_POST['codigoLote']  ?? '',
                'categoriaInsumos'       => $_POST['categoria']   ?? '',
                'cantidadStock'          => $cantidadInicial,
                'cantidadDispInsumos'    => $cantidadInicial,
                'cantidadMinInsumos'     => $stockMinimo,
                'unidadMedidaInsumos'    => $_POST['unidadMedida'] ?? '',
            ];
            $nuevoId = $insumoModel->create($data);
            if ($nuevoId !== false) {
                $_SESSION['success_message'] = 'Insumo registrado correctamente.';
                header('Location: index.php?url=Insumo');
                exit;
            }
            $errorMessage = 'Error al registrar el insumo.';
        }
        $pageTitle   = "Registrar Nuevo Insumo";
        $activeRoute = "insumo";
        $viewPath    = "app/Views/nuevoInsumo.php";
        break;

    case 'edit':
        if (!$esAdmin) {
            $_SESSION['error_message'] = 'Acceso denegado: solo Administradores pueden editar insumos.';
            header('Location: index.php?url=Insumo');
            exit;
        }
        $id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nomInsumos'             => $_POST['nombre']            ?? '',
                'descripInsumos'         => $_POST['codigoLote']         ?? '',
                'categoriaInsumos'       => $_POST['categoria']          ?? '',
                'cantidadStock'          => max(0, (int)($_POST['cantidadStock'] ?? '0')),
                'cantidadDispInsumos'    => max(0, (int)($_POST['cantidadDispInsumos'] ?? '0')),
                'cantidadMinInsumos'     => max(0, (int)($_POST['stockMinimo'] ?? '0')),
                'unidadMedidaInsumos'    => $_POST['unidadMedida']       ?? '',
            ];
            if ($insumoModel->update($id, $data)) {
                $_SESSION['success_message'] = 'Insumo actualizado correctamente.';
                header('Location: index.php?url=Insumo');
                exit;
            }
            $errorMessage = 'Error al actualizar el insumo.';
        }
        $insumo      = $insumoModel->getById($id);
        $descripParts = [];
        if (!empty($insumo['descripInsumos'])) {
            $parts = explode(' | ', $insumo['descripInsumos']);
            $descripParts[0] = $parts[0] ?? '';
            $descripParts[1] = $parts[1] ?? '';
            $descripParts[2] = $parts[2] ?? '';
        }
        $pageTitle   = "Editar Insumo";
        $activeRoute = "insumo";
        $viewPath    = "app/Views/editarInsumo.php";
        break;

    case 'movimientos':
        $salidas  = $movModel->getAll();
        $entradas = $movModel->getEntradas();
        $movimientos = [];
        foreach ($salidas as $s) {
            $movimientos[] = [
                'fecha'         => ($s['fechaReserva'] ?? '') . ' ' . ($s['horaInicioReserva'] ?? ''),
                'tipo'          => 'salida',
                'nomInsumos'    => $s['nomInsumos'] ?? '',
                'unidadMedida'  => $s['unidadMedidaInsumos'] ?? '',
                'cantidad'      => '- ' . ($s['cantidadRequerida'] ?? '0'),
                'motivo'        => $s['nombreReserva'] ?? '—',
                'registradoPor' => '—',
            ];
        }
        foreach ($entradas as $e) {
            $movimientos[] = [
                'fecha'         => '—',
                'tipo'          => 'entrada',
                'nomInsumos'    => $e['nomInsumos'] ?? '',
                'unidadMedida'  => $e['unidadMedidaInsumos'] ?? '',
                'cantidad'      => '+ ' . ($e['cantidadStock'] ?? '0'),
                'motivo'        => 'Asignación a técnico',
                'registradoPor' => $e['nomTecnico'] ?? '—',
            ];
        }
        usort($movimientos, function ($a, $b) {
            return strcmp($b['fecha'], $a['fecha']);
        });
        $pageTitle   = "Control de Entradas y Salidas";
        $activeRoute = "insumo";
        $viewPath    = "app/Views/movimientosInsumos.php";
        break;

    case 'alertas':
        $insumosCriticos = $insumoModel->getCriticalStock();
        $pageTitle       = "Alertas de Stock - Sistema de Laboratorios";
        $activeRoute     = "insumo";
        $viewPath        = "app/Views/alertasStock.php";
        break;

    default:
        header('Location: index.php?url=Insumo&type=list');
        exit;
}

include "app/Views/layouts/main.php";
