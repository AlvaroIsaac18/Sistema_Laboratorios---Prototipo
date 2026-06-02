<?php
namespace App\Controllers;

$errorMessage = '';
$successMessage = '';

$base = require 'app/config/permissions.php';
$overridePath = 'app/config/permissions_override.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevosPermisos = [];
    $roles = ['Administrador', 'Auxiliar', 'Docente'];

    foreach ($roles as $rol) {
        $nuevosPermisos[$rol] = $_POST['permisos'][$rol] ?? [];
    }

    if (file_put_contents($overridePath, json_encode($nuevosPermisos, JSON_PRETTY_PRINT))) {
        $successMessage = 'Permisos actualizados exitosamente.';
    } else {
        $errorMessage = 'Error al guardar los permisos.';
    }
}

$override = [];
if (file_exists($overridePath)) {
    $override = json_decode(file_get_contents($overridePath), true) ?? [];
}

$todasLasRutas = [
    'home' => 'Inicio',
    'perfil' => 'Perfil de Usuario',
    'gestionUsuarios' => 'Gestión de Usuarios',
    'crearUsuario' => 'Crear Usuario',
    'editarUsuario' => 'Editar Usuario',
    'eliminarUsuario' => 'Eliminar Usuario',
    'solicitudes' => 'Ver Solicitudes',
    'nuevaSolicitud' => 'Nueva Solicitud',
    'historialSolicitudes' => 'Historial de Solicitudes',
    'laboratorios' => 'Resumen de Espacios',
    'mantenimientoLabs' => 'Gestión de Mantenimiento',
    'protocolosLabs' => 'Protocolos de Seguridad',
    'inventarioGeneral' => 'Inventario General',
    'nuevoInsumo' => 'Registrar Insumo',
    'movimientosInsumos' => 'Movimientos de Insumos',
    'alertasStock' => 'Alertas de Stock',
    'horarios' => 'Cronogramas Semanales',
    'reportes' => 'Panel Estadístico',
    'generacionReportes' => 'Generación de Reportes',
    'permisosUsuarios' => 'Roles y Permisos',
];

$roles = ['Administrador', 'Auxiliar', 'Docente'];

$pageTitle = "Roles y Permisos";
$activeRoute = "permisosUsuarios";
$viewPath = "app/Views/permisosUsuarios.php";
include "app/Views/layouts/main.php";
