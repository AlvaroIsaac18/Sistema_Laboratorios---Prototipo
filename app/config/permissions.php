<?php
return [
    'Administrador' => [
        'home', 'perfil',
        'gestionUsuarios', 'crearUsuario', 'editarUsuario', 'eliminarUsuario',
        'solicitudes', 'nuevaSolicitud', 'historialSolicitudes',
        'laboratorios', 'mantenimientoLabs', 'protocolosLabs',
        'inventarioGeneral', 'nuevoInsumo', 'editarInsumo', 'movimientosInsumos', 'alertasStock',
        'horarios',
        'reportes', 'generacionReportes',
        'permisosUsuarios',
    ],
    'Auxiliar' => [
        'home', 'perfil',
        'inventarioGeneral', 'nuevoInsumo', 'editarInsumo', 'movimientosInsumos', 'alertasStock',
        'mantenimientoLabs', 'laboratorios',
        'horarios',
    ],
    'Docente' => [
        'home', 'perfil',
        'solicitudes', 'nuevaSolicitud', 'historialSolicitudes',
        'laboratorios', 'protocolosLabs',
        'horarios', 'reportes',
    ],
];
