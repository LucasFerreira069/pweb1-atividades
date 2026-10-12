<?php

$usuarioLogado = $_COOKIE['usuario_logado'] ?? 'não';

echo "Usuário logado: " . $usuarioLogado;