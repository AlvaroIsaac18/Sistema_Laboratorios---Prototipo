<?php
$obs = $solicitud['observacionSolicitudPractica'] ?? '';
$asignatura  = '';
$seccion     = '';
$estudiantes = '';
$laboratorio = '';
$insumos     = '';
if (preg_match('/Asignatura:\s*([^,]+)/', $obs, $m)) $asignatura = trim($m[1]);
if (preg_match('/Sección:\s*([^,]+)/', $obs, $m)) $seccion = trim($m[1]);
if (preg_match('/Estudiantes:\s*(\d+)/', $obs, $m)) $estudiantes = $m[1];
if (preg_match('/Laboratorio:\s*([^,]+)/', $obs, $m)) $laboratorio = trim($m[1]);
if (preg_match('/Insumos\/Reactivos:\s*(.+)/', $obs, $m)) $insumos = trim($m[1]);
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Editar Solicitud #S-<?= str_pad($solicitud['idSolicitudPractica'], 3, '0', STR_PAD_LEFT) ?></h2>
    <a href="index.php?url=Solicitud&type=list" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Volver a Solicitudes</span>
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-md-5">
        <form action="index.php?url=Solicitud&type=update&id=<?= $solicitud['idSolicitudPractica'] ?>" method="POST">
            <p class="text-muted small mb-4">
                Editado por: <span class="fw-bold text-primary"><?= htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario') ?></span>
                &middot; Estado actual: <span class="badge bg-info bg-opacity-10 text-info"><?= ucfirst($solicitud['estadoSolicitudPractica'] ?? 'pendiente') ?></span>
            </p>

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Información General</h5>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Asignatura / Práctica</label>
                    <input type="text" name="asignatura" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($asignatura) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Sección</label>
                    <input type="text" name="seccion" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($seccion) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Estudiantes</label>
                    <input type="number" name="estudiantes" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($estudiantes) ?>" min="1">
                </div>
            </div>

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Espacio y Horario</h5>
            <div class="row g-4 mb-5">
                <div class="col-md-5">
                    <label class="form-label fw-semibold text-secondary">Laboratorio Requerido</label>
                    <select name="laboratorio" class="form-select form-select-lg bg-light">
                        <option value="">Seleccione un laboratorio...</option>
                        <?php foreach ($laboratorios as $lab): ?>
                        <option value="<?= htmlspecialchars($lab['nomLaboratorio']) ?>" <?= ($lab['nomLaboratorio'] === $laboratorio) ? 'selected' : '' ?>><?= htmlspecialchars($lab['nomLaboratorio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Fecha Propuesta</label>
                    <input type="date" name="fecha" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($solicitud['fechaSolicitudPractica'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold text-secondary">Hora Inicio</label>
                    <input type="time" name="horaInicio" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($solicitud['horaInicioSolicitudPractica'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold text-secondary">Hora Fin</label>
                    <input type="time" name="horaFin" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($solicitud['horaFinSolicitudPractica'] ?? '') ?>">
                </div>
            </div>

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Requerimientos Técnicos y Materiales</h5>
            <div class="mb-5">
                <label class="form-label fw-semibold text-secondary">Insumos y Reactivos</label>
                <textarea name="insumos" class="form-control bg-light" rows="4"><?= htmlspecialchars($insumos) ?></textarea>
            </div>

            <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                <a href="index.php?url=Solicitud&type=list" class="btn btn-light px-4 py-2 fw-semibold">Cancelar</a>
                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow-sm d-flex justify-content-center align-items-center"><i class="bi bi-save me-2"></i> Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
