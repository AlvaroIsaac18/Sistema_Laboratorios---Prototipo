<?php
namespace App\Controllers;

require_once 'app/Models/GestionUsuariosModel.php';
use App\Models\GestionUsuariosModel;

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$rol = $_GET['rol'] ?? $_POST['rol'] ?? '';

if ($id <= 0 || $rol === '') {
    header('Location: index.php?route=gestionUsuarios');
    exit;
}

$model = new GestionUsuariosModel();
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'cedula' => trim($_POST['cedula'] ?? ''),
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellido' => trim($_POST['apellido'] ?? ''),
        'correo' => trim($_POST['correo'] ?? ''),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'cargo' => trim($_POST['cargo'] ?? ''),
    ];

    if ($data['cedula'] === '' || $data['nombre'] === '') {
        $errorMessage = 'Los campos Cédula y Nombre son obligatorios.';
    } else {
        if ($model->update($id, $rol, $data)) {
            $_SESSION['success_message'] = 'Usuario actualizado exitosamente.';
            header('Location: index.php?route=gestionUsuarios');
            exit;
        } else {
            $errorMessage = 'Error al actualizar el usuario.';
        }
    }
}

$usuario = $model->getById($id, $rol);
if (!$usuario) {
    header('Location: index.php?route=gestionUsuarios');
    exit;
}

$pageTitle = "Editar Usuario";
$activeRoute = "gestionUsuarios";
$viewPath = "app/Views/editarUsuario.php";
include "app/Views/layouts/main.php";
