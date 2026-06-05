<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-0">Nueva Reserva</h2>
        <p class="text-muted small">Registrar una nueva reserva de laboratorio</p>
    </div>
    <a href="index.php?url=Reserva&type=list" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="index.php?url=Reserva&type=register">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Nombre de la Práctica</label>
                    <input type="text" name="nombreReserva" class="form-control" required placeholder="Ej: Práctica de Química">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Laboratorio</label>
                    <select name="idLaboratorio" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($laboratorios as $lab): ?>
                        <option value="<?= $lab['idLaboratorio'] ?>"><?= htmlspecialchars($lab['nomLaboratorio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Fecha</label>
                    <input type="date" name="fechaReserva" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Hora Inicio</label>
                    <input type="time" name="horaInicioReserva" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Hora Fin</label>
                    <input type="time" name="horaFinReserva" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Estado</label>
                    <select name="estadoReserva" class="form-select">
                        <option value="activa">Activa (Ocupado)</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobada">Aprobada</option>
                        <option value="finalizada">Finalizada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Turno</label>
                    <select name="turnoReserva" class="form-select">
                        <option value="">Sin turno</option>
                        <option value="mañana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Objetivo</label>
                    <input type="text" name="objetivoReserva" class="form-control" placeholder="Objetivo de la práctica" maxlength="45">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Descripción</label>
                    <input type="text" name="descripReserva" class="form-control" placeholder="Descripción breve" maxlength="45">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Observaciones</label>
                    <input type="text" name="observacionReserva" class="form-control" placeholder="Observaciones adicionales" maxlength="45">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Guardar Reserva</button>
                <a href="index.php?url=Reserva&type=list" class="btn btn-outline-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
