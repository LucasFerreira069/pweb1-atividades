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

| Teste | Erro esperado | Explicação |
|---|---|---|
| `$p1` | `ArgumentCountError` | Falta o argumento obrigatório `$preco`. |
| `$p2` | `TypeError` | O preço deveria ser `float`, mas foi informado um texto (`string`). |
| `$p3` | `ArgumentCountError` | Faltam os argumentos obrigatórios `$nome` e `$preco`. |