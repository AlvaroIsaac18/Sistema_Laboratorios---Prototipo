<div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-0">Control de Entradas y Salidas</h2>
                        <p class="text-muted small">Registro del consumo y reposición de materiales del laboratorio</p>
                    </div>
                    <button class="btn btn-outline-primary bg-white d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-down-up"></i>
                        <span>Generar Nuevo Movimiento</span>
                    </button>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0 d-flex gap-2">
                        <select class="form-select border-0 shadow-sm w-auto bg-light">
                            <option selected>Mes Actual</option>
                            <option>Mes Anterior</option>
                        </select>
                        <select class="form-select border-0 shadow-sm w-auto bg-light">
                            <option selected>Todos los movimientos</option>
                            <option>Solo Entradas (Asignaciones)</option>
                            <option>Solo Salidas (Consumos)</option>
                        </select>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Tipo</th>
                                    <th>Insumo Relacionado</th>
                                    <th>Cantidad</th>
                                    <th>Motivo / Práctica</th>
                                    <th>Registrado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted"><i class="bi bi-calendar2-day me-2"></i>Hoy, 09:30 AM</td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1"><i class="bi bi-arrow-down-circle-fill me-1"></i>Salida (Uso)</span></td>
                                    <td class="fw-semibold">Ácido Clorhídrico (0.1M)</td>
                                    <td class="fw-bold text-danger">- 500 ml</td>
                                    <td>Práctica: Titulación Ácido-Base (S-045)</td>
                                    <td class="text-muted small">Téc. Manuel Rosa</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><i class="bi bi-calendar2-day me-2"></i>Ayer, 14:15 PM</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1"><i class="bi bi-arrow-up-circle-fill me-1"></i>Entrada (Asignación)</span></td>
                                    <td class="fw-semibold">Matraz Erlenmeyer 250ml</td>
                                    <td class="fw-bold text-success">+ 20 Unidades</td>
                                    <td>Reposición Anual Decanato de Ciencias</td>
                                    <td class="text-muted small">Lic. Ana Rojas (Coord.)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><i class="bi bi-calendar2-day me-2"></i>15 Mar 2026, 08:00 AM</td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1"><i class="bi bi-x-circle-fill me-1"></i>Salida (Desecho)</span></td>
                                    <td class="fw-semibold">Agar Nutritivo Vencido</td>
                                    <td class="fw-bold text-danger">- 2 Cajas</td>
                                    <td>Manejo de Desechos Biológicos (Norma P-01)</td>
                                    <td class="text-muted small">Téc. Luis Pérez</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>