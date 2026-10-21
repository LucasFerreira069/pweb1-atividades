1. Acrescente $conta->saldo = -300; antes de apresentarDados(). Execute, copie a
saída e explique o problema. Depois apague a linha.
Titular: João
Conta: 12345
Saldo: R$ -300,00

O saldo será apresentado como R$ -300,00, porque a classe não impede essa alteração. Esse é o problema do encapsulamento: o código de fora consegue modificar o saldo sem passar pelas regras de depósito e saque.


2. Encapsule a classe:
 todos os atributos passam a ser private;
 construtor __construct(string $titular, string $numero);
 getters getTitular() e getSaldo() (o consultarSaldo() pode virar o
getSaldo());

 depositar() e sacar() passam a usar throw new Exception(...) com as men-
sagens Depósito inválido., Saque inválido. e Saldo insuficiente.;

 novo atributo private array $extrato = [], um método privado
registrar(string $operacao, float $valor): void, chamado depois de
cada depósito e saque bem-sucedido, e o getter getExtrato(): array.
3. No uso: crie a conta de João (número 12345) com o construtor, deposite 1000 e saque
250. Depois, em dois blocos try/catch, tente sacar 5000 e depositar −10. Por m,
mostre o extrato e o saldo nal.

Recusado: Saldo insuficiente. Recusado: Depósito inválido. Extrato de João: - Depósito: R$ 1.000,00 - Saque: R$ 250,00 Saldo final: R$ 750,00

4. Abra o teste-protecao.php. Tire o comentário de uma linha por vez, execute, copie o
erro e volte o comentário.

| Teste | Erro esperado | Explicação |
|---|---|---|
| `$conta->saldo = -300;` | `Error` | O atributo `$saldo` é privado e não pode ser alterado diretamente de fora da classe. |
| `$conta->registrar('Depósito', 1000000);` | `Error` | O método `registrar()` é privado e só pode ser chamado dentro da classe. |
| `echo $conta->saldo;` | `Error` | O atributo `$saldo` é privado e não pode ser lido diretamente de fora da classe. |