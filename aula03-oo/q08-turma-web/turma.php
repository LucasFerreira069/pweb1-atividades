<?php

declare(strict_types=1);

// Classe Aluno
class Aluno
{
    private string $nome;
    private float $nota1;
    private float $nota2;

    public function __construct(string $nome, float $nota1, float $nota2)
    {
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
            throw new Exception(
                "Nota inválida para {$nome}: use valores de 0 a 10."
            );
        }

        $this->nome = $nome;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        return $this->calcularMedia() >= 7
            ? 'Aprovado'
            : 'Reprovado';
    }
}

// Classe Disciplina
class Disciplina
{
    private string $nome;
    private array $alunos = [];

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getAlunos(): array
    {
        return $this->alunos;
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function calcularMediaTurma(): float
    {
        if (count($this->alunos) === 0) {
            return 0;
        }

        $soma = 0;

        foreach ($this->alunos as $aluno) {
            $soma += $aluno->calcularMedia();
        }

        return $soma / count($this->alunos);
    }

    public function contarAprovados(): int
    {
        $aprovados = 0;

        foreach ($this->alunos as $aluno) {
            if ($aluno->situacao() === 'Aprovado') {
                $aprovados++;
            }
        }

        return $aprovados;
    }
}

// Lógica da página
$pweb = new Disciplina('Programação Web I');

$pweb->adicionarAluno(new Aluno('Ana', 8.0, 9.5));
$pweb->adicionarAluno(new Aluno('Bruno', 5.0, 6.0));
$pweb->adicionarAluno(new Aluno('Caio', 2.5, 3.0));
$pweb->adicionarAluno(new Aluno('Daniela', 7.0, 7.0));

// Teste de nota inválida pela URL ?teste=1
$mensagemErro = '';

if (isset($_GET['teste']) && $_GET['teste'] === '1') {
    try {
        $pweb->adicionarAluno(new Aluno('Eduardo', 11, 8));
    } catch (Exception $e) {
        $mensagemErro = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma - Programação Web I</title>
</head>
<body>

    <h1><?= htmlspecialchars($pweb->getNome(), ENT_QUOTES, 'UTF-8') ?></h1>

    <?php if ($mensagemErro !== ''): ?>
        <p>
            Recusado:
            <?= htmlspecialchars($mensagemErro, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Média</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pweb->getAlunos() as $aluno): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($aluno->getNome(), ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td>
                        <?= number_format($aluno->calcularMedia(), 2, ',', '.') ?>
                    </td>
                    <td><?= $aluno->situacao() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        Média da turma:
        <?= number_format($pweb->calcularMediaTurma(), 2, ',', '.') ?>
    </p>

    <p>
        Aprovados: <?= $pweb->contarAprovados() ?>
        de <?= count($pweb->getAlunos()) ?> alunos.
    </p>

</body>
</html>
