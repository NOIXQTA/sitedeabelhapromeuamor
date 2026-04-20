<?php
declare(strict_types=1);

require_once __DIR__ . '/../especies/species-data.php';

$status = $_GET['status'] ?? '';
$mensagemStatus = match ($status) {
    'sucesso' => ['tipo' => 'sucesso', 'texto' => 'Mensagem enviada com sucesso.'],
    'erro' => ['tipo' => 'erro', 'texto' => 'Preencha todos os campos do formulario.'],
    'email-invalido' => ['tipo' => 'erro', 'texto' => 'Digite um email valido para continuar.'],
    'falha' => ['tipo' => 'erro', 'texto' => 'Nao foi possivel salvar sua mensagem agora.'],
    'email-nao-enviado' => ['tipo' => 'erro', 'texto' => 'A mensagem foi salva, mas o email nao foi enviado. Verifique a configuracao SMTP do XAMPP.'],
    default => null,
};
$speciesList = bee_species_data();
$speciesCount = count($speciesList);
$heroSlides = [];
$speciesCategories = [];

foreach ($speciesList as $species) {
    $heroSlides[] = [
        'src' => '../' . bee_encode_path('especies', 'imagens', $species['slug'], $species['image']),
        'alt' => $species['common_name'],
        'label' => $species['common_name'],
        'scientific' => $species['scientific_name'],
    ];

    if (count($heroSlides) === 8) {
        break;
    }
}

foreach ($speciesList as $species) {
    $speciesCategories[$species['category']] = true;
}

$speciesCategories = array_keys($speciesCategories);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia das Abelhas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imagens/icone2.jpg" type="image/jpeg">
</head>
<body>
    <div class="page-shell">
        <header class="site-header">
            <a class="site-header__brand" href="index.php">
                <img src="imagens/icone2.jpg" alt="Icone do Guia das Abelhas">
                <div>
                    <strong>Guia das Abelhas</strong>
                    <span>atlas visual brasileiro</span>
                </div>
            </a>
            <nav class="site-header__nav">
                <a href="#galeria">Galeria</a>
                <a href="#especies">Especies</a>
                <a href="#contato">Contato</a>
            </nav>
        </header>

        <header class="hero">
            <div class="hero__media">
                <img
                    id="heroRotatingImage"
                    src="<?= htmlspecialchars($heroSlides[0]['src'] ?? 'imagens/abelhadescricao.jpg', ENT_QUOTES, 'UTF-8') ?>"
                    alt="<?= htmlspecialchars($heroSlides[0]['alt'] ?? 'Abelha em destaque', ENT_QUOTES, 'UTF-8') ?>"
                >
                <div class="hero__media-badge">
                    <p class="hero__media-label" id="heroRotatingLabel"><?= htmlspecialchars($heroSlides[0]['label'] ?? 'Atlas visual', ENT_QUOTES, 'UTF-8') ?></p>
                    <strong id="heroRotatingScientific"><?= htmlspecialchars($heroSlides[0]['scientific'] ?? 'Guia das Abelhas', ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
            </div>
            <div class="hero__panel">
                <div class="hero__panel-copy">
                    <p class="eyebrow">Atlas visual</p>
                    <h1>Abelhas, polinizacao e um visual que ocupa a tela inteira</h1>
                    <p class="hero__text">
                        Um guia mais dinamico para explorar especies, imagens, curiosidades e a
                        importancia das abelhas para a natureza e para a agricultura.
                    </p>
                </div>
                <div class="hero__mini-gallery">
                    <img src="imagens/apilcutor.jpg" alt="Apicultor trabalhando com abelhas">
                    <img src="imagens/abelhadescricao.jpg" alt="Detalhe ilustrativo de abelha">
                </div>
                <div class="hero__actions">
                    <a class="button button--primary" href="#especies">Explorar especies</a>
                    <a class="button button--ghost" href="#galeria">Ver galeria</a>
                </div>
                <div class="hero__facts">
                    <div class="fact-card">
                        <strong><?= $speciesCount ?> especies</strong>
                        <span>paginas organizadas</span>
                    </div>
                    <div class="fact-card">
                        <strong>Galeria viva</strong>
                        <span>mais imagens e destaque visual</span>
                    </div>
                    <div class="fact-card">
                        <strong>Formulario ativo</strong>
                        <span>contato pronto em PHP</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="banner-strip">
            <div class="banner-strip__track">
                <span>Polinizacao</span>
                <span>Meliponicultura</span>
                <span>Biodiversidade</span>
                <span>Abelhas nativas</span>
                <span>Conservacao</span>
                <span>Polinizacao</span>
                <span>Meliponicultura</span>
                <span>Biodiversidade</span>
                <span>Abelhas nativas</span>
                <span>Conservacao</span>
            </div>
        </section>

        <main class="content">
            <section class="overview">
                <article class="overview__intro glass-card">
                    <div class="overview__intro-copy">
                        <p class="section-label">Sobre o projeto</p>
                        <h2>Mais tela, mais imagem e mais ritmo visual</h2>
                        <p>
                            Este projeto foi criado para aproximar as pessoas do universo das
                            abelhas de um jeito mais bonito, simples e interessante. Aqui voce
                            encontra especies conhecidas, curiosidades e imagens que ajudam a
                            entender melhor o papel desses insetos na natureza.
                        </p>
                        <p>
                            Mais do que um catalogo visual, este site funciona como um convite
                            para observar, aprender e valorizar as abelhas brasileiras, mostrando
                            como cada especie tem seu proprio encanto e sua importancia para os
                            ecossistemas.
                        </p>
                    </div>
                    <div class="overview__intro-media">
                        <img src="imagens/favo.jpg" alt="Favo de mel em destaque">
                    </div>
                </article>

                <div class="overview__gallery" id="galeria">
                    <article class="gallery-card gallery-card--large">
                        <img src="imagens/Verde.jpg" alt="Abelha em flor">
                        <div class="gallery-card__content">
                            <p class="section-label">Destaque</p>
                            <h3>Imagens com mais presenca</h3>
                            <p>As fotos agora ajudam a contar a historia do site logo na primeira tela.</p>
                        </div>
                    </article>
                    <article class="gallery-card">
                        <img src="imagens/honey bee.jpg" alt="Colmeia">
                    </article>
                    <article class="gallery-card">
                        <img src="imagens/polen.jpg" alt="Abelha coletando polen">
                    </article>
                    <article class="gallery-card">
                        <img src="imagens/flor.jpg" alt="Abelha em flor amarela">
                    </article>
                </div>
            </section>

            <section class="species-section" id="especies">
                <div class="section-heading">
                    <div>
                        <p class="section-label">Colecao</p>
                        <h2>Especies em destaque</h2>
                    </div>
                    <p>Os cards agora saem da mesma base de dados das paginas internas, deixando o catalogo mais organizado e facil de ampliar.</p>
                </div>

                <div class="species-tools">
                    <label class="species-tools__search">
                        <span>Buscar especie</span>
                        <input id="speciesSearch" type="search" placeholder="Digite um nome comum ou cientifico">
                    </label>
                    <div class="species-tools__filters">
                        <button class="species-filter is-active" type="button" data-filter="todas">Todas</button>
                        <?php foreach ($speciesCategories as $category): ?>
                            <button class="species-filter" type="button" data-filter="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="species-grid">
                    <?php foreach ($speciesList as $species): ?>
                        <?php
                        $cardClass = $species['featured'] ? 'species-card species-card--featured' : 'species-card';
                        $speciesLink = '../' . bee_encode_path('especies', $species['slug'] . '.php');
                        $speciesImage = '../' . bee_encode_path('especies', 'imagens', $species['slug'], $species['image']);
                        $wikipediaLink = bee_wikipedia_url($species);
                        ?>
                        <article
                            class="<?= htmlspecialchars($cardClass, ENT_QUOTES, 'UTF-8') ?>"
                            data-category="<?= htmlspecialchars($species['category'], ENT_QUOTES, 'UTF-8') ?>"
                            data-search="<?= htmlspecialchars(strtolower($species['common_name'] . ' ' . $species['scientific_name']), ENT_QUOTES, 'UTF-8') ?>"
                        >
                            <a class="species-card__media" href="<?= htmlspecialchars($speciesLink, ENT_QUOTES, 'UTF-8') ?>">
                                <img src="<?= htmlspecialchars($speciesImage, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($species['common_name'], ENT_QUOTES, 'UTF-8') ?>">
                            </a>
                            <span><?= htmlspecialchars($species['common_name'], ENT_QUOTES, 'UTF-8') ?></span>
                            <small><?= htmlspecialchars($species['scientific_name'], ENT_QUOTES, 'UTF-8') ?></small>
                            <div class="species-card__actions">
                                <a class="species-card__button species-card__button--site" href="<?= htmlspecialchars($speciesLink, ENT_QUOTES, 'UTF-8') ?>">Abrir pagina</a>
                                <a class="species-card__button species-card__button--wiki" href="<?= htmlspecialchars($wikipediaLink, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Wikipedia</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="feature-band">
                <div class="feature-band__text">
                    <p class="section-label">Experiencia</p>
                    <h2>Um visual mais vivo para combinar com o tema</h2>
                    <p>
                        Entre cards maiores, imagens panoramicas e uso mais intenso das laterais,
                        o site ficou com mais presenca sem perder a leitura em celular.
                    </p>
                    <p>
                        A experiencia foi pensada para ser mais envolvente desde a primeira tela,
                        com imagens em destaque, nomes mais familiares e uma navegacao que convida
                        o visitante a explorar cada abelha com mais curiosidade.
                    </p>
                </div>
                <div class="feature-band__images">
                    <img src="imagens/Verde.jpg" alt="Ilustracao de abelha">
                    <img src="imagens/Fundodosite.jpg" alt="Fundo ilustrativo">
                </div>
            </section>

            <section class="contact-section" id="contato">
                <div class="section-heading">
                    <div>
                        <p class="section-label">Contato</p>
                        <h2>Envie uma mensagem</h2>
                    </div>
                    <p>Formulario em PHP com retorno visual de sucesso ou erro.</p>
                </div>

                <?php if ($mensagemStatus !== null): ?>
                    <div class="form-status form-status--<?= htmlspecialchars($mensagemStatus['tipo'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($mensagemStatus['texto'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <div class="contact-layout">
                    <form class="contact-form" action="contato.php" method="post">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Seu nome" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="voce@email.com" required>

                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem" required></textarea>

                        <button type="submit" class="button button--primary button--full">Enviar mensagem</button>
                    </form>

                    <aside class="contact-aside">
                        <img src="especies/imagens/Oxytrigona tataira.jpg" alt="Abelha em detalhe">
                        <div class="contact-aside__copy">
                            <p class="section-label">Conversa aberta</p>
                            <h3>Fale sobre abelhas, meliponicultura e preservacao</h3>
                            <p>Se quiser sugerir outra especie, corrigir informacoes ou mandar uma ideia visual, o formulario ja esta pronto para receber.</p>
                        </div>
                    </aside>
                </div>
            </section>
        </main>

        <footer class="footer">
            <p>Guia das Abelhas - Projeto visual Criado por SaymonDev em 2026 Para Giovanna </p>
        </footer>
    </div>
    <script>
        window.heroSlides = <?= json_encode($heroSlides, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
    </script>
    <script src="script.js"></script>
</body>
</html>
