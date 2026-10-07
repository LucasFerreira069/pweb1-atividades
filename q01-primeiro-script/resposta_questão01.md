1. Leia o código e responda à análise do respostas.md: quais linhas são HTML, quais são
PHP, e a diferença entre <?php echo e <?=.

RESPOSTA: Tudo que está foda do <?php> é html e tudo que está dentro de <?php> é php.


2. Abra http://localhost:8000/q01-primeiro-script/ola.php no navegador. Copie
as linhas que surgiram no Terminal 1 e explique cada parte.

"[Wed Oct  7 15:38:44 2026] PHP 8.4.25 Development Server (http://localhost:8000) started"
Aqui fala que o servidor foi iniciado na porta 8000

"[Wed Oct  7 15:38:52 2026] [::1]:56494 Accepted"
Aqui o servidor recebbeu uma conexão do meu navegador, 56494 é o numero da porta temporia pelo navegador.

"[Wed Oct  7 15:38:52 2026] [::1]:56494 [200]: GET /"
Aqui meu navegador pediu a página inicial do servidor e o servidor respondeu com sucesso (codigo 200).

"[Wed Oct  7 15:38:52 2026] [::1]:56494 Closing"
Aqui o servidor encerrou a conexão

"[Wed Oct  7 15:38:52 2026] [::1]:62739 Accepted"
O navegador abriu outra conexão com o servidor

3. Aperte F5 três vezes e observe o que muda na página e no log.
RESPOSTA: Cada vez que aperto f5 o navegador faz uma nova requisisção para o servidor PHP.

4. Aperte Ctrl+U e verique se aparece alguma linha de PHP.
RESPOSTA: Ao apertar ctrl + u vai mostrar o HTML final que o servidor gerou e enviou ao navegador



5. No Terminal 2, execute
curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php

Primeira linha: HTTP/1.1 404 Not Found indica que o servidor não encontrou o recurso solicitado.
Cabeçalhos: apresentam informações sobre a resposta, como servidor, data, versão do PHP, tipo e tamanho do conteúdo.
Corpo: contém o HTML da página de erro 404, informando que o arquivo solicitado não foi encontrado.