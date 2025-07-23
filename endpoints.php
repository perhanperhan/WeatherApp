<?php

require_once 'helpers.php';

function readCsv(string $csvUrl): array
{
    $result = [];
    if (($handle = fopen($csvUrl, "r")) !== false) {
        $headers = fgetcsv($handle);

        // remove BOM
        if (substr($headers[0], 0, 3) === "\xEF\xBB\xBF") {
            $headers[0] = substr($headers[0], 3);
        }

        while (($row = fgetcsv($handle)) !== false) {
            $assocRow = array_combine($headers, $row);
            $result[] = $assocRow;
        }

        fclose($handle);
    } else {
        outputResult(["error" => "Internal Server Error"], 500);
    }

    return $result;
}

function getAllStations(string $csvUrl): void
{
    $data = readCsv($csvUrl);

    $result = array_map(function($row) {
        return [
            'station_id' => $row['STATION_ID'],
            'name' => $row['NAME'],
        ];
    }, $data);

    outputResult($result);
}

function getStationById(string $csvUrl, string $stationId): void
{
    $data = readCsv($csvUrl);

    foreach ($data as $station) {
        if ($station['STATION_ID'] === $stationId) {
            outputResult($station);
            return;
        }
    }

    outputResult(['error' => 'Station not found'], 404);
}