1. No Terminal 1, dentro de aula03-oo: php -S localhost:8000 -d display_errors=1
-d output_buffering=0
2. Abra http://localhost:8000/q08-turma-web/turma.php no navegador.

Programação Web I
Aluno	Média	Situação
Ana	8,75	Aprovado
Bruno	5,50	Reprovado
Caio	2,75	Reprovado
Daniela	7,00	Aprovado
Média da turma: 6,00

Aprovados: 2 de 4 alunos.

3. No Terminal 2: curl.exe -i http://localhost:8000/q08-turma-web/turma.php e,
depois, com ?teste=1.

curl.exe -i http://localhost:8000/q08-turma-web/turma.php
SAIDA:
localhost:8000/q08-turma-web/turma.php
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Wed, 21 Oct 2026 23:36:29 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: text/html; charset=UTF-8
Content-Length: 556

<!doctype html><html><head><title>404 Not Found</title><style>
body { background-color: #fcfcfc; color: #333333; margin: 0; padding:0; }
h1 { font-size: 1.5em; font-weight: normal; background-color: #9999cc; min-height:2em; line-height:2em; border-bottom: 1px inset black; margin: 0; }
h1, p { padding-left: 10px; }
code.url { background-color: #eeeeee; font-family:monospace; padding:0 2px;}
</style>
</head><body><h1>Not Found</h1><p>The requested resource <code class="url">/q08-turma-web/turma.php</code> was not found on this server.</p></body></html>

?teste=1.
SAIDA:
/localhost:8000/q08-turma-web/turma.php?teste=1"
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Wed, 21 Oct 2026 23:38:00 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: text/html; charset=UTF-8
Content-Length: 564

<!doctype html><html><head><title>404 Not Found</title><style>
body { background-color: #fcfcfc; color: #333333; margin: 0; padding:0; }
h1 { font-size: 1.5em; font-weight: normal; background-color: #9999cc; min-height:2em; line-height:2em; border-bottom: 1px inset black; margin: 0; }
h1, p { padding-left: 10px; }
code.url { background-color: #eeeeee; font-family:monospace; padding:0 2px;}
</style>
</head><body><h1>Not Found</h1><p>The requested resource <code class="url">/q08-turma-web/turma.php?teste=1</code> was not found on this server.</p></body></html>

4. Para a pergunta (a), acrescente temporariamente
$pweb->adicionarAluno('Eduardo'); logo depois dos outros adicionarAluno,
abra a página, copie o erro e desfaça.

Fatal error: Uncaught TypeError: Disciplina::adicionarAluno(): Argument #1 ($aluno) must be of type Aluno, string given

o método adicionarAluno() exige um objeto da classe Aluno, mas foi recebida uma string ('Eduardo'). Por isso, o PHP lança um TypeError.