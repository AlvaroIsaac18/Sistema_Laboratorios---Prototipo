<?php
namespace App\Models;

class ProtocolosModel
{
    private string $filePath;

    public function __construct()
    {
        $this->filePath = __DIR__ . '/../data/protocolos.json';
    }

    public function getAll(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $data = json_decode(file_get_contents($this->filePath), true);
        return is_array($data) ? $data : [];
    }

    public function getActiveCards(): array
    {
        $all = $this->getAll();
        return array_values(array_filter($all, fn($p) => ($p['tipo'] ?? '') === 'card' && ($p['activo'] ?? true)));
    }

    public function getActiveDownloads(): array
    {
        $all = $this->getAll();
        return array_values(array_filter($all, fn($p) => ($p['tipo'] ?? '') === 'download' && ($p['activo'] ?? true)));
    }
}
