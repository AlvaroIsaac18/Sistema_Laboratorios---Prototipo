<?php
namespace App\Controllers;

use App\Models\HorarioModel;

$pageTitle = "Horarios - Sistema de Laboratorios";
$activeRoute = "horarios";

if (isset($_GET['type'])) {

    $object = new HorarioModel();

    // Vista principal del cronograma semanal
    if ($_GET['type'] == 'cronograma') {

        if (isset($_POST['getCronograma'])) {
            $result = $object->getCronogramaSemanal();
            echo json_encode($result);
            die();
        }

        if (isset($_POST['getCronogramaMensual'])) {
            $result = $object->getCronogramaMensual();
            echo json_encode($result);
            die();
        }

        $viewPath = "app/Views/horarios/cronogramaView.php";
        include "app/Views/layouts/main.php";
    }

    // Vista de conflictos y soluciones
    elseif ($_GET['type'] == 'conflictos') {

        if (isset($_POST['getConflictos'])) {
            $result = $object->getConflictos();
            echo json_encode($result);
            die();
        }

        if (isset($_POST['resolverConflicto'])) {
            $result = $object->resolverConflicto($_POST['idAnomalia']);
            echo json_encode($result);
            die();
        }

        $viewPath = "app/Views/horarios/conflictosView.php";
        include "app/Views/layouts/main.php";
    }

    // Tipo de vista no válido
    else {
        echo "Error: Tipo de vista no válido.";
    }

} else {
    $viewPath = "app/Views/horarios/cronogramaView.php";
    include "app/Views/layouts/main.php";
}