<?php

namespace App\Models;

use App\config\database\DbConnect;
use PDO;

class InsumosModel extends DbConnect {
    public function getAll() {
        try {
            $this->connect();
            $sql = "SELECT * FROM `tblinsumos` ORDER BY `nomInsumos` ASC";
            $response = $this->con->prepare($sql);
            $response->execute();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error en InsumosModel::getAll: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $this->connect();
            $sql = "SELECT * FROM `tblinsumos` WHERE `idInsumos` = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Error en InsumosModel::getById: " . $e->getMessage());
        }
    }

    public function create($data) {
        try {
            $this->connect();
            $sql = "INSERT INTO `tblinsumos` 
                    (`nomInsumos`, `descripInsumos`, `categoriaInsumos`, `cantidadStock`, `cantidadDispInsumos`, `cantidadMinInsumos`, `unidadMedidaInsumos`) 
                    VALUES 
                    (:nombre, :descripcion, :categoria, :stock, :disponible, :stockMin, :unidad)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':nombre', $data['nomInsumos']);
            $stmt->bindValue(':descripcion', $data['descripInsumos'] ?? '');
            $stmt->bindValue(':categoria', $data['categoriaInsumos'] ?? '');
            $stmt->bindValue(':stock', $data['cantidadStock'] ?? '0');
            $stmt->bindValue(':disponible', $data['cantidadDispInsumos'] ?? $data['cantidadStock'] ?? '0');
            $stmt->bindValue(':stockMin', $data['cantidadMinInsumos'] ?? '0');
            $stmt->bindValue(':unidad', $data['unidadMedidaInsumos'] ?? '');
            return $stmt->execute();
        } catch (\PDOException $e) {
            die("Error en InsumosModel::create: " . $e->getMessage());
        }
    }

    public function update($id, $data) {
        try {
            $this->connect();
            $sql = "UPDATE `tblinsumos` SET 
                        `nomInsumos` = :nombre,
                        `descripInsumos` = :descripcion,
                        `categoriaInsumos` = :categoria,
                        `cantidadStock` = :stock,
                        `cantidadDispInsumos` = :disponible,
                        `cantidadMinInsumos` = :stockMin,
                        `unidadMedidaInsumos` = :unidad
                    WHERE `idInsumos` = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':nombre', $data['nomInsumos']);
            $stmt->bindValue(':descripcion', $data['descripInsumos'] ?? '');
            $stmt->bindValue(':categoria', $data['categoriaInsumos'] ?? '');
            $stmt->bindValue(':stock', $data['cantidadStock'] ?? '0');
            $stmt->bindValue(':disponible', $data['cantidadDispInsumos'] ?? '0');
            $stmt->bindValue(':stockMin', $data['cantidadMinInsumos'] ?? '0');
            $stmt->bindValue(':unidad', $data['unidadMedidaInsumos'] ?? '');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            die("Error en InsumosModel::update: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->connect();
            $sql = "DELETE FROM `tblinsumos` WHERE `idInsumos` = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            die("Error en InsumosModel::delete: " . $e->getMessage());
        }
    }
}
