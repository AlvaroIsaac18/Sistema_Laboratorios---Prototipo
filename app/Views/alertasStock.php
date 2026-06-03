<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-0 text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Centro de Alertas de Insumos</h2>
        <p class="text-muted small mt-1">Monitoreo de material crítico para el desarrollo de prácticas de laboratorio</p>
    </div>
</div>

<?php if (empty($agotados) && empty($stockBajo) && empty($proximoVencer)): ?>
<div class="card border-0 shadow-sm bg-success bg-opacity-10 border-top border-4 border-success">
    <div class="card-body p-5 text-center">
        <i class="bi bi-check-circle fs-1 text-success d-block mb-3"></i>
        <h4 class="fw-bold text-success">Todo en orden</h4>
        <p class="text-muted mb-0">No hay insumos agotados, con stock bajo ni próximos a vencer.</p>
    </div>
</div>
<?php else: ?>

<div class="row g-4 mt-2">
    <?php foreach ($agotados as $insumo): ?>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-4 border-danger bg-danger bg-opacity-10">
            <div class="card-body p-4 text-center">
                <i class="bi bi-slash-circle fs-1 text-danger d-block mb-3"></i>
                <h5 class="fw-bold text-dark"><?= htmlspecialchars($insumo['nomInsumos']) ?></h5>
                <p class="text-danger fw-semibold mb-1">¡Agotado Completamente!</p>
                <p class="small text-muted mb-4">Stock disponible: 0 <?= htmlspecialchars($insumo['unidadMedidaInsumos'] ?? '') ?></p>
                <a href="index.php?route=nuevoInsumo" class="btn btn-sm btn-danger w-100 fw-bold">Registrar Nuevo Insumo</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php foreach ($stockBajo as $insumo): ?>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-4 border-warning bg-warning bg-opacity-10">
            <div class="card-body p-4 text-center">
                <i class="bi bi-arrow-down-square fs-1 text-warning d-block mb-3"></i>
                <h5 class="fw-bold text-dark"><?= htmlspecialchars($insumo['nomInsumos']) ?></h5>
                <p class="fw-bold mb-1">Solo quedan <?= htmlspecialchars($insumo['cantidadDispInsumos']) ?> <?= htmlspecialchars($insumo['unidadMedidaInsumos'] ?? '') ?></p>
                <p class="small text-muted mb-4">Stock mínimo recomendado: <?= htmlspecialchars($insumo['cantidadMinInsumos']) ?> <?= htmlspecialchars($insumo['unidadMedidaInsumos'] ?? '') ?></p>
                <a href="index.php?route=inventarioGeneral" class="btn btn-sm btn-outline-dark border-warning w-100 fw-bold">Ver Inventario</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php foreach ($proximoVencer as $insumo): ?>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-4 border-secondary bg-light">
            <div class="card-body p-4 text-center">
                <i class="bi bi-clock-history fs-1 text-secondary d-block mb-3"></i>
                <h5 class="fw-bold text-dark"><?= htmlspecialchars($insumo['nomInsumos']) ?></h5>
                <p class="text-secondary fw-semibold mb-1">Vence en <?= $insumo['diasRestantes'] ?> día<?= $insumo['diasRestantes'] !== 1 ? 's' : '' ?></p>
                <p class="small text-muted mb-4">Fecha de vencimiento: <?= htmlspecialchars($insumo['fechaVence']) ?>. Se debe priorizar su uso o desechar según protocolo.</p>
                <a href="index.php?route=inventarioGeneral" class="btn btn-sm btn-secondary w-100 fw-bold border-0">Revisar Inventario</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>