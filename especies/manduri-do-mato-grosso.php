<?php
declare(strict_types=1);

require_once __DIR__ . '/species-data.php';

$species = bee_find_species('manduri-do-mato-grosso');

if ($species === null) {
    http_response_code(404);
    exit('Especie nao encontrada.');
}

require __DIR__ . '/template.php';