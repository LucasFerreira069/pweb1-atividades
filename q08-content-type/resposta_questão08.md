1. Explique json_encode, JSON_PRETTY_PRINT e JSON_UNESCAPED_UNICODE.

json_encode()
Converte o array do PHP para o formato JSON.

JSON_PRETTY_PRINT
Deixa o JSON organizado e indentado, facilitando a leitura.

JSON_UNESCAPED_UNICODE
Impede que caracteres Unicode, como ã, ç e é, sejam convertidos para sequências \uXXXX.


2. Execute
curl.exe -i http://localhost:8000/q08-content-type/dados.php
Copie a saída. No navegador, abra o DevTools (aba Network), clique na requisição e
salve um print do Content-Type em prints/devtools-html.png.
3. Descomente a linha do header, repita o curl e salve o print prints/devtools-json.png.
4. Compare as duas saídas: o que mudou e o que não mudou?

RESPOSTA:O conteúdo da resposta não mudou, pois continua sendo o mesmo JSON. A mudança ocorreu no cabeçalho Content-Type: antes o servidor informava que o conteúdo era HTML (text/html), e depois passou a informar corretamente que era JSON (application/json).


5. Retire o JSON_UNESCAPED_UNICODE, repita o curl e explique o que aconteceu com Pro-
gramação. Depois devolva a opção ao código.

Ao retirar JSON_UNESCAPED_UNICODE, a palavra “Programação” passou a ser exibida como Programa\u00e7\u00e3o, pois o json_encode() escapou o caractere ç usando Unicode. Depois, a opção JSON_UNESCAPED_UNICODE foi adicionada novamente para manter os caracteres acentuados normalmente.

