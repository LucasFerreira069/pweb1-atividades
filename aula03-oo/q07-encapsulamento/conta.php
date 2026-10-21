<?php

declare(strict_types=1);

class ContaBancaria
{
    // Atributos privados: só podem ser acessados diretamente pela classe
    private string $titular;
    private string $numero;
    private float $saldo = 0.0;
    private array $extrato = [];

    // Construtor
    public function __construct(string $titular, string $numero)
    {
        $this->titular = $titular;
        $this->numero = $numero;
    }

    // Getter do titular
    public function getTitular(): string
    {
        return $this->titular;
    }

    // Getter do saldo
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    // Registra uma operação no extrato
    private function registrar(string $operacao, float $valor): void
    {
        $this->extrato[] = [
            'operacao' => $operacao,
            'valor' => $valor
        ];
    }

    // Getter do extrato
    public function getExtrato(): array
    {
        return $this->extrato;
    }

    // Deposita dinheiro
    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Depósito inválido.");
        }

        $this->saldo += $valor;
        $this->registrar('Depósito', $valor);
    }

    // Saca dinheiro
    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Saque inválido.");
        }

        if ($valor > $this->saldo) {
            throw new Exception("Saldo insuficiente.");
        }

        $this->saldo -= $valor;
        $this->registrar('Saque', $valor);
    }
}

// Uso da conta
$conta = new ContaBancaria('João', '12345');

$conta->depositar(1000);
$conta->sacar(250);

// Tentativa de saque inválido
try {
    $conta->sacar(5000);
} catch (Exception $e) {
    echo "Recusado: " . $e->getMessage() . "\n";
}

// Tentativa de depósito inválido
try {
    $conta->depositar(-10);
} catch (Exception $e) {
    echo "Recusado: " . $e->getMessage() . "\n";
}

// Exibe o extrato
echo "Extrato de " . $conta->getTitular() . ":\n";

foreach ($conta->getExtrato() as $operacao) {
    echo "- " . $operacao['operacao'] . ": R$ "
        . number_format($operacao['valor'], 2, ',', '.') . "\n";
}

// Exibe o saldo final
echo "Saldo final: R$ "
    . number_format($conta->getSaldo(), 2, ',', '.') . "\n";
?>