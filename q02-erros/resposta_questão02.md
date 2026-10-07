1. Antes de executar, encontre o erro no código e indique a linha.
RESPOSTA: Falta um ponto e virgula no final da segunda linha e faltou ?> no final do codigo.

2. Abra a página no navegador. Copie a mensagem de erro e as linhas do log.
3. No Terminal 1, pare o servidor com Ctrl+C e suba de novo com -d display_errors=0
no lugar de =1. Abra a página outra vez e copie o log.
4. Compare o status registrado no log nas duas execuções e explique a diferença.
5. Volte o servidor para display_errors=1, corrija o erro, teste e faça um commit.

log 1:
[Wed Oct  7 18:24:22 2026] [::1]:51723 Accepted
[Wed Oct  7 18:24:22 2026] [::1]:51723 [200]: GET /erro.php
[Wed Oct  7 18:24:22 2026] [::1]:51723 Closing
[Wed Oct  7 18:24:22 2026] [::1]:57863 Accepted
[Wed Oct  7 18:24:26 2026] [::1]:57863 Closed without sending a request; it was probably just an unused speculative preconnection
[Wed Oct  7 18:24:26 2026] [::1]:57863 Closing



log 2:
[Wed Oct  7 18:22:29 2026] [::1]:54696 Accepted
[Wed Oct  7 18:22:29 2026] [::1]:58403 [200]: GET /erro.php
[Wed Oct  7 18:22:29 2026] [::1]:58403 Closing
[Wed Oct  7 18:22:35 2026] [::1]:54696 [404]: GET /.well-known/appspecific/com.chrome.devtools.json - No such file or directory
[Wed Oct  7 18:22:35 2026] [::1]:54696 Closing

RESPOSTA: Com o -d display_errors=1 O erro aparece detalhadamente no navegador e também pode aparecer no log.

Com -d display_errors=0 O PHP continua encontrando o erro, mas não mostra os detalhes do erro para o usuário.

