<?php
namespace App\Laboratorios\Controllers;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])) {
    header('Location: index.php?url=Login');
    exit;
}

require_once 'app/Models/SolicitudesModel.php';
require_once 'app/Models/GestionUsuariosModel.php';
require_once 'app/Models/LaboratoriosModel.php';
use App\Laboratorios\Models\SolicitudesModel;
use App\Laboratorios\Models\GestionUsuariosModel;
use App\Laboratorios\Models\LaboratoriosModel;

$rolActual = $_SESSION['user_rol'] ?? '';
$userId    = $_SESSION['user_id'] ?? 0;
$esCreador = in_array($rolActual, ['Tecnico', 'Administrador']);

$model     = new SolicitudesModel();
$userModel = new GestionUsuariosModel();
$labModel  = new LaboratoriosModel();
$type      = $_GET['type'] ?? '';

$successMessage = '';
$errorMessage   = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

switch ($type) {

    case 'list':
        $solicitudes = $model->getAll();
        $pageTitle   = "Ver Solicitudes - Sistema de Laboratorios";
        $activeRoute = "solicitud";
        $viewPath    = "app/Views/solicitudes.php";
        break;

    case 'new':
        if (!$esCreador) {
            $_SESSION['error_message'] = 'Acceso denegado: No tiene permisos para registrar prácticas.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $docentes    = $userModel->getDocentes();
        $laboratorios = $labModel->getAll();
        $pageTitle   = "Nueva Solicitud - Sistema de Laboratorios";
        $activeRoute = "solicitud";
        $viewPath    = "app/Views/nuevaSolicitud.php";
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?url=Solicitud&type=new");
            exit;
        }
        if (!$esCreador) {
            $_SESSION['error_message'] = 'No tiene permisos para realizar esta acción.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }

        $idDocente   = (int)($_POST['idDocente'] ?? 0);
        $asignatura  = trim($_POST['asignatura'] ?? '');
        $seccion     = trim($_POST['seccion'] ?? '');
        $estudiantes = (int)($_POST['estudiantes'] ?? 0);
        $laboratorio = trim($_POST['laboratorio'] ?? '');
        $fecha       = trim($_POST['fecha'] ?? '');
        $horaInicio  = trim($_POST['horaInicio'] ?? '');
        $horaFin     = trim($_POST['horaFin'] ?? '');
        $insumos     = trim($_POST['insumos'] ?? '');

        if ($idDocente <= 0 || $asignatura === '' || $fecha === '' || $horaInicio === '' || $horaFin === '') {
            $_SESSION['error_message'] = 'Faltan campos obligatorios (docente, asignatura, fecha, hora inicio, hora fin).';
            header("Location: index.php?url=Solicitud&type=new");
            exit;
        }

        $observacion        = "Asignatura: {$asignatura}, Sección: {$seccion}, Estudiantes: {$estudiantes}, Laboratorio: {$laboratorio}, Insumos/Reactivos: {$insumos}";
        $idPersonalDireccion = ($rolActual === 'Administrador') ? (int)$userId : 1;

        $data = [
            'idDocente'           => $idDocente,
            'observacion'         => $observacion,
            'fecha'               => $fecha,
            'horaInicio'          => $horaInicio,
            'horaFin'             => $horaFin,
            'estado'              => 'pendiente',
            'idPersonalDireccion' => $idPersonalDireccion,
        ];

        $result = $model->createSolicitud($data);
        if ($result !== false) {
            $_SESSION['success_message'] = 'Solicitud de práctica enviada exitosamente.';
        } else {
            $_SESSION['error_message'] = 'Error al enviar la solicitud de práctica.';
        }
        header("Location: index.php?url=Solicitud&type=list");
        exit;

    case 'approve':
        if ($rolActual !== 'Administrador') {
            $_SESSION['error_message'] = 'Solo administradores pueden aprobar solicitudes.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0 || !$model->update($id, 'aprobada')) {
            $_SESSION['error_message'] = 'Error al aprobar la solicitud.';
        } else {
            $_SESSION['success_message'] = 'Solicitud aprobada exitosamente.';
        }
        header("Location: index.php?url=Solicitud&type=list");
        exit;

    case 'reject':
        if ($rolActual !== 'Administrador') {
            $_SESSION['error_message'] = 'Solo administradores pueden rechazar solicitudes.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0 || !$model->update($id, 'rechazada')) {
            $_SESSION['error_message'] = 'Error al rechazar la solicitud.';
        } else {
            $_SESSION['error_message'] = 'Solicitud rechazada.';
        }
        header("Location: index.php?url=Solicitud&type=list");
        exit;

    case 'detail':
        $id = (int)($_GET['id'] ?? 0);
        $solicitud = $model->getById($id);
        if (!$solicitud) {
            $_SESSION['error_message'] = 'Solicitud no encontrada.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $pageTitle   = "Detalle de Solicitud - Sistema de Laboratorios";
        $activeRoute = "solicitud";
        $viewPath    = "app/Views/detalleSolicitud.php";
        break;

    case 'edit':
        if ($rolActual !== 'Administrador') {
            $_SESSION['error_message'] = 'Solo administradores pueden editar solicitudes.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        $solicitud = $model->getById($id);
        if (!$solicitud) {
            $_SESSION['error_message'] = 'Solicitud no encontrada.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $docentes    = $userModel->getDocentes();
        $laboratorios = $labModel->getAll();
        $pageTitle   = "Editar Solicitud - Sistema de Laboratorios";
        $activeRoute = "solicitud";
        $viewPath    = "app/Views/editarSolicitud.php";
        break;

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        if ($rolActual !== 'Administrador') {
            $_SESSION['error_message'] = 'No tiene permisos para realizar esta acción.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error_message'] = 'ID de solicitud inválido.';
            header("Location: index.php?url=Solicitud&type=list");
            exit;
        }
        $asignatura  = trim($_POST['asignatura'] ?? '');
        $seccion     = trim($_POST['seccion'] ?? '');
        $estudiantes = (int)($_POST['estudiantes'] ?? 0);
        $laboratorio = trim($_POST['laboratorio'] ?? '');
        $insumos     = trim($_POST['insumos'] ?? '');
        $observacion = "Asignatura: {$asignatura}, Sección: {$seccion}, Estudiantes: {$estudiantes}, Laboratorio: {$laboratorio}, Insumos/Reactivos: {$insumos}";
        $data = [
            'observacion'         => $observacion,
            'fecha'               => trim($_POST['fecha'] ?? ''),
            'horaInicio'          => trim($_POST['horaInicio'] ?? ''),
            'horaFin'             => trim($_POST['horaFin'] ?? ''),
            'idPersonalDireccion' => ($rolActual === 'Administrador') ? (int)$userId : 1,
        ];
        if ($model->updateSolicitud($id, $data)) {
            $_SESSION['success_message'] = 'Solicitud actualizada exitosamente.';
        } else {
            $_SESSION['error_message'] = 'Error al actualizar la solicitud.';
        }
        header("Location: index.php?url=Solicitud&type=list");
        exit;

    case 'history':
        $solicitudes = $model->getAll();
        $pageTitle   = "Historial de Solicitudes - Sistema de Laboratorios";
        $activeRoute = "solicitud";
        $viewPath    = "app/Views/historialSolicitudes.php";
        break;

    default:
        header("Location: index.php?url=Solicitud&type=list");
        exit;
}

include "app/Views/layouts/main.php";
