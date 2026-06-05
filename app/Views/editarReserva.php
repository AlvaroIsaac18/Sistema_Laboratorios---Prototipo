<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-0">Editar Reserva</h2>
        <p class="text-muted small">Modificar los datos de la reserva</p>
    </div>
    <a href="index.php?url=Reserva&type=list" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="index.php?url=Reserva&type=edit&id=<?= $reserva['idReserva'] ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Nombre de la Práctica</label>
                    <input type="text" name="nombreReserva" class="form-control" required
                           value="<?= htmlspecialchars($reserva['nombreReserva']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Laboratorio</label>
                    <select name="idLaboratorio" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($laboratorios as $lab): ?>
                        <option value="<?= $lab['idLaboratorio'] ?>" <?= ((int)$reserva['idLaboratorio'] === (int)$lab['idLaboratorio']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($lab['nomLaboratorio']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Fecha</label>
                    <input type="date" name="fechaReserva" class="form-control" required
                           value="<?= htmlspecialchars($reserva['fechaReserva']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Hora Inicio</label>
                    <input type="time" name="horaInicioReserva" class="form-control" required
                           value="<?= htmlspecialchars($reserva['horaInicioReserva']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Hora Fin</label>
                    <input type="time" name="horaFinReserva" class="form-control" required
                           value="<?= htmlspecialchars($reserva['horaFinReserva']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Estado</label>
                    <select name="estadoReserva" class="form-select">
                        <?php $estados = ['activa' => 'Activa (Ocupado)', 'pendiente' => 'Pendiente', 'aprobada' => 'Aprobada', 'finalizada' => 'Finalizada', 'cancelada' => 'Cancelada']; ?>
                        <?php foreach ($estados as $val => $label): ?>
                        <option value="<?= $val ?>" <?= ($reserva['estadoReserva'] ?? '') === $val ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Turno</label>
                    <select name="turnoReserva" class="form-select">
                        <option value="">Sin turno</option>
                        <?php $turnos = ['mañana' => 'Mañana', 'tarde' => 'Tarde', 'noche' => 'Noche']; ?>
                        <?php foreach ($turnos as $val => $label): ?>
                        <option value="<?= $val ?>" <?= ($reserva['turnoReserva'] ?? '') === $val ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Objetivo</label>
                    <input type="text" name="objetivoReserva" class="form-control" maxlength="45"
                           value="<?= htmlspecialchars($reserva['objetivoReserva'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Descripción</label>
                    <input type="text" name="descripReserva" class="form-control" maxlength="45"
                           value="<?= htmlspecialchars($reserva['descripReserva'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Observaciones</label>
                    <input type="text" name="observacionReserva" class="form-control" maxlength="45"
                           value="<?= htmlspecialchars($reserva['observacionReserva'] ?? '') ?>">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Actualizar Reserva</button>
                <a href="index.php?url=Reserva&type=list" class="btn btn-outline-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
