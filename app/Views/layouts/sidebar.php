<?php
$routesPermitidas = isset($_SESSION['user_rol']) ? getPermisos($_SESSION['user_rol']) : [];
function rutaPermitida($ruta) {
    global $routesPermitidas;
    return in_array($ruta, $routesPermitidas);
}
?>
<div class="d-flex">
    <nav id="sidebar" class="flex-column">
        <div class="logo_UPTAEB p-4 fs-4 fw-bold border-bottom border-secondary mb-3">
            <img src="asset/img/1.jpg" alt="">
        </div>
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php?route=home" class="nav-link <?php echo ($activeRoute === 'home') ? 'active' : ''; ?>">
                    <i class="bi bi-house-door"></i> Inicio
                </a>
            </li>

            <?php if (rutaPermitida('gestionUsuarios') || rutaPermitida('permisosUsuarios')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionUsuarios">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingUsuarios">
                            <button class="accordion-button <?php echo (in_array($activeRoute, ['gestionUsuarios', 'crearUsuario', 'editarUsuario', 'eliminarUsuario', 'permisosUsuarios'])) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseUsuarios" aria-expanded="<?php echo (in_array($activeRoute, ['gestionUsuarios', 'crearUsuario', 'editarUsuario', 'eliminarUsuario', 'permisosUsuarios'])) ? 'true' : 'false'; ?>" aria-controls="collapseUsuarios">
                                <i class="bi bi-people me-2"></i> Usuarios
                            </button>
                        </h2>
                        <div id="collapseUsuarios" class="accordion-collapse collapse <?php echo (in_array($activeRoute, ['gestionUsuarios', 'crearUsuario', 'editarUsuario', 'eliminarUsuario', 'permisosUsuarios'])) ? 'show' : ''; ?>" aria-labelledby="headingUsuarios"
                            data-bs-parent="#accordionUsuarios">
                            <div class="accordion-body p-0">
                                <?php if (rutaPermitida('gestionUsuarios')): ?>
                                <a href="index.php?route=gestionUsuarios" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'gestionUsuarios') ? 'active' : ''; ?>">Gestión de Usuarios</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('permisosUsuarios')): ?>
                                <a href="index.php?route=permisosUsuarios" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'permisosUsuarios') ? 'active' : ''; ?>">Roles y Permisos</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if (rutaPermitida('solicitudes') || rutaPermitida('nuevaSolicitud') || rutaPermitida('historialSolicitudes')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionSolicitudes">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSolicitudes">
                            <button class="accordion-button <?php echo (in_array($activeRoute, ['solicitudes', 'nuevaSolicitud', 'historialSolicitudes'])) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSolicitudes" aria-expanded="<?php echo (in_array($activeRoute, ['solicitudes', 'nuevaSolicitud', 'historialSolicitudes'])) ? 'true' : 'false'; ?>" aria-controls="collapseSolicitudes">
                                <i class="bi bi-file-earmark-text me-2"></i> Solicitudes
                            </button>
                        </h2>
                        <div id="collapseSolicitudes" class="accordion-collapse collapse <?php echo (in_array($activeRoute, ['solicitudes', 'nuevaSolicitud', 'historialSolicitudes'])) ? 'show' : ''; ?>" aria-labelledby="headingSolicitudes"
                            data-bs-parent="#accordionSolicitudes">
                            <div class="accordion-body p-0">
                                <?php if (rutaPermitida('solicitudes')): ?>
                                <a href="index.php?route=solicitudes" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'solicitudes') ? 'active' : ''; ?>">Ver Solicitudes</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('nuevaSolicitud')): ?>
                                <a href="index.php?route=nuevaSolicitud" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'nuevaSolicitud') ? 'active' : ''; ?>">Nueva Solicitud</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('historialSolicitudes')): ?>
                                <a href="index.php?route=historialSolicitudes" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'historialSolicitudes') ? 'active' : ''; ?>">Historial de Solicitudes</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if (rutaPermitida('laboratorios') || rutaPermitida('mantenimientoLabs') || rutaPermitida('protocolosLabs')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionLaboratorios">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLaboratorios">
                            <button class="accordion-button <?php echo (in_array($activeRoute, ['laboratorios', 'mantenimientoLabs', 'protocolosLabs'])) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseLaboratorios" aria-expanded="<?php echo (in_array($activeRoute, ['laboratorios', 'mantenimientoLabs', 'protocolosLabs'])) ? 'true' : 'false'; ?>" aria-controls="collapseLaboratorios">
                                <i class="bi bi-journal-text me-2"></i> Laboratorios
                            </button>
                        </h2>
                        <div id="collapseLaboratorios" class="accordion-collapse collapse <?php echo (in_array($activeRoute, ['laboratorios', 'mantenimientoLabs', 'protocolosLabs'])) ? 'show' : ''; ?>" aria-labelledby="headingLaboratorios"
                            data-bs-parent="#accordionLaboratorios">
                            <div class="accordion-body p-0">
                                <?php if (rutaPermitida('laboratorios')): ?>
                                <a href="index.php?route=laboratorios" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'laboratorios') ? 'active' : ''; ?>">Resumen de Espacios</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('mantenimientoLabs')): ?>
                                <a href="index.php?route=mantenimientoLabs" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'mantenimientoLabs') ? 'active' : ''; ?>">Gestión de Mantenimiento</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('protocolosLabs')): ?>
                                <a href="index.php?route=protocolosLabs" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'protocolosLabs') ? 'active' : ''; ?>">Protocolos de Seguridad</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if (rutaPermitida('inventarioGeneral') || rutaPermitida('nuevoInsumo') || rutaPermitida('movimientosInsumos') || rutaPermitida('alertasStock')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionInsumos">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingInsumos">
                            <button class="accordion-button <?php echo (in_array($activeRoute, ['inventarioGeneral', 'nuevoInsumo', 'movimientosInsumos', 'alertasStock'])) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseInsumos" aria-expanded="<?php echo (in_array($activeRoute, ['inventarioGeneral', 'nuevoInsumo', 'movimientosInsumos', 'alertasStock'])) ? 'true' : 'false'; ?>" aria-controls="collapseInsumos">
                                <i class="bi bi-box-seam me-2"></i> Insumos
                            </button>
                        </h2>
                        <div id="collapseInsumos" class="accordion-collapse collapse <?php echo (in_array($activeRoute, ['inventarioGeneral', 'nuevoInsumo', 'movimientosInsumos', 'alertasStock'])) ? 'show' : ''; ?>" aria-labelledby="headingInsumos"
                            data-bs-parent="#accordionInsumos">
                            <div class="accordion-body p-0">
                                <?php if (rutaPermitida('inventarioGeneral')): ?>
                                <a href="index.php?route=inventarioGeneral" class="nav-link py-2 ps-5 small <?php echo (in_array($activeRoute, ['inventarioGeneral', 'nuevoInsumo'])) ? 'active' : ''; ?>">Inventario General</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('movimientosInsumos')): ?>
                                <a href="index.php?route=movimientosInsumos" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'movimientosInsumos') ? 'active' : ''; ?>">Movimientos (Entradas/Salidas)</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('alertasStock')): ?>
                                <a href="index.php?route=alertasStock" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'alertasStock') ? 'active' : ''; ?>">Alertas de Stock</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if (rutaPermitida('horarios')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionHorarios">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingHorarios">
                            <button class="accordion-button <?php echo ($activeRoute === 'horarios') ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHorarios" aria-expanded="<?php echo ($activeRoute === 'horarios') ? 'true' : 'false'; ?>" aria-controls="collapseHorarios">
                                <i class="bi bi-calendar3 me-2"></i> Horarios
                            </button>
                        </h2>
                        <div id="collapseHorarios" class="accordion-collapse collapse <?php echo ($activeRoute === 'horarios') ? 'show' : ''; ?>" aria-labelledby="headingHorarios"
                            data-bs-parent="#accordionHorarios">
                            <div class="accordion-body p-0">
                                <a href="index.php?route=horarios" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'horarios') ? 'active' : ''; ?>">Cronogramas Semanales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>

            <?php if (rutaPermitida('reportes') || rutaPermitida('generacionReportes')): ?>
            <li class="nav-item">
                <div class="accordion sidebar-accordion" id="accordionReportes">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingReportes">
                            <button class="accordion-button <?php echo (in_array($activeRoute, ['reportes', 'generacionReportes'])) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseReportes" aria-expanded="<?php echo (in_array($activeRoute, ['reportes', 'generacionReportes'])) ? 'true' : 'false'; ?>" aria-controls="collapseReportes">
                                <i class="bi bi-graph-up me-2"></i> Reportes
                            </button>
                        </h2>
                        <div id="collapseReportes" class="accordion-collapse collapse <?php echo (in_array($activeRoute, ['reportes', 'generacionReportes'])) ? 'show' : ''; ?>" aria-labelledby="headingReportes"
                            data-bs-parent="#accordionReportes">
                            <div class="accordion-body p-0">
                                <?php if (rutaPermitida('reportes')): ?>
                                <a href="index.php?route=reportes" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'reportes') ? 'active' : ''; ?>">Panel Estadístico</a>
                                <?php endif; ?>
                                <?php if (rutaPermitida('generacionReportes')): ?>
                                <a href="index.php?route=generacionReportes" class="nav-link py-2 ps-5 small <?php echo ($activeRoute === 'generacionReportes') ? 'active' : ''; ?>">Generación de Reportes</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        </ul>
        <button class="btn btn-outline-danger p-0 ms-3 mt-3">
            <a href="index.php?route=logout" class="nav-link">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
        </button>
    </nav>
