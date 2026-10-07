1. Explique o código original.

Ele pega uma palavra enviada pela URL através de $_GET['palavra']. Caso nenhuma palavra seja informada, ele usa "Ceará" como valor padrão. Depois, exibe a palavra e utiliza strlen() para descobrir o tamanho dela.


2. Complete o código para mostrar também mb_strlen, strtoupper e mb_strtoupper, e
uma classicação com if: palavra curta (até 5 letras, usando mb_strlen) ou palavra
longa.

<?php

$palavra = $_GET['palavra'] ?? "Ceará";

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";
echo "<p>mb_strlen: " . mb_strlen($palavra) . "</p>";
echo "<p>strtoupper: " . strtoupper($palavra) . "</p>";
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>";

if (mb_strlen($palavra) <= 5) {
    echo "<p>Classificação: palavra curta</p>";
} else {
    echo "<p>Classificação: palavra longa</p>";
}
?>

3. Execute
curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"
Copie a saída.

Palavra: Ceara
strlen: 5
mb_strlen: 5
strtoupper: CEARA
mb_strtoupper: CEARA
Classificação: palavra curta

4. No navegador, abra palavra.php?palavra=Ceará. Copie a linha do log e explique por
que a palavra aparece como Cear%C3%A1.

Isso acontece porque o navegador transforma o caractere especial á em uma representação chamada URL encoding.
O á é representado em UTF-8 pelos bytes C3 A1, por isso aparece


5. Compare strlen e mb_strlen, e strtoupper e mb_strtoupper, para Ceara e Ceará.
Com Ceara não existe caractere especial já com Ceará tem. O strlen() conta bytes, enquanto mb_strlen() conta os caracteres corretamente em UTF-8.
O á ocupa 2 bytes em UTF-8, mas é apenas 1 caractere.