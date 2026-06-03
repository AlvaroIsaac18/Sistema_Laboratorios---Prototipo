<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\config\database\DbConnect;

class SeedDb extends DbConnect
{
    public function run()
    {
        $this->connect();

        $this->con->exec("SET FOREIGN_KEY_CHECKS = 0");
        $this->con->exec("TRUNCATE TABLE tblanomalia");
        $this->con->exec("TRUNCATE TABLE tblreserva");
        $this->con->exec("TRUNCATE TABLE tbllaboratorio");
        $this->con->exec("SET FOREIGN_KEY_CHECKS = 1");

        $labs = [
            ['Laboratorio de Quimica General', 'lab_quimica', 25, 'en_uso', 'Edif. A, Planta Baja'],
            ['Laboratorio de Biologia', 'lab_biologia', 20, 'disponible', 'Edif. B, Piso 2'],
            ['Laboratorio de Seguridad Industrial', 'lab_seguridad', 15, 'mantenimiento', 'Edif. C, Sótano'],
            ['Laboratorio de Fisica Experimental', 'lab_fisica', 30, 'disponible', 'Edif. A, Piso 1'],
            ['Laboratorio de Computo', 'lab_computo', 35, 'en_uso', 'Edif. B, Planta Baja'],
        ];

        $stmtLab = $this->con->prepare(
            "INSERT INTO tbllaboratorio (nomLaboratorio, tipoLaboratorio, capacidadLaboratorio, estadoLaboratorio, ubicacionLaboratorio)
             VALUES (:nom, :tipo, :cap, :est, :ubi)"
        );

        $labIds = [];
        foreach ($labs as $l) {
            $stmtLab->execute([
                ':nom' => $l[0],
                ':tipo' => $l[1],
                ':cap' => $l[2],
                ':est' => $l[3],
                ':ubi' => $l[4],
            ]);
            $labIds[] = $this->con->lastInsertId();
        }

        $reservas = [
            [$labIds[0], 'Practica de titulacion acido-base', '08:00:00', '10:00:00', 'Quimica General', '2026-06-03', 'Grupo A - Titulaciones', 'matutino', 'activa', 'Todo en orden'],
            [$labIds[0], 'Practica de reacciones redox', '10:00:00', '12:00:00', 'Quimica Avanzada', '2026-06-04', 'Grupo B - Redox', 'matutino', 'activa', 'Equipo listo'],
            [$labIds[4], 'Programacion en Python', '14:00:00', '16:00:00', 'Computo I', '2026-06-03', 'Algoritmos basicos', 'vespertino', 'activa', '30 PCs disponibles'],
            [$labIds[1], 'Observacion de celulas', '09:00:00', '11:00:00', 'Biologia Celular', '2026-06-05', 'Practica de microscopia', 'matutino', 'confirmada', 'Microscopios listos'],
        ];

        $stmtRes = $this->con->prepare(
            "INSERT INTO tblreserva (idLaboratorio, objetivoReserva, horaInicioReserva, horaFinReserva, nombreReserva, fechaReserva, descripReserva, turnoReserva, estadoReserva, observacionReserva, idSolicitudPractica, idTipoPractica)
             VALUES (:idLab, :objetivo, :hInicio, :hFin, :nombre, :fecha, :descrip, :turno, :estado, :observ, 1, 1)"
        );

        $reservaIds = [];
        foreach ($reservas as $r) {
            $stmtRes->execute([
                ':idLab' => $r[0],
                ':objetivo' => $r[1],
                ':hInicio' => $r[2],
                ':hFin' => $r[3],
                ':nombre' => $r[4],
                ':fecha' => $r[5],
                ':descrip' => $r[6],
                ':turno' => $r[7],
                ':estado' => $r[8],
                ':observ' => $r[9],
            ]);
            $reservaIds[] = $this->con->lastInsertId();
        }

        $anomalias = [
            [$reservaIds[0], 'Ventilacion deficiente, temperatura elevada', 'infraestructura', '2026-06-02', 'pendiente'],
            [$reservaIds[2], 'Equipo de proyeccion no enciende', 'equipo', '2026-06-01', 'en_progreso'],
        ];

        $stmtAno = $this->con->prepare(
            "INSERT INTO tblanomalia (idReserva, idTecnico, descripAnomalia, tipoAnomalia, fechaDecteAnomalia, estadoAnomalia, fechaResoAnomalia, idPractica)
             VALUES (:idRes, 1, :desc, :tipo, :fecha, :estado, :fecha, 1)"
        );

        foreach ($anomalias as $a) {
            $stmtAno->execute([
                ':idRes' => $a[0],
                ':desc' => $a[1],
                ':tipo' => $a[2],
                ':fecha' => $a[3],
                ':estado' => $a[4],
            ]);
        }

        echo "Seed completado.\n";
    }
}

$seed = new SeedDb();
$seed->run();
