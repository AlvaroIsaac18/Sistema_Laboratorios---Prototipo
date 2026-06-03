<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-0">Resumen de Laboratorios</h2>
        <p class="text-muted small">Visualización y gestión de los espacios de laboratorio disponibles para prácticas académicas</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-4 border-success h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle me-3">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <h6 class="text-muted small text-uppercase mb-0">Disponibles</h6>
                </div>
                <h3 class="mb-0 text-success"><?= $resumen['disponible'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-4 border-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                        <i class="bi bi-play-circle fs-4"></i>
                    </div>
                    <h6 class="text-muted small text-uppercase mb-0">En Uso</h6>
                </div>
                <h3 class="mb-0 text-primary"><?= $resumen['en_uso'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-4 border-secondary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-secondary bg-opacity-10 text-secondary p-2 rounded-circle me-3">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                    <h6 class="text-muted small text-uppercase mb-0">En Mantenimiento</h6>
                </div>
                <h3 class="mb-0 text-secondary"><?= $resumen['mantenimiento'] ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Laboratorio</th>
                    <th>Ubicación</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($laboratorios)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No hay laboratorios registrados.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($laboratorios as $lab):
                    $estado = $lab['estadoLaboratorio'] ?? 'desconocido';
                    $badge = match ($estado) {
                        'disponible' => ['bg-success', 'success', 'bi-check-circle-fill'],
                        'en_uso' => ['bg-primary', 'primary', 'bi-play-circle-fill'],
                        'mantenimiento' => ['bg-secondary', 'secondary', 'bi-tools'],
                        default => ['bg-secondary', 'secondary', 'bi-question-circle']
                    };
                ?>
                <tr>
                    <td class="fw-semibold"><?= htmlspecialchars($lab['nomLaboratorio']) ?></td>
                    <td><?= htmlspecialchars($lab['ubicacionLaboratorio'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($lab['capacidadLaboratorio'] ?? '—') ?> Personas</td>
                    <td><span class="badge <?= $badge[0] ?> bg-opacity-10 text-<?= $badge[1] ?> border border-<?= $badge[1] ?> border-opacity-25"><i class="bi <?= $badge[2] ?> me-1"></i><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $estado))) ?></span></td>
                    <td class="text-end">
                        <a href="index.php?route=mantenimientoLabs&id=<?= $lab['idLaboratorio'] ?>" class="btn btn-sm btn-light border">Ver Detalles</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
