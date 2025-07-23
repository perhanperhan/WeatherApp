<?php

$config = require_once 'config.php';
require_once 'helpers.php';
require_once 'endpoints.php';

authorizeBearer($config['valid_bearer_token']);

$dataSourceUrl = $config['data_source_url'];
$uri = getUri();
$endpoint = $uri[0];

if ($endpoint === "get-all-stations") {
    getAllStations($dataSourceUrl);
} elseif ($endpoint === "get-station-by-id") {
    $stationId = (string)($_POST['station_id'] ?? '');
    getStationById($dataSourceUrl, $stationId);
} else {
    outputResult(["error" => "Endpoint not found"], 404);
}
