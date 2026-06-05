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
                                <?php if (empty($movimientos)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No hay movimientos registrados.</td>
                                </tr>
                                <?php else: ?>
                                <?php foreach ($movimientos as $m): ?>
                                <tr>
                                    <td class="text-muted"><i class="bi bi-calendar2-day me-2"></i><?= htmlspecialchars($m['fecha'] ?: '—') ?></td>
                                    <td>
                                        <?php if ($m['tipo'] === 'salida'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1"><i class="bi bi-arrow-down-circle-fill me-1"></i>Salida</span>
                                        <?php else: ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1"><i class="bi bi-arrow-up-circle-fill me-1"></i>Entrada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-semibold"><?= htmlspecialchars($m['nomInsumos']) ?></td>
                                    <td class="fw-bold <?= $m['tipo'] === 'salida' ? 'text-danger' : 'text-success' ?>"><?= htmlspecialchars($m['cantidad']) ?> <?= htmlspecialchars($m['unidadMedida']) ?></td>
                                    <td><?= htmlspecialchars($m['motivo']) ?></td>
                                    <td class="text-muted small"><?= htmlspecialchars($m['registradoPor']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>