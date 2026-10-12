1. Execute
curl.exe -i http://localhost:8000/q10-cookies/login.php
Copie a saída e explique o aviso. Faça um commit.

Carregando a página...
Warning: Cannot modify header information - headers already sent by (output started at C:\Users\lucas\Documents\pweb1-atividades\q10-cookies\login.php:2) in C:\Users\lucas\Documents\pweb1-atividades\q10-cookies\login.php on line 3

RESPOSTA:
O echo envia conteúdo para a resposta HTTP antes de setcookie() e header(). Como esses comandos precisam enviar cabeçalhos HTTP, o PHP pode não conseguir executá-los corretamente depois que o conteúdo já começou a ser enviado.


2. Crie q10-cookies/dashboard.php, que mostre o valor do cookie usuario_logado (valor
padrão não).
3. Corrija o login.php para que o cookie seja gravado e o redirecionamento aconteça sem
avisos.
4. Execute de novo
curl.exe -i http://localhost:8000/q10-cookies/login.php
Explique o status, o Location e o Set-Cookie.
5. Explique por que setcookie() e header() precisam vir antes de qualquer echo.