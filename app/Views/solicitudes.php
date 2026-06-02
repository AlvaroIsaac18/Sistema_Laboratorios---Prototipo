<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Gestión de Solicitudes</h2>
    <button class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i>
        <span>Nueva Solicitud</span>
    </button>
</div>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Solicitudes Entrantes y Pendientes</h5>
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm active">Todas</button>
            <button class="btn btn-outline-warning btn-sm">Pendientes</button>
            <button class="btn btn-outline-success btn-sm">Aprobadas</button>
            <button class="btn btn-outline-danger btn-sm">Rechazadas</button>
        </div>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Cód.</th>
                    <th>Docente</th>
                    <th>Práctica / Asignatura</th>
                    <th>Espacio / Lab.</th>
                    <th>Fecha y Hora</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-muted fw-bold">#S-102</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold">Prof. Ricardo Silva</span>
                                <span class="small text-muted">Procesos Químicos</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="d-block">Titulación Ácido-Base</span>
                        <span class="small text-primary"><i class="bi bi-box-seam me-1"></i>Requiere Insumos (3)</span>
                    </td>
                    <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>Lab. A-01</span></td>
                    <td>
                        <span class="d-block"><i class="bi bi-calendar me-1"></i> 10 Abr 2026</span>
                        <span class="small text-muted"><i class="bi bi-clock me-1"></i> 08:00 - 10:00</span>
                    </td>
                    <td><span class="badge bg-info bg-opacity-10 text-info">En Verificación</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-success me-1" title="Aprobar"><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-sm btn-outline-danger me-1" title="Rechazar"><i class="bi bi-x-lg"></i></button>
                        <button class="btn btn-sm btn-outline-primary" title="Ver Detalles"><i class="bi bi-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted fw-bold">#S-103</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold">Ing. Carlos Mena</span>
                                <span class="small text-muted">Física Aplicada</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="d-block">Leyes de Newton</span>
                        <span class="small text-muted"><i class="bi bi-card-checklist me-1"></i>Materiales listos</span>
                    </td>
                    <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>Lab. D-02</span></td>
                    <td>
                        <span class="d-block"><i class="bi bi-calendar me-1"></i> 15 Abr 2026</span>
                        <span class="small text-muted"><i class="bi bi-clock me-1"></i> 10:00 - 12:00</span>
                    </td>
                    <td><span class="badge bg-warning bg-opacity-10 text-warning">Pendiente</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-success me-1" title="Aprobar"><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-sm btn-outline-danger me-1" title="Rechazar"><i class="bi bi-x-lg"></i></button>
                        <button class="btn btn-sm btn-outline-primary" title="Ver Detalles"><i class="bi bi-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted fw-bold">#S-099</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold">Dra. Elena Ramos</span>
                                <span class="small text-muted">Microbiología</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="d-block">Cultivo de Bacterias</span>
                        <span class="small text-primary"><i class="bi bi-box-seam me-1"></i>Requiere Insumos (5)</span>
                    </td>
                    <td><span class="badge bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>Lab. B-02</span></td>
                    <td>
                        <span class="d-block"><i class="bi bi-calendar me-1"></i> 05 Abr 2026</span>
                        <span class="small text-muted"><i class="bi bi-clock me-1"></i> 14:00 - 17:00</span>
                    </td>
                    <td><span class="badge bg-success bg-opacity-10 text-success">Aprobada</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary" disabled title="Aprobada"><i class="bi bi-check-all"></i></button>
                        <button class="btn btn-sm btn-outline-primary" title="Comprobante"><i class="bi bi-file-earmark-pdf"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
