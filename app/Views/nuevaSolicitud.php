<div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">Nueva Solicitud de Práctica</h2>
                    <a href="index.php?url=Solicitud&type=list" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Volver a Solicitudes</span>
                    </a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <form action="index.php?url=Solicitud&type=create" method="POST">
                            <p class="text-muted small mb-4">Registrado por: <span class="fw-bold text-primary"><?php echo htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario'); ?></span></p>
                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Información General</h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-secondary">Docente Responsable <span class="text-danger">*</span></label>
                                    <select name="idDocente" class="form-select form-select-lg bg-light" required>
                                        <option value="" selected disabled>Seleccione el docente que dictará la práctica...</option>
                                        <?php foreach ($docentes as $doc): ?>
                                            <option value="<?= $doc['idDocente'] ?>"><?= htmlspecialchars($doc['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Asignatura / Práctica <span class="text-danger">*</span></label>
                                    <input type="text" name="asignatura" class="form-control form-control-lg bg-light" placeholder="Ej. Titulación Ácido-Base" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Sección <span class="text-danger">*</span></label>
                                    <input type="text" name="seccion" class="form-control form-control-lg bg-light" placeholder="Ej. 2101" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Estudiantes Totales</label>
                                    <input type="number" name="estudiantes" class="form-control form-control-lg bg-light" placeholder="0" min="1" required>
                                </div>
                            </div>
                            
                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Espacio y Horario</h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold text-secondary">Laboratorio Requerido <span class="text-danger">*</span></label>
                                    <select name="laboratorio" class="form-select form-select-lg bg-light" required>
                                        <option selected disabled>Seleccione un laboratorio...</option>
                                        <?php foreach ($laboratorios as $lab): ?>
                                        <option value="<?= htmlspecialchars($lab['nomLaboratorio']) ?>"><?= htmlspecialchars($lab['nomLaboratorio']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Fecha Propuesta <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha" class="form-control form-control-lg bg-light" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold text-secondary">Hora Inicio</label>
                                    <input type="time" name="horaInicio" class="form-control form-control-lg bg-light" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold text-secondary">Hora Fin</label>
                                    <input type="time" name="horaFin" class="form-control form-control-lg bg-light" required>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Requerimientos Técnicos y Materiales</h5>
                            <div class="mb-5">
                                <label class="form-label fw-semibold text-secondary">Insumos y Reactivos</label>
                                <textarea name="insumos" class="form-control bg-light" rows="4" placeholder="Ej. 100ml de Ácido Clorhídrico (0.1M), 5 Matraces de Erlenmeyer de 250ml..."></textarea>
                                <div class="form-text mt-2"><i class="bi bi-info-circle text-primary me-1"></i>Detalla cantidades y especificaciones de todo el material necesario para prevenir falta de stock.</div>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                                <a href="index.php?url=Solicitud&type=list" class="btn btn-light px-4 py-2 fw-semibold">Cancelar</a>
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow-sm d-flex justify-content-center align-items-center"><i class="bi bi-send-fill me-2"></i> Enviar Solicitud</button>
                            </div>
                        </form>
                    </div>
                </div>