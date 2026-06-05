<?php
namespace App\Laboratorios\Models;

use App\Laboratorios\Config\Connect\ConnectDB;
use PDO;

class ReservasModel extends ConnectDB
{
    public function getAll()
    {
        $conex = $this->getConnection();
        $stmt = $conex->query("
            SELECT r.*, l.nomLaboratorio,
                   (SELECT CONCAT(nomDocente, ' ', apellidoDocente)
                    FROM tbldocente
                    WHERE idSolicitudPractica = r.idSolicitudPractica
                    LIMIT 1) AS nombreDocente
            FROM tblreserva r
            LEFT JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            ORDER BY r.fechaReserva DESC, r.horaInicioReserva
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $conex = $this->getConnection();
        $stmt = $conex->prepare("
            SELECT r.*, l.nomLaboratorio
            FROM tblreserva r
            LEFT JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            WHERE r.idReserva = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $conex = $this->getConnection();
        $stmt = $conex->prepare("
            INSERT INTO tblreserva
                (objetivoReserva, horaInicioReserva, horaFinReserva, nombreReserva,
                 fechaReserva, descripReserva, turnoReserva, estadoReserva,
                 observacionReserva, idLaboratorio, idSolicitudPractica, idTipoPractica)
            VALUES
                (:objetivo, :horaInicio, :horaFin, :nombre,
                 :fecha, :descrip, :turno, :estado,
                 :observacion, :idLaboratorio, :idSolicitud, :idTipo)
        ");
        $stmt->execute([
            ':objetivo'      => $data['objetivoReserva'] ?? '',
            ':horaInicio'    => $data['horaInicioReserva'],
            ':horaFin'       => $data['horaFinReserva'],
            ':nombre'        => $data['nombreReserva'],
            ':fecha'         => $data['fechaReserva'],
            ':descrip'       => $data['descripReserva'] ?? '',
            ':turno'         => $data['turnoReserva'] ?? '',
            ':estado'        => $data['estadoReserva'] ?? 'activa',
            ':observacion'   => $data['observacionReserva'] ?? '',
            ':idLaboratorio' => (int) ($data['idLaboratorio'] ?? 0),
            ':idSolicitud'   => (int) ($data['idSolicitudPractica'] ?? 0),
            ':idTipo'        => (int) ($data['idTipoPractica'] ?? 0),
        ]);
        return $conex->lastInsertId();
    }

    public function update($id, $data)
    {
        $conex = $this->getConnection();
        $stmt = $conex->prepare("
            UPDATE tblreserva SET
                objetivoReserva     = :objetivo,
                horaInicioReserva   = :horaInicio,
                horaFinReserva      = :horaFin,
                nombreReserva       = :nombre,
                fechaReserva        = :fecha,
                descripReserva      = :descrip,
                turnoReserva        = :turno,
                estadoReserva       = :estado,
                observacionReserva  = :observacion,
                idLaboratorio       = :idLaboratorio,
                idSolicitudPractica = :idSolicitud,
                idTipoPractica      = :idTipo
            WHERE idReserva = :id
        ");
        $stmt->execute([
            ':objetivo'      => $data['objetivoReserva'] ?? '',
            ':horaInicio'    => $data['horaInicioReserva'],
            ':horaFin'       => $data['horaFinReserva'],
            ':nombre'        => $data['nombreReserva'],
            ':fecha'         => $data['fechaReserva'],
            ':descrip'       => $data['descripReserva'] ?? '',
            ':turno'         => $data['turnoReserva'] ?? '',
            ':estado'        => $data['estadoReserva'],
            ':observacion'   => $data['observacionReserva'] ?? '',
            ':idLaboratorio' => (int) ($data['idLaboratorio'] ?? 0),
            ':idSolicitud'   => (int) ($data['idSolicitudPractica'] ?? 0),
            ':idTipo'        => (int) ($data['idTipoPractica'] ?? 0),
            ':id'            => (int) $id,
        ]);
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $conex = $this->getConnection();
        $stmt = $conex->prepare("DELETE FROM tblreserva WHERE idReserva = :id");
        $stmt->execute([':id' => (int) $id]);
        return $stmt->rowCount();
    }

    public function getProximas(int $dias = 15): array
    {
        $conex = $this->getConnection();
        $stmt = $conex->prepare("
            SELECT r.*, l.nomLaboratorio,
                   (SELECT CONCAT(nomDocente, ' ', apellidoDocente)
                    FROM tbldocente
                    WHERE idSolicitudPractica = r.idSolicitudPractica
                    LIMIT 1) AS nombreDocente
            FROM tblreserva r
            LEFT JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            WHERE STR_TO_DATE(r.fechaReserva, '%Y-%m-%d') BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL :dias DAY)
            ORDER BY r.fechaReserva ASC, r.horaInicioReserva ASC
        ");
        $stmt->bindValue(':dias', $dias, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHoyCount(): int
    {
        $conex = $this->getConnection();
        $stmt = $conex->query("SELECT COUNT(*) FROM tblreserva WHERE fechaReserva = CURDATE()");
        return (int) $stmt->fetchColumn();
    }
}
