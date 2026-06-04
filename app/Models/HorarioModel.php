<?php

namespace App\Models;

use App\PracticaCrud\Config\Connect\ConnectDB;

class HorarioModel extends ConnectDB {

    private $conex;
    private $idAnomalia;

    public function __construct() {
        parent::__construct();
        $this->conex = $this->getConnection();
    }

    // Obtener cronograma semanal (reservas + laboratorio + docente + sección + tipo práctica)
    public function getCronogramaSemanal() {
        $consult = $this->conex->prepare("
            SELECT 
                r.idReserva,
                r.horaInicioReserva,
                r.horaFinReserva,
                r.fechaReserva,
                r.turnoReserva,
                r.estadoReserva,
                r.observacionReserva,
                r.descripReserva,
                l.nomLaboratorio,
                l.ubicacionLaboratorio,
                d.nomDocente,
                d.apellidoDocente,
                s.cantidadSeccion,
                s.trayectoSeccion,
                tp.nombreTipoPractica,
                tp.tipoPractica
            FROM tblreserva r
            INNER JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            INNER JOIN tblsolicitudpractica sp ON r.idSolicitudPractica = sp.idSolicitudPractica
            INNER JOIN tbldocente d ON d.idSolicitudPractica = sp.idSolicitudPractica
            INNER JOIN tblunidadcurricularsecciondocente usd ON usd.idDocente = d.idDocente
            INNER JOIN tblseccion s ON usd.idSeccion = s.idSeccion
            INNER JOIN tbltipopractica tp ON r.idTipoPractica = tp.idTipoPractica
            WHERE r.estadoReserva != 'Cancelada'
            ORDER BY r.fechaReserva, r.horaInicioReserva
        ");
        $consult->execute();
        return $consult->fetchAll();
    }

    // Obtener cronograma mensual
    public function getCronogramaMensual() {
        $consult = $this->conex->prepare("
            SELECT 
                r.idReserva,
                r.horaInicioReserva,
                r.horaFinReserva,
                r.fechaReserva,
                r.estadoReserva,
                r.turnoReserva,
                l.nomLaboratorio,
                d.nomDocente,
                d.apellidoDocente,
                tp.nombreTipoPractica
            FROM tblreserva r
            INNER JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            INNER JOIN tblsolicitudpractica sp ON r.idSolicitudPractica = sp.idSolicitudPractica
            INNER JOIN tbldocente d ON d.idSolicitudPractica = sp.idSolicitudPractica
            INNER JOIN tbltipopractica tp ON r.idTipoPractica = tp.idTipoPractica
            WHERE r.estadoReserva != 'Cancelada'
            ORDER BY r.fechaReserva, r.horaInicioReserva
        ");
        $consult->execute();
        return $consult->fetchAll();
    }

    // Obtener conflictos (anomalías activas)
    public function getConflictos() {
        $consult = $this->conex->prepare("
            SELECT 
                a.idAnomalia,
                a.descripAnomalia,
                a.fechaDecteAnomalia,
                a.estadoAnomalia,
                a.tipoAnomalia,
                r.horaInicioReserva,
                r.horaFinReserva,
                r.fechaReserva,
                l.nomLaboratorio,
                t.nomTecnico
            FROM tblanomalia a
            INNER JOIN tblreserva r ON a.idReserva = r.idReserva
            INNER JOIN tbllaboratorio l ON r.idLaboratorio = l.idLaboratorio
            INNER JOIN tbltecnico t ON a.idTecnico = t.idTecnico
            WHERE a.estadoAnomalia != 'Resuelta'
            ORDER BY a.fechaDecteAnomalia DESC
        ");
        $consult->execute();
        return $consult->fetchAll();
    }

    // Resolver un conflicto (anomalía)
    public function resolverConflicto(int $idAnomalia) {
        $this->idAnomalia = $idAnomalia;
        return $this->marcarConflictoResuelto();
    }

    private function marcarConflictoResuelto() {
        try {
            $query = "UPDATE tblanomalia SET estadoAnomalia = 'Resuelta', fechaResoAnomalia = CURDATE() WHERE idAnomalia = ?";
            $stmt = $this->conex->prepare($query);
            $stmt->bindValue(1, $this->idAnomalia);
            $stmt->execute();
            return "Conflicto resuelto exitosamente";
        } catch (\PDOException $e) {
            return "Error al resolver el conflicto: " . $e->getMessage();
        }
    }
}

?>