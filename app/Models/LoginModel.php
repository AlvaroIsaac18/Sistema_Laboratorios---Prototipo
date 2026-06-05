<?php

namespace App\Laboratorios\Models;

use App\Laboratorios\Config\Connect\ConnectDB;
use PDO;

class LoginModel extends ConnectDB {
    public function login($cedula, $correo) {
        try {
            $conex = $this->getConnection();

            
            $sql = "SELECT `idTecnico` AS `id`, `cedulaTecnico` AS `cedula`,
                           `nomTecnico` AS `nombre_completo`,
                           `correoInstitucionalTecnico` AS `correo`, 'Tecnico' AS `rol`
                    FROM `tbltecnico`
                    WHERE `cedulaTecnico` = :cedula AND `correoInstitucionalTecnico` = :correo AND `activo` = 1";

            $stmt = $conex->prepare($sql);
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

            $stmt = $conex->prepare($sql);
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
