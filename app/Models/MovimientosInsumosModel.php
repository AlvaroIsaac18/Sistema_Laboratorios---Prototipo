<?php

namespace App\Laboratorios\Models;

use App\Laboratorios\Config\Connect\ConnectDB;
use PDO;

class MovimientosInsumosModel extends ConnectDB
{
    public function getAll(): array
    {
        try {
            $conex = $this->getConnection();
            $sql = "SELECT
                        ir.idReserva,
                        ir.idInsumos,
                        ir.cantidadRequerida,
                        ir.estado AS estadoMovimiento,
                        i.nomInsumos,
                        i.unidadMedidaInsumos,
                        r.fechaReserva,
                        r.horaInicioReserva,
                        r.horaFinReserva,
                        r.nombreReserva,
                        'salida' AS tipoMovimiento
                    FROM tblinsumosreserva ir
                    JOIN tblinsumos i ON ir.idInsumos = i.idInsumos
                    LEFT JOIN tblreserva r ON ir.idReserva = r.idReserva
                    ORDER BY r.fechaReserva DESC
                    LIMIT 100";
            $stmt = $conex->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error en MovimientosInsumosModel::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getEntradas(): array
    {
        try {
            $conex = $this->getConnection();
            $sql = "SELECT
                        ti.idTecnico,
                        ti.idInsumos,
                        i.nomInsumos,
                        i.cantidadStock,
                        i.unidadMedidaInsumos,
                        t.nomTecnico,
                        'entrada' AS tipoMovimiento
                    FROM tbltecnicoinsumos ti
                    JOIN tblinsumos i ON ti.idInsumos = i.idInsumos
                    JOIN tbltecnico t ON ti.idTecnico = t.idTecnico
                    ORDER BY i.nomInsumos ASC";
            $stmt = $conex->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error en MovimientosInsumosModel::getEntradas: " . $e->getMessage());
            return [];
        }
    }
}
