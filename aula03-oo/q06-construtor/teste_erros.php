<?php
declare(strict_types=1);

require_once 'produto.php';

// Teste 1: criar produto sem os argumentos obrigatórios
 $produto1 = new Produto();

// Teste 2: passar texto no lugar do preço
 $produto2 = new Produto('Mouse', 'barato');

// Teste 3: passar texto no lugar da quantidade
 $produto3 = new Produto('Notebook', 3500.00, 'três');

// Teste 4: passar argumentos de tipos corretos
$produto4 = new Produto('Monitor', 899.00, 1);

$produto4->apresentar();
?>