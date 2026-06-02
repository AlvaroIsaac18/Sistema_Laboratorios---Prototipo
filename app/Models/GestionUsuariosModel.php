<?php

namespace App\Models;

use App\config\database\DbConnect;
use PDO;

class GestionUsuariosModel extends DbConnect {
    public function getAll() {
        try {
            $this->connect();

            $sql = "
                SELECT 
                    `idDocente` AS `id`,
                    `cedulaDocente` AS `cedula`,
                    CONCAT(`nomDocente`, ' ', `apellidoDocente`) AS `nombre_completo`,
                    LOWER(CONCAT(SUBSTRING(`nomDocente`, 1, 1), `apellidoDocente`)) AS `usuario`,
                    `correoInstitucionalDocente` AS `correo`,
                    'Docente' AS `rol`,
                    'Dpto. Académico' AS `departamento`
                FROM `tbldocente`
                WHERE `activo` = 1
                
                UNION ALL
                
                SELECT 
                    `idTecnico` AS `id`,
                    `cedulaTecnico` AS `cedula`,
                    `nomTecnico` AS `nombre_completo`,
                    LOWER(REPLACE(`nomTecnico`, ' ', '')) AS `usuario`,
                    CONCAT(LOWER(REPLACE(`nomTecnico`, ' ', '')), '@uptaeb.edu.ve') AS `correo`,
                    'Auxiliar' AS `rol`,
                    `direccionTecnico` AS `departamento`
                FROM `tbltecnico`
                WHERE `activo` = 1
                
                UNION ALL
                
                SELECT 
                    `idPersonalDireccion` AS `id`,
                    `cedulaPersonalDireccion` AS `cedula`,
                    `nomPersonalDireccion` AS `nombre_completo`,
                    LOWER(REPLACE(`nomPersonalDireccion`, ' ', '')) AS `usuario`,
                    CONCAT(LOWER(REPLACE(`nomPersonalDireccion`, ' ', '')), '@uptaeb.edu.ve') AS `correo`,
                    'Administrador' AS `rol`,
                    `cargoPersonalDireccion` AS `departamento`
                FROM `tblpersonaldireccion`
                WHERE `activo` = 1
                
                ORDER BY `nombre_completo` ASC
            ";

            $response = $this->con->prepare($sql);
            $response->execute();

            return $response->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            die("Error crítico en GestionUsuariosModel::getAll: " . $e->getMessage());
        }
    }

    public function create($data) {
        try {
            $this->connect();
            $rol = $data['rol'];

            if ($rol === 'Docente') {
                $sql = "INSERT INTO `tbldocente` (`cedulaDocente`, `nomDocente`, `apellidoDocente`, `correoInstitucionalDocente`, `idSolicitudPractica`) 
                        VALUES (:cedula, :nombre, :apellido, :correo, 1)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':apellido', $data['apellido']);
                $stmt->bindValue(':correo', $data['correo']);
            } elseif ($rol === 'Auxiliar') {
                $sql = "INSERT INTO `tbltecnico` (`cedulaTecnico`, `nomTecnico`, `direccionTecnico`) 
                        VALUES (:cedula, :nombre, :direccion)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':direccion', $data['direccion'] ?? '');
            } else {
                $sql = "INSERT INTO `tblpersonaldireccion` (`cedulaPersonalDireccion`, `nomPersonalDireccion`, `cargoPersonalDireccion`) 
                        VALUES (:cedula, :nombre, :cargo)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':cargo', $data['cargo'] ?? '');
            }

            return $stmt->execute();
        } catch(\PDOException $e) {
            die("Error al crear usuario: " . $e->getMessage());
        }
    }

    public function update($id, $rol, $data) {
        try {
            $this->connect();

            if ($rol === 'Docente') {
                $sql = "UPDATE `tbldocente` SET 
                            `cedulaDocente` = :cedula,
                            `nomDocente` = :nombre,
                            `apellidoDocente` = :apellido,
                            `correoInstitucionalDocente` = :correo
                        WHERE `idDocente` = :id";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':apellido', $data['apellido']);
                $stmt->bindValue(':correo', $data['correo']);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            } elseif ($rol === 'Auxiliar') {
                $sql = "UPDATE `tbltecnico` SET 
                            `cedulaTecnico` = :cedula,
                            `nomTecnico` = :nombre,
                            `direccionTecnico` = :direccion
                        WHERE `idTecnico` = :id";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':direccion', $data['direccion'] ?? '');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            } else {
                $sql = "UPDATE `tblpersonaldireccion` SET 
                            `cedulaPersonalDireccion` = :cedula,
                            `nomPersonalDireccion` = :nombre,
                            `cargoPersonalDireccion` = :cargo
                        WHERE `idPersonalDireccion` = :id";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':cedula', $data['cedula']);
                $stmt->bindValue(':nombre', $data['nombre']);
                $stmt->bindValue(':cargo', $data['cargo'] ?? '');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            }

            return $stmt->execute();
        } catch(\PDOException $e) {
            die("Error al actualizar usuario: " . $e->getMessage());
        }
    }

    public function softDelete($id, $rol) {
        try {
            $this->connect();

            if ($rol === 'Docente') {
                $sql = "UPDATE `tbldocente` SET `activo` = 0 WHERE `idDocente` = :id";
            } elseif ($rol === 'Auxiliar') {
                $sql = "UPDATE `tbltecnico` SET `activo` = 0 WHERE `idTecnico` = :id";
            } else {
                $sql = "UPDATE `tblpersonaldireccion` SET `activo` = 0 WHERE `idPersonalDireccion` = :id";
            }

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch(\PDOException $e) {
            die("Error al desactivar usuario: " . $e->getMessage());
        }
    }

    public function getById($id, $rol) {
        try {
            $this->connect();

            if ($rol === 'Docente') {
                $sql = "SELECT `idDocente` AS `id`, `cedulaDocente` AS `cedula`, `nomDocente` AS `nombre`, `apellidoDocente` AS `apellido`, `correoInstitucionalDocente` AS `correo`, 'Docente' AS `rol`
                        FROM `tbldocente` WHERE `idDocente` = :id";
            } elseif ($rol === 'Auxiliar') {
                $sql = "SELECT `idTecnico` AS `id`, `cedulaTecnico` AS `cedula`, `nomTecnico` AS `nombre`, '' AS `apellido`, '' AS `correo`, 'Auxiliar' AS `rol`, `direccionTecnico` AS `direccion`
                        FROM `tbltecnico` WHERE `idTecnico` = :id";
            } else {
                $sql = "SELECT `idPersonalDireccion` AS `id`, `cedulaPersonalDireccion` AS `cedula`, `nomPersonalDireccion` AS `nombre`, '' AS `apellido`, '' AS `correo`, 'Administrador' AS `rol`, `cargoPersonalDireccion` AS `cargo`
                        FROM `tblpersonaldireccion` WHERE `idPersonalDireccion` = :id";
            }

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            die("Error al obtener usuario: " . $e->getMessage());
        }
    }
}
