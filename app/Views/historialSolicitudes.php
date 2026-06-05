<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Historial de Solicitudes</h2>
    <a href="index.php?url=Solicitud&type=list" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Volver a Solicitudes</span>
    </a>
</div>

<?php if (!empty($successMessage)): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?php echo htmlspecialchars($successMessage); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?php echo htmlspecialchars($errorMessage); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
    <div class="d-flex gap-2">
        <input type="month" class="form-control border-primary text-primary fw-semibold" value="2026-03">
        <button class="btn btn-outline-primary shadow-sm" disabled title="Pendiente de implementar"><i class="bi bi-filter"></i> Filtrar</button>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold text-dark mb-0">Registro Histórico del Mes</h5>
        <button class="btn btn-sm btn-light border" disabled title="Pendiente de implementar"><i class="bi bi-download me-1"></i> Exportar a Excel</button>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Cód.</th>
                    <th>Práctica o Asignatura</th>
                    <th>Laboratorio Asignado</th>
                    <th>Fecha de Ejecución</th>
                    <th>Docente Asignado</th>
                    <th>Resultado / Estado Final</th>
                    <th class="text-end">Documento</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($solicitudes)): ?>
                    <?php foreach ($solicitudes as $s): ?>
                    <?php
                        $estado = $s['estadoSolicitudPractica'] ?? 'pendiente';
                        $badgeClass = match (strtolower($estado)) {
                            'pendiente' => 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25',
                            'aprobada'  => 'bg-success bg-opacity-10 text-success border border-success border-opacity-25',
                            'rechazada' => 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25',
                            default     => 'bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25',
                        };
                        $nombreDocente = trim($s['nombreDocente'] ?? '');
                        $obs = $s['observacionSolicitudPractica'] ?? '';
                        $asignatura = '';
                        if (preg_match('/Asignatura:\s*([^,]+)/', $obs, $m)) {
                            $asignatura = trim($m[1]);
                        }
                    ?>
                    <tr>
                        <td class="text-muted fw-bold">#S-<?= str_pad($s['idSolicitudPractica'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <span class="d-block fw-semibold text-dark"><?= htmlspecialchars($asignatura ?: '—') ?></span>
                        </td>
                        <?php $lab = 'No especificado'; if (preg_match('/Laboratorio:\s*([^,]+)/', $s['observacionSolicitudPractica'] ?? '', $m)) $lab = trim($m[1]); ?>
                        <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($lab) ?></span></td>
                        <td>
                            <span class="d-block text-dark"><i class="bi bi-calendar me-1 text-primary"></i> <?= date('d M Y', strtotime($s['fechaSolicitudPractica'] ?? 'now')) ?></span>
                            <span class="small text-muted"><i class="bi bi-clock me-1"></i> <?= $s['horaInicioSolicitudPractica'] ? date('h:i A', strtotime($s['horaInicioSolicitudPractica'])) : '—' ?> - <?= $s['horaFinSolicitudPractica'] ? date('h:i A', strtotime($s['horaFinSolicitudPractica'])) : '—' ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-circle text-muted fs-5 me-2"></i>
                                <span class="small fw-semibold"><?= htmlspecialchars($nombreDocente ?: 'Sin asignar') ?></span>
                            </div>
                        </td>
                        <td><span class="badge <?= $badgeClass ?> px-2 py-1"><i class="bi <?= match(strtolower($estado)) {'pendiente' => 'bi-exclamation-circle', 'aprobada' => 'bi-check-circle', 'rechazada' => 'bi-x-circle', default => 'bi-info-circle'} ?> me-1"></i><?= htmlspecialchars(ucfirst($estado)) ?></span></td>
                        <td class="text-end">
                            <?php if (($_SESSION['user_rol'] ?? '') === 'Administrador'): ?>
                            <a href="index.php?url=Solicitud&type=edit&id=<?= $s['idSolicitudPractica'] ?>" class="btn btn-sm btn-outline-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                            <?php endif; ?>
                            <button class="btn btn-sm btn-outline-primary" disabled title="Pendiente de implementar"><i class="bi bi-file-earmark-pdf-fill me-1"></i>Acta</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay solicitudes en el historial.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>