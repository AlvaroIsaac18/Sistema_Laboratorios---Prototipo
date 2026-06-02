<div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-1">Mantenimiento de Laboratorios</h2>
                        <p class="text-muted small mb-0">Gestión de reparaciones, limpieza y calibración de equipos</p>
                    </div>
                    <button class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i>
                        <span>Programar Mantenimiento</span>
                    </button>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="card-title fw-bold mb-0">Órdenes de Mantenimiento Activas</h5>
                    </div>
                    <div class="table-responsive px-3 pb-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Orden N°</th>
                                    <th>Laboratorio</th>
                                    <th>Tipo de Trabajo</th>
                                    <th>Responsable Técnico</th>
                                    <th>Fecha Estimada</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted fw-bold">#M-201</td>
                                    <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>Lab. S-01</span></td>
                                    <td><span class="d-block fw-semibold text-dark">Calibración de Equipos</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-tools text-muted fs-5 me-2"></i>
                                            <span class="small fw-semibold">Personal de Apoyo Central</span>
                                        </div>
                                    </td>
                                    <td><span class="d-block text-dark"><i class="bi bi-calendar me-1 text-primary"></i> 12 Abr - 15 Abr</span></td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning text-dark border border-warning border-opacity-25 px-2 py-1"><i class="bi bi-arrow-repeat me-1"></i>En Progreso</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" title="Ver Detalles"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-success" title="Marcar Terminado"><i class="bi bi-check2-circle"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">#M-198</td>
                                    <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>Lab. C-01</span></td>
                                    <td><span class="d-block fw-semibold text-dark">Limpieza Profunda e Inventario</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-tools text-muted fs-5 me-2"></i>
                                            <span class="small fw-semibold">Unidad de Servicios</span>
                                        </div>
                                    </td>
                                    <td><span class="d-block text-dark"><i class="bi bi-calendar me-1 text-primary"></i> 20 Abr</span></td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1"><i class="bi bi-calendar-event me-1"></i>Programado</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" title="Ver Detalles"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" title="Cancelar"><i class="bi bi-x"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row g-4">
                    
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 border-0">
                                <h5 class="card-title fw-bold mb-0">Solicitar Asistencia Técnica Rápida</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Afectación en:</label>
                                        <select class="form-select bg-light">
                                            <option>Equipos de Computación</option>
                                            <option>Aires Acondicionados</option>
                                            <option>Iluminación y Eléctrica</option>
                                            <option>Tuberías y Extractores</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Descripción de la Falla</label>
                                        <textarea class="form-control bg-light" rows="3" placeholder="Detalle lo que ocurre..."></textarea>
                                    </div>
                                    <button class="btn btn-warning w-100 fw-bold"><i class="bi bi-cone-striped me-2"></i>Emitir Reporte Inmediato</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100 bg-light text-center border-dashed">
                            <div class="card-body p-5 d-flex flex-column justify-content-center">
                                <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-bar-chart fs-1 text-secondary"></i>
                                </div>
                                <h4 class="text-dark fw-bold">12 Mantenimientos Realizados</h4>
                                <p class="text-muted small">Durante el presente semestre, el tiempo promedio de respuesta es de 48 horas tras reportarse la falla.</p>
                                <a href="index.php?route=generacionReportes" class="btn btn-outline-secondary mt-3 align-self-center"><i class="bi bi-file-earmark-text me-2"></i>Ver Reporte Completo de Reparaciones</a>
                            </div>
                        </div>
                    </div>
                </div>