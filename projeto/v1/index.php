<?php
$perfil = [
    'nome'        => 'Lucas Ferreira da Silva Filho',
    'curso'       => 'Análise e Desenvolvimento de Sistemas',
    'campus'      => 'IFCE Campus Boa Viagem',
    'cidade'      => 'Boa viagem - CE',
    'apresentacao' => 'Olá! Meu nome é Lucas, sou estudante de Análise e Desenvolvimento de Sistemas. Gosto de programar em Python e JavaScript e estou sempre buscando aprender novas tecnologias e aprimorar minhas habilidades. Meu objetivo é me tornar um desenvolvedor Full Stack',
    'habilidades' => [
        'HTML',
        'CSS',
        'PostgreSQL',
        'JavaScript',
        'Python',
        'Git, Git hub',
        'Docker',
    ],
];

$projetos = [
    1 => [
        'titulo'      => 'VANTAGE',
        'descricao'   => 'APP para gestão financeira de pequenos empresários.',
        'tecnologias' => ' FastAPI, Python, PostgreSQL, Docker, Git/GitHub',
    ],
    2 => [
        'titulo'      => 'Estoque-app',
        'descricao'   => 'Sistema web voltado para pequenos comercios, com o objetivo de ter um controle de estoque.',
        'tecnologias' => 'Node.js, JWT, SQlite, Git/GitHub',
    ],
    3 => [
        'titulo'      => 'Sistema de pedidos para uma pizzaria',
        'descricao'   => 'Sistema de pedidos online para pizzaria, com catálogo de produtos, carrinho de compras e geração automática de pedidos formatados para envio via WhatsApp.',
        'tecnologias' => 'HTML, CSS, JavaScript, Git/GitHub',
    ],
];

$tema = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';

if ($tema !== 'claro' && $tema !== 'escuro') {
    $tema = 'claro';
}

if (isset($_GET['tema'])) {
    setcookie('tema', $tema, time() + 60 * 60 * 24 * 30, '/');
}

$outroTema = ($tema === 'claro') ? 'escuro' : 'claro';



$pagina = $_GET['pagina'] ?? 'inicio';
$id = (int) ($_GET['id'] ?? 0);

if ($pagina === 'inicio' || $pagina === 'habilidades' || $pagina === 'projetos') {
    // páginas que existem: o status continua 200
} elseif ($pagina === 'projeto') {
    if (!isset($projetos[$id])) {
        http_response_code(404); // projeto inexistente
    }
} else {
    http_response_code(404); // página inexistente
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($perfil['nome']) ?> | Perfil do Estudante</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-<?= htmlspecialchars($tema) ?>">


<header>
    <h1><?= htmlspecialchars($perfil['nome']) ?></h1>
    <p><?= htmlspecialchars($perfil['curso']) ?></p>
    <nav>
        <a href="?pagina=inicio">Início</a>
        <a href="?pagina=habilidades">Habilidades</a>
        <a href="?pagina=projetos">Projetos</a>
        <a href="?tema=<?= $outroTema ?>">Tema <?= $outroTema ?></a>
    </nav>
</header>


<main>
    <?php if ($pagina === 'inicio'): ?>

        <h2>Sobre mim</h2>
        <p><?= htmlspecialchars($perfil['apresentacao']) ?></p>
        <ul>
            <li><strong>Curso:</strong> <?= htmlspecialchars($perfil['curso']) ?></li>
            <li><strong>Campus:</strong> <?= htmlspecialchars($perfil['campus']) ?></li>
            <li><strong>Cidade:</strong> <?= htmlspecialchars($perfil['cidade']) ?></li>
        </ul>

    <?php elseif ($pagina === 'habilidades'): ?>

        <h2>Habilidades</h2>
        <p>Total de habilidades: <strong><?= count($perfil['habilidades']) ?></strong></p>
        <p><?= htmlspecialchars(implode(', ', $perfil['habilidades'])) ?></p>

    <?php elseif ($pagina === 'projetos'): ?>

        <h2>Projetos</h2>
        <div class="cartoes">
            <?php foreach ($projetos as $id => $projeto): ?>
                <article class="cartao">
                    <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                    <p><?= htmlspecialchars($projeto['descricao']) ?></p>
                    <p><small><?= htmlspecialchars($projeto['tecnologias']) ?></small></p>
                    <a href="?pagina=projeto&amp;id=<?= (int) $id ?>">Ver detalhes</a>
                </article>
            <?php endforeach; ?>
        </div>

    <?php elseif ($pagina === 'projeto' && isset($projetos[$id])): ?>

        <h2><?= htmlspecialchars($projetos[$id]['titulo']) ?></h2>
        <p><?= htmlspecialchars($projetos[$id]['descricao']) ?></p>
        <p><strong>Tecnologias:</strong> <?= htmlspecialchars($projetos[$id]['tecnologias']) ?></p>
        <p><a href="?pagina=projetos">&larr; Voltar para projetos</a></p>

    <?php elseif ($pagina === 'projeto'): ?>

        <h2>Projeto não encontrado</h2>
        <p>Não existe projeto com esse número.</p>
        <p><a href="?pagina=projetos">&larr; Voltar para projetos</a></p>

    <?php else: ?>

        <h2>Página não encontrada</h2>
        <p>A página que você pediu não existe.</p>
        <p><a href="?pagina=inicio">&larr; Voltar ao início</a></p>

    <?php endif; ?>
</main>


<footer>
    <p>Tema atual: <?= htmlspecialchars($tema) ?></p>
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil['nome']) ?></p>
</footer>

</body>
</html>