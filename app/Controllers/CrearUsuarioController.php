<?php
namespace App\Controllers;

require_once 'app/Models/GestionUsuariosModel.php';
use App\Models\GestionUsuariosModel;

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'cedula' => trim($_POST['cedula'] ?? ''),
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellido' => trim($_POST['apellido'] ?? ''),
        'correo' => trim($_POST['correo'] ?? ''),
        'rol' => $_POST['rol'] ?? '',
        'direccion' => trim($_POST['direccion'] ?? ''),
        'cargo' => trim($_POST['cargo'] ?? ''),
    ];

    if ($data['rol'] === '' || $data['cedula'] === '' || $data['nombre'] === '') {
        $errorMessage = 'Los campos Rol, Cédula y Nombre son obligatorios.';
    } elseif ($data['rol'] === 'Docente' && ($data['apellido'] === '' || $data['correo'] === '')) {
        $errorMessage = 'Para Docente, los campos Apellido y Correo son obligatorios.';
    } else {
        $model = new GestionUsuariosModel();
        if ($model->create($data)) {
            $_SESSION['success_message'] = 'Usuario creado exitosamente.';
            header('Location: index.php?route=gestionUsuarios');
            exit;
        } else {
            $errorMessage = 'Error al crear el usuario.';
        }
    }
}

$pageTitle = "Registrar Usuario";
$activeRoute = "gestionUsuarios";
$viewPath = "app/Views/crearUsuario.php";
include "app/Views/layouts/main.php";
