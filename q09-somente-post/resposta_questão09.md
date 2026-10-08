1. Crie o arquivo q09-somente-post/api.php que:
(a) envie o cabeçalho Content-Type: application/json; charset=utf-8;
(b) verique o método em $_SERVER['REQUEST_METHOD'];
(c) para qualquer método diferente de POST: responda com status 405, o
cabeçalho Allow: POST e o JSON {"erro": "Método não permitido"}, e
encerre com exit;
(d) para POST: responda com status 200 e o JSON {"sucesso": "Dados
recebidos"}.
2. Use json_encode com JSON_UNESCAPED_UNICODE para gerar o JSON.
3. Execute e copie as saídas de:
curl.exe -i http://localhost:8000/q09-somente-post/api.php
curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php
curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php
4. Copie as linhas do log dessas três requisições e explique onde aparecem o método e o
status.
5. Abra o endereço no navegador e explique qual método ele usou e qual status recebeu.

[200]: POST /q09-somente-post/api.php
[405]: GET /q09-somente-post/api.php
[405]: PUT /q09-somente-post/api.php


RESPOSTA: O endereço aceita somente requisições POST. Requisições GET e PUT recebem status 405 (Method Not Allowed), enquanto a requisição POST recebe status 200 (OK). O método utilizado aparece no log do servidor e o status aparece entre colchetes.