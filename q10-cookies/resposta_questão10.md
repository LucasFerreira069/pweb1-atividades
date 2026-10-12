1. Crie q10-cookies/contador.php, que leia o cookie visitas com $_COOKIE (valor
padrão 0), some 1, grave de volta com setcookie (validade de 1 hora) e mostre Você
visitou esta página N vez(es).
2. No navegador, aperte F5 algumas vezes. No DevTools, abra Application > Cookies
e salve o print prints/cookies-application.png.


3. Execute duas vezes
curl.exe -i http://localhost:8000/q10-cookies/contador.php
Copie a saída. Explique por que o contador não passa de 1.

PS C:\Users\lucas\Documents\pweb1-atividades> curl.exe -i http://localhost:8000/q10-cookies/contador.php     
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 14:31:36 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: visitas=1; expires=Mon, 12 Oct 2026 15:31:36 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es).
PS C:\Users\lucas\Documents\pweb1-atividades> curl.exe -i http://localhost:8000/q10-cookies/contador.php
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 14:31:53 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: visitas=1; expires=Mon, 12 Oct 2026 15:31:53 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es).


RESPOSTA:
O contador não passa de um Porque cada execução do curl é uma nova requisição e, sem opções para armazenar e enviar cookies, ele não guarda o cookie recebido para a próxima execução. Assim, $_COOKIE['visitas'] continua inexistente e o contador começa novamente em zero.


4. Execute três vezes
curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/
contador.php
Copie a terceira saída. Explique o que fazem -c e -b.

PS C:\Users\lucas\Documents\pweb1-atividades> curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 14:37:35 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: visitas=3; expires=Mon, 12 Oct 2026 15:37:35 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es).

RESPOSTA:
A opção -c salva os cookies recebidos em um arquivo, enquanto -b envia os cookies desse arquivo nas próximas requisições, permitindo manter o estado do contador.
