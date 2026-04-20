<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#contato');
    exit;
}

$nome = trim((string) ($_POST['nome'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$mensagem = trim((string) ($_POST['mensagem'] ?? ''));
$destinatario = 'vianaabelhas@gmail.com';

if ($nome === '' || $email === '' || $mensagem === '') {
    header('Location: index.php?status=erro#contato');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?status=email-invalido#contato');
    exit;
}

$arquivo = __DIR__ . DIRECTORY_SEPARATOR . 'mensagens-contato.csv';
$criarCabecalho = !file_exists($arquivo) || filesize($arquivo) === 0;
$handle = fopen($arquivo, 'ab');

if ($handle === false) {
    header('Location: index.php?status=falha#contato');
    exit;
}

if ($criarCabecalho) {
    fputcsv($handle, ['data', 'nome', 'email', 'mensagem'], ';');
}

$mensagemLimpa = preg_replace("/\\s+/", ' ', $mensagem) ?? $mensagem;
fputcsv($handle, [date('c'), $nome, $email, $mensagemLimpa], ';');
fclose($handle);

$assunto = 'Nova mensagem do site Guia das Abelhas';
$corpo = implode("\n", [
    'Nova mensagem recebida pelo formulario do site.',
    '',
    'Nome: ' . $nome,
    'Email: ' . $email,
    '',
    'Mensagem:',
    $mensagem,
]);

$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: Guia das Abelhas <no-reply@abelhas.local>',
    'Reply-To: ' . $nome . ' <' . $email . '>',
    'X-Mailer: PHP/' . phpversion(),
];

$emailEnviado = mail($destinatario, $assunto, $corpo, implode("\r\n", $headers));

header('Location: index.php?status=' . ($emailEnviado ? 'sucesso' : 'email-nao-enviado') . '#contato');
exit;
