<?php

namespace App\Models;

use App\config\database\DbConnect;
use PDO;

class ReportesModel extends DbConnect {
    public function getUsoLaboratorios() {
        $this->connect();
        $sql = "SELECT l.idLaboratorio, l.nomLaboratorio,
                       COUNT(r.idReserva) AS total_reservas
                FROM tbllaboratorio l
                LEFT JOIN tblreserva r ON l.idLaboratorio = r.idLaboratorio
                GROUP BY l.idLaboratorio, l.nomLaboratorio
                ORDER BY total_reservas DESC";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $max = $rows ? max(array_column($rows, 'total_reservas')) : 0;
        foreach ($rows as &$row) {
            $row['porcentaje'] = $max > 0 ? round(($row['total_reservas'] / $max) * 100) : 0;
        }
        return $rows;
    }

    public function getStockResumen() {
        $model = new InsumosModel();
        $insumos = $model->getAll();

        $optimo = 0; $critico = 0; $agotado = 0;
        foreach ($insumos as $insumo) {
            $disp = (float)($insumo['cantidadDispInsumos'] ?? 0);
            $min = (float)($insumo['cantidadMinInsumos'] ?? 0);
            if ($disp <= 0) { $agotado++; }
            elseif ($disp <= $min) { $critico++; }
            else { $optimo++; }
        }
        return [
            'optimo' => $optimo, 'critico' => $critico,
            'agotado' => $agotado, 'total' => $optimo + $critico + $agotado,
        ];
    }

    public function getReporte($tipo, $fechaInicio = '', $fechaFin = '', $filtroCampo = '', $filtroValor = '') {
        $this->connect();
        $params = [];

        switch ($tipo) {
            case 'ocupacion':
                $sql = "SELECT r.idReserva, r.nombreReserva, r.fechaReserva,
                               r.horaInicioReserva, r.horaFinReserva, r.estadoReserva,
                               l.nomLaboratorio
                        FROM tblreserva r
                        JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
                        WHERE 1=1";
                if ($fechaInicio) { $sql .= " AND r.fechaReserva >= :fi"; $params[':fi'] = $fechaInicio; }
                if ($fechaFin) { $sql .= " AND r.fechaReserva <= :ff"; $params[':ff'] = $fechaFin; }
                $sql .= " ORDER BY r.fechaReserva DESC LIMIT 50";
                break;

            case 'insumos':
                return $this->getAllInsumos();
                break;

            case 'docente':
                $sql = "SELECT r.idReserva, r.nombreReserva, r.fechaReserva,
                               r.horaInicioReserva, r.horaFinReserva, r.estadoReserva,
                               l.nomLaboratorio
                        FROM tblreserva r
                        JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
                        WHERE 1=1";
                if ($fechaInicio) { $sql .= " AND r.fechaReserva >= :fi"; $params[':fi'] = $fechaInicio; }
                if ($fechaFin) { $sql .= " AND r.fechaReserva <= :ff"; $params[':ff'] = $fechaFin; }
                $sql .= " ORDER BY r.fechaReserva DESC LIMIT 50";
                break;

            case 'mantenimiento':
                $sql = "SELECT a.idAnomalia, a.descripAnomalia, a.fechaDecteAnomalia,
                               a.estadoAnomalia, a.tipoAnomalia
                        FROM tblanomalia a
                        WHERE 1=1";
                if ($fechaInicio) { $sql .= " AND a.fechaDecteAnomalia >= :fi"; $params[':fi'] = $fechaInicio; }
                if ($fechaFin) { $sql .= " AND a.fechaDecteAnomalia <= :ff"; $params[':ff'] = $fechaFin; }
                $sql .= " ORDER BY a.fechaDecteAnomalia DESC LIMIT 50";
                break;

            case 'conflictos':
                $sql = "SELECT r.idReserva, r.nombreReserva, r.fechaReserva,
                               r.horaInicioReserva, r.horaFinReserva, l.nomLaboratorio,
                               r.estadoReserva
                        FROM tblreserva r
                        JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
                        WHERE r.estadoReserva = 'conflicto'";
                if ($fechaInicio) { $sql .= " AND r.fechaReserva >= :fi"; $params[':fi'] = $fechaInicio; }
                if ($fechaFin) { $sql .= " AND r.fechaReserva <= :ff"; $params[':ff'] = $fechaFin; }
                $sql .= " ORDER BY r.fechaReserva DESC LIMIT 50";
                break;

            default:
                return [];
        }

        $stmt = $this->con->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getAllInsumos() {
        $model = new InsumosModel();
        return $model->getAll();
    }
}
