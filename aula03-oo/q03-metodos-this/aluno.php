<?php
declare(strict_types=1);

class Aluno
{
    public string $nome;
    public float $nota1;
    public float $nota2;

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->calcularMedia();

        if ($media >= 7) {
            return 'Aprovado';
        } elseif ($media >= 4) {
            return 'Recuperação';
        } else {
            return 'Reprovado';
        }
    }

    public function apresentar(): void
    {
        $media = number_format($this->calcularMedia(), 1, ',', '.');

        echo "{$this->nome}: média {$media} ({$this->situacao()})\n";
    }
}


$aluno1 = new Aluno();
$aluno1->nome = 'Ana';
$aluno1->nota1 = 9.0;
$aluno1->nota2 = 8.5;


$aluno2 = new Aluno();
$aluno2->nome = 'Bruno';
$aluno2->nota1 = 6.0;
$aluno2->nota2 = 5.0;


$aluno3 = new Aluno();
$aluno3->nome = 'Caio';
$aluno3->nota1 = 3.0;
$aluno3->nota2 = 2.5;


$aluno4 = new Aluno();
$aluno4->nome = 'Lucas';
$aluno4->nota1 = 6.5;
$aluno4->nota2 = 7.5;

$aluno1->apresentar();
$aluno2->apresentar();
$aluno3->apresentar();
$aluno4->apresentar();
?>