<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Reportes y Analíticas</h2>
        <p class="text-muted small mb-0">Métricas de uso de laboratorios y consumo de insumos</p>
    </div>
</div>

<div class="row g-4 mb-4">

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="card-title fw-bold mb-0">Tasa de Uso por Laboratorio</h5>
            </div>
            <div class="card-body">
                <?php if (empty($usoLaboratorios)): ?>
                <p class="text-muted text-center py-3 mb-0">No hay datos de uso de laboratorios disponibles.</p>
                <?php else: ?>
                <?php $colores = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-secondary', 'bg-danger']; $i = 0; ?>
                <?php foreach ($usoLaboratorios as $lab): ?>
                <div class="<?= $i > 0 ? 'mb-4' : '' ?>">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small fw-bold"><?= htmlspecialchars($lab['nomLaboratorio']) ?></span>
                        <span class="small text-muted"><?= $lab['porcentaje'] ?>%</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar <?= $colores[$i % count($colores)] ?>" role="progressbar" style="width: <?= $lab['porcentaje'] ?>%" aria-valuenow="<?= $lab['porcentaje'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="card-title fw-bold mb-0">Estado de Inventario (Alerta Temprana)</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="row text-center g-3">
                    <div class="col-6">
                        <div class="p-4 bg-light rounded-3 h-100 border border-success">
                            <h3 class="text-success fw-bold mb-1"><?= $stockResumen['optimo'] ?></h3>
                            <span class="small text-muted d-block">Insumos en Stock Óptimo</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 bg-danger bg-opacity-10 rounded-3 h-100 border border-danger">
                            <h3 class="text-danger fw-bold mb-1"><?= $stockResumen['critico'] + $stockResumen['agotado'] ?></h3>
                            <span class="small text-danger d-block">Insumos por Debajo del Mínimo</span>
                            <a href="index.php?route=alertasStock" class="btn btn-sm btn-outline-danger mt-3 w-100">Revisar</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-muted">Total: <?= $stockResumen['total'] ?> insumos registrados</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 border-0">
        <h5 class="card-title fw-bold mb-0">Generación Rápida de Reportes</h5>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            <a href="index.php?route=generacionReportes&tipo=ocupacion" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                        <i class="bi bi-calendar-check fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Reporte de Prácticas Realizadas</h6>
                        <small class="text-muted">Desglose por docente, materia y laboratorios en un período específico.</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="index.php?route=generacionReportes&tipo=conflictos" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-circle me-3">
                        <i class="bi bi-exclamation-triangle fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Reporte de Conflictos de Horario</h6>
                        <small class="text-muted">Registro de choques prevenidos y solucionados durante el semestre.</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="index.php?route=generacionReportes&tipo=insumos" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle me-3">
                        <i class="bi bi-box-seam fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Reporte de Consumo de Insumos</h6>
                        <small class="text-muted">Balance de materiales gastados en base a las prácticas programadas y aprobadas.</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right text-muted"></i>
            </a>
        </div>
    </div>
</div>