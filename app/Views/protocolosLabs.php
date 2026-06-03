<div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 mb-1">Protocolos de Seguridad y Normativas</h2>
                        <p class="text-muted small mb-0">Directrices en el uso responsable de insumos y equipos</p>
                    </div>
                </div>

                <div class="row g-4 mb-4">
    <?php foreach ($cards as $card): ?>
    <div class="col-md-4">
        <a href="#" class="card text-decoration-none border-0 shadow-sm h-100 card-hover effect">
            <div class="card-body d-flex align-items-center">
                <div class="bg-<?= htmlspecialchars($card['color']) ?> bg-opacity-10 text-<?= htmlspecialchars($card['color']) ?> p-3 rounded-circle me-3">
                    <i class="bi <?= htmlspecialchars($card['icono']) ?> fs-2"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($card['titulo']) ?></h5>
                    <span class="small text-muted"><?= htmlspecialchars($card['subtitulo']) ?></span>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold text-dark mb-0">Listado de Descargas Oficiales</h5>
        <button class="btn btn-sm btn-primary"><i class="bi bi-cloud-upload me-1"></i> Subir Documento</button>
    </div>
    <div class="list-group list-group-flush">
        <?php if (empty($downloads)): ?>
        <div class="list-group-item border-0 py-3 text-center text-muted">No hay documentos disponibles para descarga.</div>
        <?php else: ?>
        <?php foreach ($downloads as $d): ?>
        <div class="list-group-item border-0 py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="bi <?= htmlspecialchars($d['icono']) ?> fs-3 text-<?= htmlspecialchars($d['iconColor']) ?> me-3"></i>
                <div>
                    <h6 class="mb-0 fw-bold"><?= htmlspecialchars($d['titulo']) ?></h6>
                    <small class="text-muted"><?= htmlspecialchars($d['subtitulo']) ?></small>
                </div>
            </div>
            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-download"></i> Descargar</button>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>