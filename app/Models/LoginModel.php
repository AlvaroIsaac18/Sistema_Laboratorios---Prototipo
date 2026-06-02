<?php

namespace App\Models;

use App\config\database\DbConnect;
use PDO;

class LoginModel extends DbConnect {
    public function login($cedula, $correo) {
        try {
            $this->connect();

            $sql = "SELECT `idDocente` AS `id`, `cedulaDocente` AS `cedula`,
                           CONCAT(`nomDocente`, ' ', `apellidoDocente`) AS `nombre_completo`,
                           `correoInstitucionalDocente` AS `correo`, 'Docente' AS `rol`
                    FROM `tbldocente`
                    WHERE `cedulaDocente` = :cedula AND `correoInstitucionalDocente` = :correo AND `activo` = 1";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) return $user;

            $sql = "SELECT `idPersonalDireccion` AS `id`, `cedulaPersonalDireccion` AS `cedula`,
                           `nomPersonalDireccion` AS `nombre_completo`,
                           `correoInstitucionalPersonalDireccion` AS `correo`, 'Administrador' AS `rol`
                    FROM `tblpersonaldireccion`
                    WHERE `cedulaPersonalDireccion` = :cedula AND `correoInstitucionalPersonalDireccion` = :correo AND `activo` = 1";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) return $user;

            return false;
        } catch (\PDOException $e) {
            die("Error crítico en la autenticación: " . $e->getMessage());
        }
    }
}
