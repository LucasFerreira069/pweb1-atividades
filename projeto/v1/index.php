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

$pagina = $_GET['pagina'] ?? 'inicio';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($perfil['nome']) ?> | Perfil do Estudante</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>


<header>
    <h1><?= htmlspecialchars($perfil['nome']) ?></h1>
    <p><?= htmlspecialchars($perfil['curso']) ?></p>
    <nav>
        <a href="?pagina=inicio">Início</a>
        <a href="?pagina=habilidades">Habilidades</a>
        <a href="?pagina=projetos">Projetos</a>
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

    <?php endif; ?>
</main>


<footer>
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil['nome']) ?></p>
</footer>

</body>
</html>