<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Editar Insumo</h2>
        <p class="text-muted small mb-0">Modificar datos del material, reactivo o equipo</p>
    </div>
    <a href="index.php?route=inventarioGeneral" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Volver a Inventario</span>
    </a>
</div>

<?php if ($errorMessage): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i> <?= htmlspecialchars($errorMessage) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-md-5">
        <form action="index.php?route=editarInsumo&id=<?= $insumo['idInsumos'] ?>" method="POST">
            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Información Básica</h5>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Nombre del Material o Reactivo <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($insumo['nomInsumos'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Categoría / Clasificación <span class="text-danger">*</span></label>
                    <select name="categoria" class="form-select form-select-lg bg-light" required>
                        <option disabled>Seleccione...</option>
                        <option value="Reactivos Químicos" <?= ($insumo['categoriaInsumos'] ?? '') === 'Reactivos Químicos' ? 'selected' : '' ?>>Reactivos Químicos</option>
                        <option value="Material de Vidrio (Vidriería)" <?= ($insumo['categoriaInsumos'] ?? '') === 'Material de Vidrio (Vidriería)' ? 'selected' : '' ?>>Material de Vidrio (Vidriería)</option>
                        <option value="Material Biológico" <?= ($insumo['categoriaInsumos'] ?? '') === 'Material Biológico' ? 'selected' : '' ?>>Material Biológico</option>
                        <option value="Equipos e Instrumentos" <?= ($insumo['categoriaInsumos'] ?? '') === 'Equipos e Instrumentos' ? 'selected' : '' ?>>Equipos e Instrumentos</option>
                        <option value="Insumos Desechables (Guantes/Mascarillas)" <?= ($insumo['categoriaInsumos'] ?? '') === 'Insumos Desechables (Guantes/Mascarillas)' ? 'selected' : '' ?>>Insumos Desechables (Guantes/Mascarillas)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Código del Lote / Catálogo</label>
                    <input type="text" name="codigoLote" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($descripParts[0] ?? '') ?>" placeholder="Ej. LOT-982-Q">
                </div>
            </div>

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Medición y Stock</h5>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Stock Total <span class="text-danger">*</span></label>
                    <input type="number" name="cantidadStock" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($insumo['cantidadStock'] ?? '0') ?>" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Stock Disponible <span class="text-danger">*</span></label>
                    <input type="number" name="cantidadDispInsumos" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($insumo['cantidadDispInsumos'] ?? '0') ?>" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Unidad de Medida <span class="text-danger">*</span></label>
                    <select name="unidadMedida" class="form-select form-select-lg bg-light" required>
                        <option disabled>Seleccione...</option>
                        <option value="Unidades (Pzas)" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Unidades (Pzas)' ? 'selected' : '' ?>>Unidades (Pzas)</option>
                        <option value="Mililitros (ml)" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Mililitros (ml)' ? 'selected' : '' ?>>Mililitros (ml)</option>
                        <option value="Litros (L)" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Litros (L)' ? 'selected' : '' ?>>Litros (L)</option>
                        <option value="Gramos (g)" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Gramos (g)' ? 'selected' : '' ?>>Gramos (g)</option>
                        <option value="Kilogramos (kg)" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Kilogramos (kg)' ? 'selected' : '' ?>>Kilogramos (kg)</option>
                        <option value="Cajas / Paquetes" <?= ($insumo['unidadMedidaInsumos'] ?? '') === 'Cajas / Paquetes' ? 'selected' : '' ?>>Cajas / Paquetes</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">Stock Mínimo Alerta <span class="text-danger">*</span></label>
                    <input type="number" name="stockMinimo" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($insumo['cantidadMinInsumos'] ?? '0') ?>" min="1" required>
                    <div class="form-text small">Disparará una alerta visual si el inventario cae por debajo de este límite.</div>
                </div>
            </div>

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">Almacenamiento y Vencimiento</h5>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Ubicación Física (Estantería/Vitrina)</label>
                    <input type="text" name="ubicacion" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($descripParts[1] ?? '') ?>" placeholder="Ej. Estante B, Fila 3, Lab A-01">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Fecha de Vencimiento (Si aplica)</label>
                    <input type="date" name="fechaVencimiento" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars(str_replace('Vence: ', '', $descripParts[2] ?? '')) ?>">
                    <div class="form-text small">Indispensable para reactivos químicos y material biológico perecedero.</div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                <a href="index.php?route=inventarioGeneral" class="btn btn-light px-4 py-2 fw-semibold">Cancelar</a>
                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow-sm d-flex justify-content-center align-items-center">
                    <i class="bi bi-save me-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>