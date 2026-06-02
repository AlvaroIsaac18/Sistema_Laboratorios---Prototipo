<div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">Generador de Reportes Especializados</h2>
                    <a href="index.php?route=reportes" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Volver a Estadísticas</span>
                    </a>
                </div>

                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-5">
                                <form>
                                    <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Seleccione Criterios</h5>
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-secondary">Tipo de Reporte <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg bg-light">
                                            <option selected disabled>Seleccione...</option>
                                            <option>Ocupación General de Espacios</option>
                                            <option>Reporte de Entradas/Salidas de Insumos</option>
                                            <option>Historial de Prácticas por Docente</option>
                                            <option>Reporte Técnico de Mantenimiento</option>
                                            <option>Reporte de Horarios en Conflicto y Soluciones</option>
                                        </select>
                                    </div>
                                    
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold text-secondary">Fecha Inicial</label>
                                            <input type="date" class="form-control form-control-lg bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold text-secondary">Fecha Final</label>
                                            <input type="date" class="form-control form-control-lg bg-light">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-secondary">Filtrado Avanzado (Opcional)</label>
                                        <div class="input-group">
                                            <select class="form-select bg-light" style="max-width: 150px;">
                                                <option>Docente</option>
                                                <option>Laboratorio</option>
                                                <option>Práctica</option>
                                            </select>
                                            <input type="text" class="form-control bg-light" placeholder="Ej. Ricardo Silva">
                                        </div>
                                    </div>

                                    <h5 class="fw-bold mb-4 text-primary border-bottom pb-2 mt-5">Formato de Salida</h5>
                                    
                                    <div class="d-flex gap-4 mb-5">
                                        <div class="form-check">
                                            <input class="form-check-input fs-5" type="radio" name="formatRadio" id="pdf" checked>
                                            <label class="form-check-label d-flex align-items-center fw-semibold mt-1" for="pdf">
                                                <i class="bi bi-file-earmark-pdf fs-4 text-danger me-2"></i> Documento PDF
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input fs-5" type="radio" name="formatRadio" id="excel">
                                            <label class="form-check-label d-flex align-items-center fw-semibold mt-1" for="excel">
                                                <i class="bi bi-file-earmark-spreadsheet fs-4 text-success me-2"></i> Hoja de Cálculo (Excel)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="border-top pt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm d-flex justify-content-center align-items-center gap-2">
                                            <i class="bi bi-printer-fill fs-5"></i> Construir y Descargar Reporte
                                        </button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>