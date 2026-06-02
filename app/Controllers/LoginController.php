<?php
namespace App\Controllers;

require_once 'app/Models/LoginModel.php';
use App\Models\LoginModel;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = trim($_POST['cedula'] ?? '');
    $correo = trim($_POST['correo'] ?? '');

    if ($cedula === '' || $correo === '') {
        $error = 'Por favor ingrese su cédula y correo institucional.';
    } else {
        $model = new LoginModel();
        $user = $model->login($cedula, $correo);
        if ($user) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nombre'] = $user['nombre_completo'];
            $_SESSION['user_cedula'] = $user['cedula'];
            $_SESSION['user_correo'] = $user['correo'];
            $_SESSION['user_rol'] = $user['rol'];
            header('Location: index.php?route=home');
            exit;
        } else {
            $error = 'Cédula y/o correo institucional no coinciden con nuestros registros.';
        }
    }
}

include 'app/Views/login.php';
