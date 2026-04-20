<?php
declare(strict_types=1);

require_once __DIR__ . '/species-data.php';

$species = bee_find_species('boca-de-sapo');

if ($species === null) {
    http_response_code(404);
    exit('Especie nao encontrada.');
}

require __DIR__ . '/template.php';