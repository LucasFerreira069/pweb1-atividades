1. Antes de executar, preencha a previsão de tipo e valor de cada linha.
2. Execute
curl.exe -s http://localhost:8000/q04-tipos/tipos.php
Copie a saída e explique cada linha do var_dump.

int(15): O + é usado para somar. Mesmo "10" estando entre aspas, o PHP percebe que está sendo usado em uma operação matemática e converte "10" para o número 10.

string(3) "105":O . é o operador de concatenação, usado para juntar valores como texto.

float(3.5): / faz divisão

int(1): % pega o resto da divisão

int(3):O (int) manda o PHP converter para inteiro
a string começa com o número ao converter para int, a parte decimal é descartada

bool(false):A string "0" é uma exceção: quando convertida para bool, ela vira false

bool(true):é texto, não o valor booleano false.
Como a string "false" não está vazia, o PHP considera ela verdadeira

bool(false):Mas computadores representam números decimais (float) em binário, e alguns valores não conseguem ser representados exatamente.
Então internamente o resultado pode ficar ligeiramente diferente de 0.3.

3. Explique a diferença entre "10" + 5 e "10" . 5, e por que (bool) "0" e (bool)
"false" dão resultados diferentes.
4. Acrescente ao arquivo duas linhas var_dump criadas por você e explique o resultado.

var_dump("10" == 10);: O PHP converte "10" para 10 e compara


var_dump(0 == false);: Quando comparado dessa forma, false é tratado como 0:


