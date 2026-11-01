# Projeto v1 - Perfil do Estudante

Programação Web I | Tecnologia em ADS | IFCE Campus Boa Viagem
Atividade Integrada 01 - Versão 1
Estudante: Lucas Ferreira da Silva Filho

Site pessoal feito em PHP, HTML e CSS. Um único arquivo `index.php` responde a todas as rotas, escolhendo o que mostrar pela query string. Tem apresentação, habilidades, projetos, tema claro ou escuro guardado em cookie e uma rota que devolve os dados em JSON.

**Como executar** (dentro da pasta `projeto/v1`):

```
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```


## 1. Mapa de rotas

| URL | O que mostra | Status |
|---|---|---|
| `/` ou `/?pagina=inicio` | Apresentação: nome, curso, campus, cidade e um texto sobre mim | 200 |
| `/?pagina=habilidades` | Minhas habilidades e o total delas | 200 |
| `/?pagina=projetos` | Lista dos 3 projetos em cartões, cada um com link para os detalhes | 200 |
| `/?pagina=projeto&id=1` (também 2 e 3) | Detalhes do projeto: título, descrição e tecnologias | 200 |
| `/?pagina=projeto&id=99` | Mensagem "Projeto não encontrado" | 404 |
| `/?pagina=projeto` (sem id) | O id vira 0, que não existe: "Projeto não encontrado" | 404 |
| `/?pagina=qualquercoisa` | Mensagem "Página não encontrada" | 404 |
| `/?tema=escuro` ou `/?tema=claro` | A página inicial com o tema escolhido, que fica gravado em cookie | 200 |
| `/?formato=json` | Todos os dados do perfil em JSON, sem HTML | 200 |

---

## 2. Saídas do terminal

Terminal 1 (servidor):

```
cd projeto/v1
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

Terminal 2 (pedidos): uso `curl.exe -i`, que mostra os **cabeçalhos** da resposta e depois o **corpo**. Nos trechos abaixo, `...` marca partes que omiti por serem repetidas em todas as páginas (a parte de cima do HTML, o menu e o rodapé).

### 3.1 Uma página que existe

```
curl.exe -i "http://localhost:8000/?pagina=habilidades"
```
```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 23:15:50 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lucas Ferreira da Silva Filho | Perfil do Estudante</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-claro">


<header>
    <h1>Lucas Ferreira da Silva Filho</h1>
    <p>Análise e Desenvolvimento de Sistemas</p>
    <nav>
        <a href="?pagina=inicio" >Início</a>
        <a href="?pagina=habilidades" class="ativo" aria-current="page">Habilidades</a>
        <a href="?pagina=projetos" >Projetos</a>
         <a class="botao-tema" href="?tema=escuro" title="Mudar para tema escuro" aria-label="Mudar para tema escuro">
            <svg class="icone-lua" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="icone-sol" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="bolinha"></span>
        </a>
    </nav>
</header>


<main>
    
        <h2>Habilidades</h2>
        <p>Total de habilidades: <strong>7</strong></p>
        <p>HTML, CSS, PostgreSQL, JavaScript, Python, Git, Git hub, Docker</p>

    </main>


<footer>
    <p>Tema atual: claro</p>
    <p><a href="?formato=json">Ver em JSON</a></p>
    <p>&copy; 2026 Lucas Ferreira da Silva Filho</p>
</footer>

</body>
</html>
```

| Parte da saída | Explicação |
|---|---|
| `HTTP/1.1 200 OK` | Linha de status: protocolo, código 200 (deu certo) e o texto. Não chamei `http_response_code`, então vale o padrão do PHP, 200. |
| `Host`, `Date`, `Connection`, `X-Powered-By`, `Content-type` | Cabeçalhos da resposta. Cada um é explicado na tabela do item 3.2. |
| `<body class="tema-claro">` | Sem `?tema=` na URL e sem cookie, `$tema` fica com o padrão `'claro'`. |
| Item "Habilidades" do menu com `class="ativo"` | `$menuAtivo` vale `habilidades`, então só esse link recebe a classe que o pinta de verde. |
| `<h2>Habilidades</h2>` | Ramo `elseif ($pagina === 'habilidades')` do HTML. |
| `Total de habilidades: <strong>7</strong>` | Vem de `count($perfil['habilidades'])`, que conta os itens do array (no meu caso, 7). |
| Linha com as habilidades separadas por vírgula | Vem de `implode(', ', $perfil['habilidades'])`, que junta os itens em um texto só. |
| Rodapé | Mostra o tema atual, o link para a versão JSON e o ano (`date('Y')`). |

### 3.2 Uma página que não existe

#### Projeto inexistente

```
curl.exe -i "http://localhost:8000/?pagina=projeto&id=99"
```

```
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Mon, 12 Oct 2026 21:59:54 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
...
<main>
    
        <h2>Projeto não encontrado</h2>
        <p>Não existe projeto com esse número.</p>
        <p><a href="?pagina=projetos">&larr; Voltar para projetos</a></p>

    </main>
...
</html>
```

| Linha da saída | Explicação |
|---|---|
| `HTTP/1.1 404 Not Found` | Linha de status: protocolo, código 404 e texto. Vem de `http_response_code(404)`, chamado no topo do arquivo porque `$pagina` é `projeto` e `isset($projetos[99])` é falso (o id 99 não existe). |
| `Host: localhost:8000` | Endereço do servidor que respondeu. O servidor embutido do PHP adiciona sozinho. |
| `Date: ...` | Data e hora da resposta, em GMT. Também adicionada pelo servidor. |
| `Connection: close` | O servidor fecha a conexão depois de responder. |
| `X-Powered-By: PHP/8.4.25` | O PHP informa a própria versão automaticamente. |
| `Content-type: text/html; charset=UTF-8` | Tipo do conteúdo. É o padrão do PHP, porque nessa rota não chamei `header()`. |
| (linha em branco) | Separa os cabeçalhos do corpo da resposta. |
| `<!DOCTYPE html>` e `<html lang="pt-BR">` | Começo do HTML. Só sai depois que toda a lógica PHP do topo já rodou. |
| `<h2>Projeto não encontrado</h2>` e `<p>Não existe projeto com esse número.</p>` | Ramo `elseif ($pagina === 'projeto')` do HTML. Chega nele porque o ramo anterior (`projeto` com `isset` verdadeiro) falhou. |
| `<a href="?pagina=projetos">&larr; Voltar...` | Link para voltar à lista. `&larr;` é a seta para a esquerda escrita como entidade HTML. |

#### Página inexistente

```
curl.exe -i "http://localhost:8000/?pagina=xyz"
```

```
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Mon, 12 Oct 2026 22:04:27 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
...
<main>
    
        <h2>Página não encontrada</h2>
        <p>A página que você pediu não existe.</p>
        <p><a href="?pagina=inicio">&larr; Voltar ao início</a></p>

    </main>
...
</html>
```

| Linha da saída | Explicação |
|---|---|
| `HTTP/1.1 404 Not Found` | `xyz` não é nenhuma das páginas conhecidas, então a lógica do topo cai no `else` e chama `http_response_code(404)`. |
| Cabeçalhos (`Host` até `Content-type`) | Os mesmos explicados acima. |
| `<h2>Página não encontrada</h2>` | Ramo `<?php else: ?>` do HTML, que pega tudo o que não bateu com nenhuma página. |
| `<a href="?pagina=inicio">&larr; Voltar ao início</a>` | Link para sair da página de erro. |

O status 404 é importante porque o navegador (e buscadores) ficam sabendo que a página não existe. Se eu só mostrasse a mensagem, o status continuaria 200 e a resposta mentiria.

### 3.3 Troca de tema

```
curl.exe -i "http://localhost:8000/?tema=escuro"
```

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 22:15:42 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: tema=escuro; expires=Wed, 11 Nov 2026 22:15:42 GMT; Max-Age=2592000; path=/
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
...
<body class="tema-escuro">
...
<footer>
    <p>Tema atual: escuro</p>
...
</footer>
```

| Linha da saída | Explicação |
|---|---|
| `HTTP/1.1 200 OK` | A página inicial existe e o tema é válido, então o status continua 200. |
| `Set-Cookie: tema=escuro; ...` | O servidor manda o navegador guardar um cookie. `tema=escuro` é o nome e o valor. |
| `expires=Wed, 11 Nov 2026 ...` | Data em que o cookie vence: 30 dias depois do pedido. Vem de `time() + 60 * 60 * 24 * 30`. |
| `Max-Age=2592000` | A mesma validade, em segundos: 60 x 60 x 24 x 30 = 2.592.000. |
| `path=/` | O cookie vale para o site inteiro, não só para a pasta atual. É o último argumento do `setcookie`. |
| `<body class="tema-escuro">` | O tema vira uma classe do `<body>`, e o `estilo.css` usa essa classe para trocar as cores. |
| `Tema atual: escuro` | O rodapé mostra o valor de `$tema`, passado por `htmlspecialchars`. |

**Por que a URL tem prioridade sobre o cookie?** O cookie gravado com `setcookie` **não aparece em `$_COOKIE` na mesma requisição**: ele só volta do navegador na próxima. Na requisição `?tema=escuro` o `$_COOKIE['tema']` ainda tem o valor antigo (ou não existe). Por isso a linha `$tema = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';` olha primeiro a URL, depois o cookie e por último o padrão. Se o cookie viesse primeiro, a escolha nova só apareceria na visita seguinte.

**Memória entre visitas:** no navegador, abrir `?tema=escuro` e depois abrir `/` (sem parâmetro) continua mostrando o tema escuro. Dessa vez o navegador manda o cookie de volta, `$_GET['tema']` não existe e o `??` usa `$_COOKIE['tema']`. Por isso o `setcookie` só é chamado quando o tema veio pela URL.

**Segurança:** `?tema=<script>` mostra o tema claro e não executa nada. O `if ($tema !== 'claro' && $tema !== 'escuro')` transforma qualquer valor fora dessas duas opções em `'claro'`, e o valor ainda passa por `htmlspecialchars` antes de ir para o `class` do `<body>`.

### 3.4 API em JSON

```
curl.exe -i "http://localhost:8000/?formato=json"
```

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 22:23:04 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8

{
    "perfil": {
        "nome": "Lucas Ferreira da Silva Filho",
        "curso": "Análise e Desenvolvimento de Sistemas",
        "campus": "IFCE Campus Boa Viagem",
        "cidade": "Boa viagem - CE",
        ...
        "habilidades": [
            "HTML",
            "CSS",
            ...
        ]
    },
    "projetos": {
        "1": {
            "titulo": "VANTAGE",
            ...
            "tecnologias": " FastAPI, Python, PostgreSQL, Docker, Git\/GitHub"
        },
        ...
    }
}
```

| Linha da saída | Explicação |
|---|---|
| `Content-Type: application/json; charset=utf-8` | Vem do `header()` que chamo antes de qualquer saída. Avisa que o corpo é JSON e não HTML. Repare que aqui o cabeçalho aparece com `T` maiúsculo: é o que eu escrevi no código, e não o padrão do PHP. |
| (linha em branco) | Separa cabeçalhos e corpo. |
| `{` logo na primeira linha do corpo | Nenhum HTML foi enviado. O `exit` logo depois do `echo json_encode(...)` encerra o script antes do `<!DOCTYPE html>`. Se não tivesse o `exit`, o HTML iria junto e o JSON ficaria inválido. |
| Identação de 4 espaços e uma chave por linha | É o efeito de `JSON_PRETTY_PRINT`. |
| `"Análise"` com acento | É o efeito de `JSON_UNESCAPED_UNICODE`. Sem ela, o PHP escreveria `Análise`. |
| `"perfil"` e `"projetos"` | O array que passei ao `json_encode`: `['perfil' => $perfil, 'projetos' => $projetos]`. |
| `"1": { ... }` | Os projetos aparecem com chaves `"1"`, `"2"`, `"3"` (um objeto, não uma lista) porque o array `$projetos` começa no número 1 e não no 0. |
| `"habilidades": [ ... ]` | Aqui é uma lista (colchetes), porque o array `habilidades` tem índices 0, 1, 2... |
| `Git\/GitHub` | O `json_encode` escreve a barra `/` como `\/`. É JSON válido, e quem lê o JSON recebe `Git/GitHub` normalmente. |

### 3.5 Log do servidor

O Terminal 1 (onde roda o `php -S`) mostra uma linha para cada coisa que acontece.

```
[Mon Oct 12 20:15:19 2026] PHP 8.4.25 Development Server (http://localhost:8000) started
[Mon Oct 12 20:15:50 2026] [::1]:50322 Accepted
[Mon Oct 12 20:15:50 2026] [::1]:50322 [200]: GET /?pagina=habilidades
[Mon Oct 12 20:15:50 2026] [::1]:50322 Closing
[Mon Oct 12 20:23:17 2026] [::1]:54673 Accepted
[Mon Oct 12 20:23:17 2026] [::1]:54673 [404]: GET /?pagina=xyz
[Mon Oct 12 20:23:17 2026] [::1]:54673 Closing
```

| Linha do log | Explicação |
|---|---|
| `[...] PHP 8.4.25 Development Server (http://localhost:8000) started` | O servidor subiu. Mostra a versão do PHP e o endereço onde ele atende. É a linha que aparece quando rodo o `php -S`. |
| `[Mon Oct 12 ...] [::1]:PORTA Accepted` | Uma conexão nova chegou. Vem a data e a hora, o endereço de quem pediu (`[::1]` é o localhost em IPv6) e a porta temporária que o cliente usou. |
| `[...] [::1]:PORTA [200]: GET /?pagina=habilidades` | O pedido já processado: o status que o PHP respondeu, o método (`GET`) e a URL pedida. Nos pedidos inexistentes aparece `[404]`, por exemplo `[404]: GET /?pagina=xyz`. |
| `[...] [::1]:PORTA Closing` | A conexão foi fechada (combina com o `Connection: close` da resposta). |
| `GET /favicon.ico` | Só aparece quando uso o navegador: ele pede o ícone da aba sozinho. O `curl` não faz isso. |

---

## 4. Onde usei cada conceito

| Recurso | Linha(s) | Para que serve no projeto |
|---|---|---|
| Arrays associativos `$perfil` e `$projetos` | 2 e 19 | Guardam todos os dados do site. Os projetos usam o número como chave (1, 2, 3). |
| Array dentro de array (`$perfil['habilidades']`) | 2 (definição) e 117-118 (uso) | Lista de habilidades dentro do perfil. |
| `$_GET['pagina'] ?? 'inicio'` | 60 | Lê a página pedida na query string. Se não vier nada, usa `inicio`. |
| `(int) ($_GET['id'] ?? 0)` | 61 | Converte o id da URL para número inteiro. Texto como `abc` vira 0. |
| `if` / `elseif` / `else` no topo | 60 a 71 | Decide quando responder 404. |
| Sintaxe com dois-pontos no HTML (`<?php if (...): ?>` ... `<?php endif; ?>`) | 104, 114, 120, 134 e 141 | Escolhe o conteúdo da página no meio do HTML. |
| `foreach` | 124 (fecha na 131) | Gera um cartão para cada projeto da lista. |
| `isset($projetos[$id])` | 66 e 134 | Verifica se o projeto existe antes de mostrar os detalhes. |
| `http_response_code(404)` | 67 e 70 | Muda o status da resposta para 404. |
| `$_COOKIE` e `setcookie` | 37 e 44 | Lê o tema guardado e grava o tema escolhido por 30 dias. |
| Operador `??` em cadeia | 37 | Prioridade do tema: URL, depois cookie, depois o padrão. |
| Validação do tema (`!==` com `&&`) | 39 | Só aceita `claro` ou `escuro`. |
| `header('Content-Type: ...')` | 51 | Avisa que a resposta da rota JSON é `application/json`. |
| `json_encode` com `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE` | 52 | Transforma `$perfil` e `$projetos` em JSON legível e com acentos. |
| `exit` | 56 | Encerra o script depois do JSON, para não enviar HTML. |
| `implode` | 118 | Junta as habilidades em um texto separado por vírgula. |
| `count` | 117 | Conta quantas habilidades existem. |
| `htmlspecialchars` | 84, 118 e 160 (e em todo texto impresso no HTML) | Protege toda saída de texto no HTML. |
| `date('Y')` | 160 | Mostra o ano atual no rodapé. |
| Operador ternário `? :` (`$outroTema`, `$menuAtivo`) | 47, 73 e 91 a 93 | Escolhe o outro tema para o botão e o item do menu que fica marcado. |
| Classe no `<body>` (`tema-claro` / `tema-escuro`) | 84 | Liga o tema escolhido ao CSS. |
| Variáveis CSS (`--fundo`, `--texto`, `--destaque`...) no `estilo.css` | 8 e 18 (`estilo.css`) | Definem as cores de cada tema em um lugar só. |

---

## 5. Decisões e dificuldades

**Por que a lógica PHP fica toda no topo, antes do HTML.** Cookies, cabeçalhos e o status da resposta (`setcookie`, `header`, `http_response_code`) precisam ser definidos **antes de qualquer saída**. Quando o PHP envia o primeiro caractere de HTML, os cabeçalhos já foram enviados e não dá mais para mudá-los. É o erro `headers already sent` que vimos em aula. Por isso o arquivo é dividido em: dados, tema, rota JSON, escolha da página, e só depois o HTML.

**Por que um único `index.php` com query string.** O enunciado pede um arquivo só. A query string (`?pagina=...`) dá a ele várias "páginas" sem precisar de vários arquivos, e o menu é só um conjunto de links para URLs diferentes.

**Por que validar o tema.** O valor de `?tema=` vem da URL, ou seja, quem controla é o usuário. Esse valor vai parar no atributo `class` do `<body>`. Se eu usasse sem validar, alguém poderia mandar HTML ou JavaScript pela URL (por exemplo `?tema=<script>`). Com a validação, só existem dois valores possíveis. O cookie também passa pela mesma validação, porque o usuário pode alterar um cookie no próprio navegador.

**Por que `htmlspecialchars` em todo texto.** Todo texto que o PHP escreve no HTML passa por essa função, que troca caracteres como `<` e `>` por entidades. Assim, mesmo que um dado tenha uma tag HTML, ela aparece como texto e não é executada.

**Por que converter o `id` para inteiro.** `$_GET['id']` sempre chega como texto. Com `(int)`, valores como `abc` viram 0 e o `isset($projetos[$id])` dá falso, resultando no 404 em vez de um erro.

**Por que o `setcookie` só roda quando o tema veio pela URL.** O cookie só precisa ser gravado quando o usuário faz uma escolha nova. Nas visitas seguintes o valor já está guardado no navegador.

**Extras além do pedido.** O botão de tema é um interruptor (feito só com um link, SVG e CSS, sem JavaScript) e o item do menu da página atual fica preenchido de verde (`$menuAtivo` e a classe `ativo`). Na página de detalhes de um projeto, o item "Projetos" fica marcado.

**Dificuldades.**

- A primeira vez que rodei, a página ficou toda em branco. O servidor respondia 200, mas o `index.php` estava aberto no VS Code **sem salvar** (a bolinha branca na aba), então o servidor lia um arquivo vazio. Aprendi a conferir o salvamento e olhar o log do servidor antes de procurar erro no código.
- Entender que o cookie não aparece em `$_COOKIE` na mesma requisição em que o `setcookie` é chamado. Foi o motivo de a URL ter prioridade sobre o cookie (explicado no item 3.3).
- Manter a ordem certa do arquivo: se um `echo` ou um espaço sai antes do `setcookie` ou do `http_response_code`, dá `headers already sent`.