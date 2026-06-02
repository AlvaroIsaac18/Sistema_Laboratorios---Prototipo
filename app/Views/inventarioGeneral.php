<div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-0">Inventario General de Laboratorios</h2>
                        <p class="text-muted small">Catálogo de materiales, equipos y reactivos disponibles para prácticas académicas</p>
                    </div>
                    <a href="index.php?route=nuevoInsumo" class="btn btn-primary shadow-sm"><i class="bi bi-plus-lg me-2"></i>Registrar Insumo</a>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <select class="form-select border-0 shadow-sm">
                            <option selected>Todos los Laboratorios</option>
                            <option>Lab. de Química A-01</option>
                            <option>Lab. de Biología B-02</option>
                            <option>Lab. de Anatomía C-01</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select border-0 shadow-sm">
                            <option selected>Cualquier Categoría</option>
                            <option>Reactivos Químicos</option>
                            <option>Vidriería</option>
                            <option>Equipos</option>
                            <option>Material de Bioseguridad</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group shadow-sm rounded">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" class="form-control border-0" placeholder="Buscar por nombre o número de lote...">
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="table-responsive p-3">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Cód.</th>
                                    <th>Nombre del Artículo</th>
                                    <th>Categoría</th>
                                    <th>Lab. Designado</th>
                                    <th>Cant. Disponible</th>
                                    <th>Unidad</th>
                                    <th class="text-end">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted fw-bold">REA-012</td>
                                    <td class="fw-semibold text-dark">Ácido Sulfúrico (98%)</td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">Reactivo</span></td>
                                    <td>Lab. Química A-01</td>
                                    <td class="fw-bold text-success fs-5">5.2</td>
                                    <td class="text-muted">Litros (L)</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">VID-005</td>
                                    <td class="fw-semibold text-dark">Matraz Erlenmeyer 250ml</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">Vidriería</span></td>
                                    <td>Lab. Química A-01</td>
                                    <td class="fw-bold text-dark fs-5">45</td>
                                    <td class="text-muted">Unidades</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">EQU-034</td>
                                    <td class="fw-semibold text-dark">Microscopio Óptico Binocular</td>
                                    <td><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">Equipos</span></td>
                                    <td>Lab. Biología B-02</td>
                                    <td class="fw-bold text-dark fs-5">12</td>
                                    <td class="text-muted">Equipos</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-bold">BIO-001</td>
                                    <td class="fw-semibold text-dark">Guantes de Nitrilo Talla M</td>
                                    <td><span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">Bioseguridad</span></td>
                                    <td>Almacén Central</td>
                                    <td class="fw-bold text-warning fs-5">2</td>
                                    <td class="text-muted">Cajas (x100)</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>