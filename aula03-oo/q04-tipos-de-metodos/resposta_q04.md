1. Antes de executar, preencha a tabela de classicação do respostas.md.
| Método | Classificação | Motivo |
|---|---|---|
| `getTemperatura()` | De consulta, com retorno | Consulta e devolve a temperatura. |
| `definirAlvo(float $alvo)` | De ação, com parâmetro | Recebe um valor e altera o alvo. |
| `resfriar(float $graus)` | De ação, com parâmetro | Diminui a temperatura. |
| `precisaResfriar()` | De consulta, com retorno | Verifica se a temperatura está acima do alvo e retorna `bool`. |
| `mostrarStatus()` | De ação, sem retorno | Exibe informações com `echo`. |


2. Antes de executar, escreva a sua previsão das 5 linhas da saída.

Linha 1 — estado inicial

Temperatura de 25 °C, acima do alvo de 22 °C. Portanto, aparece resfriando.

Linha 2 — depois de resfriar 2 graus

A temperatura passa a 23 °C. Como ainda está acima de 22 °C, continua resfriando.

Linha 3 — alvo alterado para 24 °C

A temperatura continua em 23 °C. Como está abaixo do alvo, aparece ok.

Linha 4 — temperatura mais 10

O echo $sala->getTemperatura() + 10 calcula 23 + 10 e imprime 33.

Linha 5 — resultado de var_dump

precisaResfriar() retorna false, pois 23 não é maior que 24. O var_dump mostra bool(false).

3. Execute e compare com a sua previsão. Explique cada diferença.

### 3. Comparação entre a previsão e a saída

A saída obtida foi igual à prevista, sem diferenças.

- Inicialmente, a temperatura era 25 °C, acima do alvo de 22 °C, então o status foi `resfriando`.
- Após resfriar 2 °C, a temperatura ficou em 23 °C e continuou `resfriando`.
- Ao alterar o alvo para 24 °C, a temperatura ficou abaixo do alvo, então o status passou a ser `ok`.
- O método `getTemperatura() + 10` exibiu `33`.
- O método `precisaResfriar()` retornou `bool(false)`, pois 23 °C não é maior que 24 °C.
- Após aquecer 5 °C, a temperatura chegou a 28 °C, ficando acima do alvo. O status voltou a ser `resfriando`, e a diferença para o alvo foi de 4 °C.

4. Acrescente à classe dois métodos:
 aquecer(float $graus): void, que soma os graus à temperatura;
 diferencaParaAlvo(): float, que devolve a temperatura menos o alvo.
No m do arquivo, chame $sala->aquecer(5), depois $sala->mostrarStatus(), e
mostre a diferença para o alvo. Execute e registre a saída.

Laboratório 1: 25 °C (alvo 22 °C) - resfriando Laboratório 1: 23 °C (alvo 22 °C) - resfriando Laboratório 1: 23 °C (alvo 24 °C) - ok 33 bool(false) Laboratório 1: 28 °C (alvo 24 °C) - resfriando Diferença para o alvo: 4 °C

### 4. Novos métodos

- `aquecer(float $graus): void`: recebe a quantidade de graus e aumenta a temperatura do termostato.
- `diferencaParaAlvo(): float`: retorna a diferença entre a temperatura atual e a temperatura-alvo, sem alterar os valores do objeto.

Após aquecer 5 °C, a temperatura passou de 23 °C para 28 °C. Como o alvo é 24 °C, a diferença retornada foi de 4 °C.