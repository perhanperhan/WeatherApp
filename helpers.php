<?php

function authorizeBearer(string $validBearerToken): void
{
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    $token = str_replace("Bearer ", "", $authHeader);

    if ($token !== $validBearerToken) {
        outputResult(['error' => 'Unauthorized'], 401);
    }
}

function getUri(): array
{
    return explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
}

function outputResult(array $result, int $responseCode = null): void
{
    if ($responseCode) {
        http_response_code($responseCode);
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}



