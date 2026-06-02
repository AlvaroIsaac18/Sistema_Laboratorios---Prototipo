<?php
namespace App\Controllers;

require_once 'app/Models/GestionUsuariosModel.php';
use App\Models\GestionUsuariosModel;

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])) {
    header('Location: index.php?route=login');
    exit;
}

$_SESSION['user_ci'] = $_SESSION['user_cedula'] ?? '';
$_SESSION['user_username'] = strtolower(str_replace(' ', '', $_SESSION['user_nombre'] ?? ''));
$_SESSION['user_depto'] = 'Dpto. Académico';
$_SESSION['user_telefono'] = 'No registrado';

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $model = new GestionUsuariosModel();
    $data = [
        'cedula' => trim($_POST['cedula'] ?? $_SESSION['user_cedula']),
        'nombre' => trim($_POST['nombre'] ?? $_SESSION['user_nombre']),
        'apellido' => trim($_POST['apellido'] ?? ''),
        'correo' => trim($_POST['correo'] ?? ''),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'cargo' => trim($_POST['cargo'] ?? ''),
    ];

    if ($model->update($_SESSION['user_id'], $_SESSION['user_rol'], $data)) {
        $_SESSION['user_nombre'] = $data['nombre'];
        $_SESSION['user_cedula'] = $data['cedula'];
        $_SESSION['user_correo'] = $data['correo'];
        $_SESSION['user_ci'] = $data['cedula'];
        $_SESSION['success_message'] = 'Datos actualizados correctamente.';
    } else {
        $_SESSION['success_message'] = 'Error al actualizar los datos.';
    }
    header('Location: index.php?route=perfil');
    exit;
}

$pageTitle = "Perfil de Usuario";
$activeRoute = "perfil";
$viewPath = "app/Views/perfil.php";

include "app/Views/layouts/main.php";
