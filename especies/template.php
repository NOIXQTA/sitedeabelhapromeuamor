<?php
declare(strict_types=1);

if (!isset($species) || !is_array($species)) {
    http_response_code(500);
    exit('Especie nao configurada.');
}

$pageTitle = $species['common_name'] . ' | Guia das Abelhas';
$imagePath = bee_encode_path('imagens', $species['slug'], $species['image']);
$wikipediaUrl = bee_wikipedia_url($species);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="species-page">
        <header class="species-header">
            <a class="species-header__brand" href="../principal/index.php">
                <span class="species-header__dot"></span>
                <strong>Guia das Abelhas</strong>
            </a>
            <nav class="species-header__nav">
                <a href="../principal/index.php#especies">Colecao</a>
                <a href="../principal/index.php#contato">Contato</a>
            </nav>
        </header>

        <a class="back-link" href="../principal/index.php">Voltar para a pagina principal</a>

        <section class="species-hero">
            <div class="species-hero__copy">
                <p class="eyebrow">Especie em destaque</p>
                <h1><?= htmlspecialchars($species['common_name'], ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="scientific-name"><?= htmlspecialchars($species['scientific_name'], ENT_QUOTES, 'UTF-8') ?></p>
                <p class="hero-text"><?= htmlspecialchars($species['intro'], ENT_QUOTES, 'UTF-8') ?></p>

                <div class="species-hero__actions">
                    <a class="species-action species-action--site" href="../principal/index.php#especies">Ver outras especies</a>
                    <a class="species-action species-action--wiki" href="<?= htmlspecialchars($wikipediaUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Abrir na Wikipedia</a>
                </div>

                <div class="species-facts">
                    <article class="fact-tile">
                        <span>Tipo</span>
                        <strong><?= htmlspecialchars($species['category'], ENT_QUOTES, 'UTF-8') ?></strong>
                    </article>
                    <article class="fact-tile">
                        <span>Distribuicao</span>
                        <strong><?= htmlspecialchars($species['distribution'], ENT_QUOTES, 'UTF-8') ?></strong>
                    </article>
                    <article class="fact-tile">
                        <span>Papel</span>
                        <strong><?= htmlspecialchars($species['role'], ENT_QUOTES, 'UTF-8') ?></strong>
                    </article>
                </div>
            </div>

            <div class="species-hero__media">
                <img src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($species['common_name'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
        </section>

        <section class="info-grid">
            <article class="info-card">
                <p class="card-label">Visao geral</p>
                <h2><?= htmlspecialchars($species['overview_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($species['overview'], ENT_QUOTES, 'UTF-8') ?></p>
            </article>

            <article class="info-card">
                <p class="card-label">Curiosidade</p>
                <h2><?= htmlspecialchars($species['curiosity_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($species['curiosity'], ENT_QUOTES, 'UTF-8') ?></p>
            </article>

            <article class="info-card info-card--wide">
                <p class="card-label">Imagem e cuidado</p>
                <h2><?= htmlspecialchars($species['care_title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($species['care'], ENT_QUOTES, 'UTF-8') ?></p>
                <img src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>" alt="Imagem de <?= htmlspecialchars($species['common_name'], ENT_QUOTES, 'UTF-8') ?>">
            </article>
        </section>
    </main>
</body>
</html>
