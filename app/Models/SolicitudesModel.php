<?php

namespace App\Laboratorios\Models;

use App\Laboratorios\Config\Connect\ConnectDB;
use PDO;

class SolicitudesModel extends ConnectDB
{
    public function createSolicitud(array $data): array|false
    {
        try {
            $conex = $this->getConnection();

            
            try {
                $conex->exec("ALTER TABLE tblsolicitudpractica MODIFY COLUMN idSolicitudPractica int(11) NOT NULL AUTO_INCREMENT");
            } catch (\PDOException $e) {
                
            }

            $sql = "INSERT INTO tblsolicitudpractica (
                        observacionSolicitudPractica,
                        fechaSolicitudPractica,
                        horaInicioSolicitudPractica,
                        horaFinSolicitudPractica,
                        estadoSolicitudPractica,
                        idPersonalDireccion
                    ) VALUES (
                        :observacion, :fecha, :horaInicio, :horaFin, :estado, :idPersonal
                    )";

            // Ensure column can hold the full observacion
            try {
                $conex->exec("ALTER TABLE tblsolicitudpractica MODIFY COLUMN observacionSolicitudPractica varchar(255) NOT NULL");
            } catch (\PDOException $e) {
                // Already altered, ignore
            }

            $stmt = $conex->prepare($sql);
            $stmt->bindValue(':observacion', substr($data['observacion'] ?? '', 0, 255));
            $stmt->bindValue(':fecha', $data['fecha'] ?? null);
            $stmt->bindValue(':horaInicio', $data['horaInicio'] ?? '');
            $stmt->bindValue(':horaFin', $data['horaFin'] ?? '');
            $stmt->bindValue(':estado', $data['estado'] ?? 'pendiente');
            $stmt->bindValue(':idPersonal', $data['idPersonalDireccion'] ?? 1, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }

            $newId = (int)$conex->lastInsertId();

            
            if (!empty($data['idDocente'])) {
                $upd = $conex->prepare("UPDATE tbldocente SET idSolicitudPractica = :idSol WHERE idDocente = :idDoc");
                $upd->bindValue(':idSol', $newId, PDO::PARAM_INT);
                $upd->bindValue(':idDoc', (int)$data['idDocente'], PDO::PARAM_INT);
                $upd->execute();
            }

            return ['id' => $newId];
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::createSolicitud: " . $e->getMessage());
            return false;
        }
    }

    public function updateSolicitud(int $id, array $data): bool
    {
        try {
            $conex = $this->getConnection();
            $sql = "UPDATE tblsolicitudpractica SET
                        observacionSolicitudPractica = :observacion,
                        fechaSolicitudPractica       = :fecha,
                        horaInicioSolicitudPractica  = :horaInicio,
                        horaFinSolicitudPractica     = :horaFin,
                        idPersonalDireccion          = :idPersonal
                    WHERE idSolicitudPractica = :id";
            $stmt = $conex->prepare($sql);
            // Ensure column can hold the full observacion
            try {
                $conex->exec("ALTER TABLE tblsolicitudpractica MODIFY COLUMN observacionSolicitudPractica varchar(255) NOT NULL");
            } catch (\PDOException $e) {
                // Already altered, ignore
            }

            $stmt->bindValue(':observacion', substr($data['observacion'] ?? '', 0, 255));
            $stmt->bindValue(':fecha', $data['fecha'] ?? null);
            $stmt->bindValue(':horaInicio', $data['horaInicio'] ?? '');
            $stmt->bindValue(':horaFin', $data['horaFin'] ?? '');
            $stmt->bindValue(':idPersonal', $data['idPersonalDireccion'] ?? 1, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::updateSolicitud: " . $e->getMessage());
            return false;
        }
    }

    public function getAll(string $estado = null, int $limit = 50): array
    {
        try {
            $conex = $this->getConnection();
            $sql = "SELECT s.*,
                           (SELECT CONCAT(nomDocente, ' ', apellidoDocente) FROM tbldocente WHERE idSolicitudPractica = s.idSolicitudPractica LIMIT 1) AS nombreDocente,
                           (SELECT cedulaDocente FROM tbldocente WHERE idSolicitudPractica = s.idSolicitudPractica LIMIT 1) AS cedulaDocente,
                           p.nomPersonalDireccion
                    FROM tblsolicitudpractica s
                    LEFT JOIN tblpersonaldireccion p ON s.idPersonalDireccion = p.idPersonalDireccion";
            $params = [];
            if ($estado !== null) {
                $sql .= " WHERE s.estadoSolicitudPractica = :estado";
                $params[':estado'] = $estado;
            }
            $sql .= " ORDER BY s.fechaSolicitudPractica DESC LIMIT " . (int)$limit;
            $stmt = $conex->prepare($sql);
            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::getAll: " . $e->getMessage());
            return [];
        }
    }

    public function update(int $id, string $estado): bool
    {
        try {
            $conex = $this->getConnection();
            $sql = "UPDATE tblsolicitudpractica SET estadoSolicitudPractica = :estado WHERE idSolicitudPractica = :id";
            $stmt = $conex->prepare($sql);
            $stmt->bindValue(':estado', $estado);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::update: " . $e->getMessage());
            return false;
        }
    }

    public function getPendientesCount(): int
    {
        try {
            $conex = $this->getConnection();
            $stmt = $conex->query("SELECT COUNT(*) FROM tblsolicitudpractica WHERE estadoSolicitudPractica = 'pendiente'");
            return (int) $stmt->fetchColumn();
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::getPendientesCount: " . $e->getMessage());
            return 0;
        }
    }

    public function getById(int $id): array|false
    {
        try {
            $conex = $this->getConnection();
            $sql = "SELECT s.*,
                           (SELECT CONCAT(nomDocente, ' ', apellidoDocente) FROM tbldocente WHERE idSolicitudPractica = s.idSolicitudPractica LIMIT 1) AS nombreDocente,
                           (SELECT cedulaDocente FROM tbldocente WHERE idSolicitudPractica = s.idSolicitudPractica LIMIT 1) AS cedulaDocente,
                           p.nomPersonalDireccion
                    FROM tblsolicitudpractica s
                    LEFT JOIN tblpersonaldireccion p ON s.idPersonalDireccion = p.idPersonalDireccion
                    WHERE s.idSolicitudPractica = :id";
            $stmt = $conex->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        } catch (\PDOException $e) {
            error_log("Error en SolicitudesModel::getById: " . $e->getMessage());
            return false;
        }
    }
}