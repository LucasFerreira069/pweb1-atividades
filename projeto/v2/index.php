<?php

class Projeto
{
    private string $titulo;
    private string $descricao;
    private string $tecnologias;

    public function __construct(string $titulo, string $descricao, string $tecnologias)
    {
        if (trim($titulo) === '') {
            throw new Exception('O projeto precisa de um título');
        }

        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->tecnologias = $tecnologias;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getTecnologias(): string
    {
        return $this->tecnologias;
    }

    public function paraArray(): array
    {
        return [
            'titulo'      => $this->titulo,
            'descricao'   => $this->descricao,
            'tecnologias' => $this->tecnologias,
        ];
    }
}


class Perfil
{
    private string $nome;
    private string $curso;
    private string $campus;
    private string $cidade;
    private string $apresentacao;
    private array $habilidades;
    private array $projetos = [];

    public function __construct(
        string $nome,
        string $curso,
        string $campus,
        string $cidade,
        string $apresentacao,
        array $habilidades
    ) {
        if (count($habilidades) < 5) {
            throw new Exception('O perfil precisa de pelo menos 5 habilidades');
        }

        $this->nome = $nome;
        $this->curso = $curso;
        $this->campus = $campus;
        $this->cidade = $cidade;
        $this->apresentacao = $apresentacao;
        $this->habilidades = $habilidades;
    }

    public function adicionarProjeto(Projeto $projeto): void
    {
        $this->projetos[count($this->projetos) + 1] = $projeto;
    }

    public function getProjeto(int $id): Projeto
    {
        if (!isset($this->projetos[$id])) {
            throw new Exception('Projeto não encontrado');
        }

        return $this->projetos[$id];
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCurso(): string
    {
        return $this->curso;
    }

    public function getCampus(): string
    {
        return $this->campus;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getApresentacao(): string
    {
        return $this->apresentacao;
    }

    public function getHabilidades(): array
    {
        return $this->habilidades;
    }

    public function getProjetos(): array
    {
        return $this->projetos;
    }

    public function paraArray(): array
    {
        $projetos = [];
        foreach ($this->projetos as $id => $projeto) {
            $projetos[$id] = $projeto->paraArray();
        }

        return [
            'nome'         => $this->nome,
            'curso'        => $this->curso,
            'campus'       => $this->campus,
            'cidade'       => $this->cidade,
            'apresentacao' => $this->apresentacao,
            'habilidades'  => $this->habilidades,
            'projetos'     => $projetos,
        ];
    }
}


$perfil = new Perfil(
    'Lucas Ferreira da Silva Filho',
    'Análise e Desenvolvimento de Sistemas',
    'IFCE Campus Boa Viagem',
    'Boa viagem - CE',
    'Olá! Meu nome é Lucas, sou estudante de Análise e Desenvolvimento de Sistemas. Gosto de programar em Python e JavaScript e estou sempre buscando aprender novas tecnologias e aprimorar minhas habilidades. Meu objetivo é me tornar um desenvolvedor Full Stack',
    ['HTML', 'CSS', 'PostgreSQL', 'JavaScript', 'Python', 'Git', 'GitHub', 'Docker']
);

$perfil->adicionarProjeto(new Projeto(
    'VANTAGE',
    'APP para gestão financeira de pequenos empresários.',
    'FastAPI, Python, PostgreSQL, Docker, Git/GitHub'
));

$perfil->adicionarProjeto(new Projeto(
    'Estoque-app',
    'Sistema web voltado para pequenos comércios, com o objetivo de ter um controle de estoque.',
    'Node.js, JWT, SQLite, Git/GitHub'
));

$perfil->adicionarProjeto(new Projeto(
    'Sistema de pedidos para uma pizzaria',
    'Sistema de pedidos online para pizzaria, com catálogo de produtos, carrinho de compras e geração automática de pedidos formatados para envio via WhatsApp.',
    'HTML, CSS, JavaScript, Git/GitHub'
));

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


if (($_GET['formato'] ?? '') === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        ['perfil' => $perfil, 'projetos' => $projetos],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
    exit;
}


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

$menuAtivo = ($pagina === 'projeto') ? 'projetos' : $pagina;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($perfil->getNome()) ?> | Perfil do Estudante</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-<?= htmlspecialchars($tema) ?>">


<header>
    <h1><?= htmlspecialchars($perfil->getNome()) ?></h1>
    <p><?= htmlspecialchars($perfil->getCurso()) ?></p>
    <nav>
        <a href="?pagina=inicio" <?= $menuAtivo === 'inicio' ? 'class="ativo" aria-current="page"' : '' ?>>Início</a>
        <a href="?pagina=habilidades" <?= $menuAtivo === 'habilidades' ? 'class="ativo" aria-current="page"' : '' ?>>Habilidades</a>
        <a href="?pagina=projetos" <?= $menuAtivo === 'projetos' ? 'class="ativo" aria-current="page"' : '' ?>>Projetos</a>
         <a class="botao-tema" href="?tema=<?= $outroTema ?>" title="Mudar para tema <?= $outroTema ?>" aria-label="Mudar para tema <?= $outroTema ?>">
            <svg class="icone-lua" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="icone-sol" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="bolinha"></span>
        </a>
    </nav>
</header>


<main>
    <?php if ($pagina === 'inicio'): ?>

        <h2>Sobre mim</h2>
        <p><?= htmlspecialchars($perfil->getApresentacao()) ?></p>
        <ul>
            <li><strong>Curso:</strong> <?= htmlspecialchars($perfil->getCurso()) ?></li>
            <li><strong>Campus:</strong> <?= htmlspecialchars($perfil->getCampus()) ?></li>
            <li><strong>Cidade:</strong> <?= htmlspecialchars($perfil->getCidade()) ?></li>
        </ul>

    <?php elseif ($pagina === 'habilidades'): ?>

        <h2>Habilidades</h2>
        <p>Total de habilidades: <strong><?= count($perfil->getHabilidades()) ?></strong></p>
        <p><?= htmlspecialchars(implode(', ', $perfil->getHabilidades())) ?></p>

    <?php elseif ($pagina === 'projetos'): ?>

        <h2>Projetos</h2>
        <div class="cartoes">
            <?php foreach ($perfil->getProjetos() as $id => $projeto): ?>
                <article class="cartao">
                    <h3><?= htmlspecialchars($projeto->getTitulo()) ?></h3>
                    <p><?= htmlspecialchars($projeto->getDescricao()) ?></p>
                    <p><small><?= htmlspecialchars($projeto->getTecnologias()) ?></small></p>
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
    <p><a href="?formato=json">Ver em JSON</a></p>
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($perfil->getNome()) ?></p>
</footer>

</body>
</html>