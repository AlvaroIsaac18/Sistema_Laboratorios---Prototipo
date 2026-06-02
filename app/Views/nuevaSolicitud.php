<div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">Nueva Solicitud de Práctica</h2>
                    <a href="index.php?route=solicitudes" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Volver a Solicitudes</span>
                    </a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <form>
                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Información General</h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Asignatura / Práctica <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg bg-light" placeholder="Ej. Titulación Ácido-Base">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Sección <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg bg-light" placeholder="Ej. 2101">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Estudiantes Totales</label>
                                    <input type="number" class="form-control form-control-lg bg-light" placeholder="0" min="1">
                                </div>
                            </div>
                            
                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Espacio y Horario</h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold text-secondary">Laboratorio Requerido <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg bg-light">
                                        <option selected disabled>Seleccione un laboratorio...</option>
                                        <option>Lab. de Química A-01</option>
                                        <option>Lab. de Biología B-02</option>
                                        <option>Lab. de Informática C-01</option>
                                        <option>Lab. Seguridad S-01</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold text-secondary">Fecha Propuesta <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg bg-light">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold text-secondary">Hora Inicio</label>
                                    <input type="time" class="form-control form-control-lg bg-light">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold text-secondary">Hora Fin</label>
                                    <input type="time" class="form-control form-control-lg bg-light">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Requerimientos Técnicos y Materiales</h5>
                            <div class="mb-5">
                                <label class="form-label fw-semibold text-secondary">Insumos y Reactivos</label>
                                <textarea class="form-control bg-light" rows="4" placeholder="Ej. 100ml de Ácido Clorhídrico (0.1M), 5 Matraces de Erlenmeyer de 250ml..."></textarea>
                                <div class="form-text mt-2"><i class="bi bi-info-circle text-primary me-1"></i>Detalla cantidades y especificaciones de todo el material necesario para prevenir falta de stock.</div>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                                <button type="button" class="btn btn-light px-4 py-2 fw-semibold">Cancelar</button>
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow-sm d-flex justify-content-center align-items-center"><i class="bi bi-send-fill me-2"></i> Enviar Solicitud</button>
                            </div>
                        </form>
                    </div>
                </div>