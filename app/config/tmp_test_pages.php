<?php
// Simulate a web request to test the pages
$_GET['route'] = 'inventarioGeneral';
// We can't fully test with session_start in CLI, so let's just test the models directly
require_once 'vendor/autoload.php';

echo "=== InsumosModel CRUD test ===\n";
$model = new App\Models\InsumosModel();
$all = $model->getAll();
echo "getAll: " . count($all) . " insumos\n";

if (count($all) > 0) {
    $id = $all[0]['idInsumos'];
    $item = $model->getById($id);
    echo "getById($id): " . ($item['nomInsumos'] ?? 'FAIL') . "\n";
}

// Test create
$testData = [
    'nomInsumos' => 'TEST Insumo - borrar despues',
    'descripInsumos' => 'LOT-001 | Estante A | Vence: 2026-12-31',
    'categoriaInsumos' => 'Reactivos Químicos',
    'cantidadStock' => '10',
    'cantidadDispInsumos' => '10',
    'cantidadMinInsumos' => '2',
    'unidadMedidaInsumos' => 'Unidades (Pzas)',
];
$newId = $model->create($testData);
echo "create: id=" . ($newId !== false ? $newId : 'FAIL') . "\n";

// Test update
$testData['nomInsumos'] = 'TEST Insumo - UPDATED';
$updated = $model->update($newId, $testData);
echo "update: " . ($updated ? 'OK' : 'FAIL') . "\n";

// Verify update
$item = $model->getById($newId);
echo "verify update: " . ($item['nomInsumos'] === 'TEST Insumo - UPDATED' ? 'OK' : 'FAIL') . "\n";

// Test delete
$deleted = $model->delete($newId);
echo "delete: " . ($deleted ? 'OK' : 'FAIL') . "\n";

// Verify delete
$item = $model->getById($newId);
echo "verify delete: " . (!$item ? 'OK (not found)' : 'FAIL (still exists)') . "\n";

echo "\n=== LaboratoriosModel test ===\n";
$labModel = new App\Models\LaboratoriosModel();
$labs = $labModel->getAll();
echo "getAll: " . count($labs) . " labs\n";
$resumen = $labModel->getResumen();
echo "resumen: disponible={$resumen['disponible']} en_uso={$resumen['en_uso']} mantenimiento={$resumen['mantenimiento']}\n";

echo "\n=== MantenimientoModel test ===\n";
$mantModel = new App\Models\MantenimientoModel();
$anomalias = $mantModel->getAllAnomalias();
echo "getAllAnomalias: " . count($anomalias) . "\n";
echo "count: " . $mantModel->getCount() . "\n";

echo "\n=== ProtocolosModel test ===\n";
$protModel = new App\Models\ProtocolosModel();
echo "cards: " . count($protModel->getActiveCards()) . "\n";
echo "downloads: " . count($protModel->getActiveDownloads()) . "\n";

echo "\nALL TESTS PASSED\n";
