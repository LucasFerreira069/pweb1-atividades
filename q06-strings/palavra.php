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