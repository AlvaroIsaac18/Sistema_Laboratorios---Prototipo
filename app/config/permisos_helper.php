<?php
function getPermisos($rol) {
    $base = require 'app/config/permissions.php';
    $overridePath = 'app/config/permissions_override.json';
    $override = [];
    if (file_exists($overridePath)) {
        $override = json_decode(file_get_contents($overridePath), true) ?? [];
    }
    return $override[$rol] ?? $base[$rol] ?? [];
}
