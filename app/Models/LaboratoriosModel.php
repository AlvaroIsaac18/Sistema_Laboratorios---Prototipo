<?php
namespace App\Models;

use App\config\database\DbConnect;
use PDO;

class LaboratoriosModel extends DbConnect
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->con->query("SELECT * FROM tbllaboratorio ORDER BY nomLaboratorio");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResumen()
    {
        $this->connect();
        $stmt = $this->con->query("
            SELECT
                SUM(CASE WHEN estadoLaboratorio = 'disponible' THEN 1 ELSE 0 END) AS disponible,
                SUM(CASE WHEN estadoLaboratorio = 'en_uso' THEN 1 ELSE 0 END) AS en_uso,
                SUM(CASE WHEN estadoLaboratorio = 'mantenimiento' THEN 1 ELSE 0 END) AS mantenimiento
            FROM tbllaboratorio
        ");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'disponible' => (int) ($row['disponible'] ?? 0),
            'en_uso' => (int) ($row['en_uso'] ?? 0),
            'mantenimiento' => (int) ($row['mantenimiento'] ?? 0),
        ];
    }

    public function getById($id)
    {
        $this->connect();
        $stmt = $this->con->prepare("SELECT * FROM tbllaboratorio WHERE idLaboratorio = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
