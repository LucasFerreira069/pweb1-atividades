1. Antes de executar, preencha a coluna Minha previsão da tabela do respostas.md.
2. Execute
curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php
Copie a saída e preencha a coluna Resultado real.
3. Explique cada linha da saída e onde sua previsão errou.
4. Explique para que servem as chaves em {$semestre} e como colocar um espaço em
$nome . $curso.

RESPOSTA:
As aspas duplas permitem a interpolação de variáveis, como $nome e $curso. As chaves {} delimitam a variável dentro da string. O operador . concatena valores, e para adicionar um espaço entre $nome e $curso deve-se usar $nome . " " . $curso.