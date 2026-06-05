<?php
namespace App\Laboratorios\Controllers;

require_once 'app/Models/ReservasModel.php';
require_once 'app/Models/LaboratoriosModel.php';
use App\Laboratorios\Models\ReservasModel;
use App\Laboratorios\Models\LaboratoriosModel;

$object   = new ReservasModel();
$labModel = new LaboratoriosModel();

$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage   = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

if (!isset($_GET['type'])) {
    header("Location: index.php?url=Reserva&type=list");
    exit;
}

$type = $_GET['type'];

if ($type === 'list') {
    $reservas  = $object->getAll();
    $pageTitle = "Reservas - Sistema de Laboratorios";
    $activeRoute = "reserva";
    $viewPath  = "app/Views/reservas.php";
    include "app/Views/layouts/main.php";

} elseif ($type === 'register') {
    if ($_SESSION['user_rol'] !== 'Administrador') {
        $_SESSION['error_message'] = "No tienes permisos para crear reservas.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $object->create($_POST);
        $_SESSION['success_message'] = "Reserva creada correctamente.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    $laboratorios = $labModel->getAll();
    $pageTitle    = "Nueva Reserva - Sistema de Laboratorios";
    $activeRoute  = "reserva";
    $viewPath     = "app/Views/crearReserva.php";
    include "app/Views/layouts/main.php";

} elseif ($type === 'edit') {
    if ($_SESSION['user_rol'] !== 'Administrador') {
        $_SESSION['error_message'] = "No tienes permisos para editar reservas.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    $id = $_GET['id'] ?? 0;
    $reserva = $object->getById($id);
    if (!$reserva) {
        $_SESSION['error_message'] = "Reserva no encontrada.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $object->update($id, $_POST);
        $_SESSION['success_message'] = "Reserva actualizada correctamente.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    $laboratorios = $labModel->getAll();
    $pageTitle    = "Editar Reserva - Sistema de Laboratorios";
    $activeRoute  = "reserva";
    $viewPath     = "app/Views/editarReserva.php";
    include "app/Views/layouts/main.php";

} elseif ($type === 'delete') {
    if ($_SESSION['user_rol'] !== 'Administrador') {
        $_SESSION['error_message'] = "No tienes permisos para eliminar reservas.";
        header("Location: ?url=Reserva&type=list");
        exit;
    }

    $id = $_GET['id'] ?? 0;
    $object->delete($id);
    $_SESSION['success_message'] = "Reserva eliminada correctamente.";
    header("Location: ?url=Reserva&type=list");
    exit;

} else {
    header("Location: index.php?url=Reserva&type=list");
}
