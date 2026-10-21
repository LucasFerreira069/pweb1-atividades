1. Acrescente à classe Produto o construtor __construct(string $nome, float $preco,
int $quantidade = 1).
2. Apague a criação antiga do produto (new Produto() e as linhas de atribuição) e o uso
que vem depois. No lugar, crie três produtos, uma linha para cada:
 Notebook, R$ 3.500,00, 3 unidades;
 Mouse, R$ 59,90, 10 unidades;
 Monitor, R$ 899,00, sem informar a quantidade.
3. Coloque os três em um array e, com um foreach, chame apresentar() e mostre o total
de cada um. No m, mostre o total do pedido (R$ 11.998,00).
4. Abra o teste-erros.php. Tire o comentário de uma linha por vez, execute php
q06-construtor/teste-erros.php, copie o erro e volte o comentário.

Testes de erros do construtor

Teste 1 — Argumentos obrigatórios ausentes

Código testado:

$produto1 = new Produto();

Saída:

ArgumentCountError: Too few arguments to function Produto::__construct()

Explicação: O construtor exige os argumentos $nome e $preco. Como nenhum foi informado, o PHP gera um erro.

Teste 2 — Preço com tipo incorreto

Código testado:

$produto2 = new Produto('Mouse', 'barato');

Saída:

TypeError: Produto::__construct(): Argument #2 ($preco) must be of type float, string given

Explicação: O preço deve ser um número decimal (float), mas foi informado um texto (string).

Teste 3 — Quantidade com tipo incorreto

Código testado:

$produto3 = new Produto('Notebook', 3500.00, 'três');

Saída:

TypeError: Produto::__construct(): Argument #3 ($quantidade) must be of type int, string given

Explicação: A quantidade deve ser um número inteiro (int), mas foi informado um texto (string).

Teste 4 — Argumentos corretos

Código testado:

$produto4 = new Produto('Monitor', 899.00, 1);
$produto4->apresentar();

Resultado: O produto é criado corretamente e seus dados são exibidos, sem erros de tipagem.

Explicação: Os argumentos correspondem aos tipos definidos no construtor: nome como string, preço como float e quantidade como int.