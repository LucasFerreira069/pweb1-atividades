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

p://localhost:8000/q10-cookies/login.php
HTTP/1.1 302 Found
Host: localhost:8000
Date: Mon, 12 Oct 2026 14:49:55 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: usuario_logado=true; expires=Mon, 12 Oct 2026 15:49:55 GMT; Max-Age=3600
Location: dashboard.php
Content-type: text/html; charset=UTF-8

RESPOSTA:
Location: dashboard.php: informa o endereço de destino do redirecionamento.

Set-Cookie: solicita que o cliente armazene o cookie por uma hora.

5. Explique por que setcookie() e header() precisam vir antes de qualquer echo.
RESPOSTA:
setcookie() e header() precisam vir antes do echo porque enviam cabeçalhos HTTP, que devem ser definidos antes do conteúdo da resposta.