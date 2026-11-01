# Projeto v2 - Perfil do Estudante com classes

Programação Web I | Tecnologia em ADS | IFCE Campus Boa Viagem
Atividade Integrada 02 - Versão 2
Estudante: Lucas Ferreira da Silva Filho

Na versão 1 os dados do perfil ficavam em arrays associativos. Nesta versão reescrevi o mesmo projeto com **classes**: `Projeto` e `Perfil`. Para quem visita o site nada muda (mesmas páginas, mesmo tema com cookie, mesmo 404 e a mesma API em JSON). O que muda é o código por dentro: os dados ficam dentro de objetos, com atributos `private`, validação e getters.

**Como executar** (dentro da pasta `projeto/v2`):

```
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

## 1. As classes

### Classe `Projeto`

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$titulo` | `string` | `private` |
| `$descricao` | `string` | `private` |
| `$tecnologias` | `string` | `private` |

| Método | O que faz |
|---|---|
| `__construct(string $titulo, string $descricao, string $tecnologias)` | Recebe os três valores. Se `trim($titulo) === ''`, lança `Exception('O projeto precisa de um título')` e o objeto não é criado. Se estiver tudo certo, guarda os valores nos atributos. |
| `getTitulo(): string` | Devolve o título. |
| `getDescricao(): string` | Devolve a descrição. |
| `getTecnologias(): string` | Devolve as tecnologias. |
| `paraArray(): array` | Devolve os três dados em um array associativo (`titulo`, `descricao`, `tecnologias`), pronto para o `json_encode`. |

### Classe `Perfil`

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$nome` | `string` | `private` |
| `$curso` | `string` | `private` |
| `$campus` | `string` | `private` |
| `$cidade` | `string` | `private` |
| `$apresentacao` | `string` | `private` |
| `$habilidades` | `array` | `private` |
| `$projetos` | `array` (começa vazio: `[]`) | `private` |

| Método | O que faz |
|---|---|
| `__construct(string $nome, string $curso, string $campus, string $cidade, string $apresentacao, array $habilidades)` | Recebe tudo, menos os projetos. Se `count($habilidades) < 5`, lança `Exception('O perfil precisa de pelo menos 5 habilidades')`. Senão, guarda os valores. |
| `adicionarProjeto(Projeto $projeto): void` | Guarda o projeto na lista, numerando a partir de 1: `$this->projetos[count($this->projetos) + 1] = $projeto;`. O tipo `Projeto` recusa qualquer outra coisa. |
| `getProjeto(int $id): Projeto` | Devolve o projeto com aquele número. Se ele não existir, lança `Exception('Projeto não encontrado')`. |
| `getNome()`, `getCurso()`, `getCampus()`, `getCidade()`, `getApresentacao()` | Devolvem cada atributo em texto (`string`). |
| `getHabilidades(): array` | Devolve a lista de habilidades. |
| `getProjetos(): array` | Devolve a lista de projetos (objetos `Projeto`, com chaves 1, 2, 3...). |
| `paraArray(): array` | Devolve todos os dados em um array. Cada projeto é convertido pelo seu próprio `paraArray()`. |

---

## 2. Antes e depois

### 2.1 O 404 do projeto

**Antes (v1):** o `isset` ficava em dois lugares, no topo (para o status) e no HTML (para escolher o que mostrar), e o HTML lia o array direto.

```php
// topo
} elseif ($pagina === 'projeto') {
    if (!isset($projetos[$id])) {
        http_response_code(404);
    }
}

// HTML
<?php elseif ($pagina === 'projeto' && isset($projetos[$id])): ?>
    <h2><?= htmlspecialchars($projetos[$id]['titulo']) ?></h2>
```

**Depois (v2):** quem sabe se o projeto existe é o `Perfil`. O topo só trata o resultado com `try/catch`.

```php
// topo
} elseif ($pagina === 'projeto') {
    try {
        $projetoAtual = $perfil->getProjeto($id);
        $titulo = $projetoAtual->getTitulo();
    } catch (Exception $e) {
        http_response_code(404);
        $pagina = 'nao-encontrado';
        $titulo = $e->getMessage();
    }
}

// HTML
<?php elseif ($pagina === 'projeto'): ?>
    <h2><?= htmlspecialchars($titulo) ?></h2>
```

**O que mudou e o que melhorou:**

- A regra "esse projeto existe?" agora está em **um lugar só** (o `getProjeto`). Na v1 o `isset` era repetido no topo e no HTML.
- A mensagem "Projeto não encontrado" vem do `throw` da classe e é mostrada no `<h2>` pelo `$e->getMessage()`, em vez de ser escrita à mão no HTML.
- O `catch` troca `$pagina` para `nao-encontrado`, e é isso que faz o HTML cair no ramo certo. O status 404 continua sendo definido no topo, antes de qualquer HTML.

### 2.2 A página de projetos

**Antes (v1):**

```php
<?php foreach ($projetos as $id => $projeto): ?>
    <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
```

**Depois (v2):**

```php
<?php foreach ($perfil->getProjetos() as $id => $projeto): ?>
    <h3><?= htmlspecialchars($projeto->getTitulo()) ?></h3>
```

**O que mudou e o que melhorou:**

- Uma chave digitada errada no array (`$projeto['titullo']`) só gera um aviso e um valor vazio, e a página continua. Um método digitado errado (`getTitullo()`) dá `Fatal error: Call to undefined method` na hora. O erro aparece logo, em vez de escondido.
- Todo projeto da lista **tem título**, porque o construtor não deixa criar um sem. Na v1 nada impedia um projeto sem título.
- O `foreach` anda sobre `$perfil->getProjetos()`. Se eu adicionar um quarto projeto com `adicionarProjeto`, ele aparece na lista, nos detalhes (`id=4`) e no JSON sem mudar o HTML.

---

## 3. As classes se recusam

Fiz dois testes para ver as classes recusando dados inválidos. Em cada um, alterei temporariamente o `index.php`, copiei a mensagem e desfiz a alteração.

### 3.1 Projeto sem título

Troquei o título `'VANTAGE'` por `''`:

```
Fatal error: Uncaught Exception: O projeto precisa de um título in C:\Users\lucas\Documents\pweb1-atividades\projeto\v2\index.php:12
```

| Parte da mensagem | Explicação |
|---|---|
| `Uncaught Exception: O projeto precisa de um título` | É a mensagem do `throw new Exception(...)` do construtor da classe `Projeto`. "Uncaught" quer dizer que nenhum `try/catch` pegou a exceção, então o PHP parou com `Fatal error`. |
| `index.php:12` | A linha do `throw`, dentro do construtor de `Projeto`. |
| `Projeto->__construct('', ...)` (no *stack trace*, a lista de quem chamou quem) | Mostra que o `new Projeto('', ...)` foi quem chamou o construtor, com o título vazio no primeiro argumento. |

**Por que o objeto não chegou a existir:** o `if (trim($titulo) === '')` e o `throw` ficam **antes** das atribuições `$this->titulo = ...`. Quando o `throw` roda, o construtor é interrompido e o `new` não devolve objeto nenhum. Não existe um `Projeto` "pela metade", e por isso nenhuma parte do site chega a receber um projeto sem título.

### 3.2 Perfil com menos de 5 habilidades

Deixei só 4 habilidades na lista do `new Perfil(...)`:

```
Fatal error: Uncaught Exception: O perfil precisa de pelo menos 5 habilidades in C:\Users\lucas\Documents\pweb1-atividades\projeto\v2\index.php:65
```

| Parte da mensagem | Explicação |
|---|---|
| `Uncaught Exception: O perfil precisa de pelo menos 5 habilidades` | Mensagem do `throw` do construtor da classe `Perfil`, disparado quando `count($habilidades) < 5`. |
| `index.php:65` | A linha do `throw`, dentro do construtor de `Perfil`. |
| `Perfil->__construct('Lucas Ferreira ...', ..., Array)` (no *stack trace*) | Mostra o `new Perfil(...)` que chamou o construtor. O último argumento (`Array`) é a lista de habilidades com 4 itens. |

**Por que o objeto não chegou a existir:** o mesmo motivo do teste anterior. O `throw` acontece antes das atribuições. Sem objeto `$perfil`, o resto do arquivo nem chega a rodar, e nenhuma página é montada com um perfil inválido.

---

## 4. Saídas do terminal

Terminal 1 (servidor), dentro de `projeto/v2`:

```
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

Terminal 2 (pedidos). Uso `curl.exe -i`, que mostra os **cabeçalhos** e depois o **corpo**. Nos trechos, `...` marca partes repetidas em toda página (a parte de cima do HTML, o menu e o rodapé).

### 4.1 Um projeto que existe

```
curl.exe -i "http://localhost:8000/?pagina=projeto&id=2"
```
```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 01 Nov 2026 21:57:13 GMT
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
        <a href="?pagina=habilidades" >Habilidades</a>
        <a href="?pagina=projetos" class="ativo" aria-current="page">Projetos</a>
         <a class="botao-tema" href="?tema=escuro" title="Mudar para tema escuro" aria-label="Mudar para tema escuro">
            <svg class="icone-lua" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="icone-sol" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="bolinha"></span>
        </a>
    </nav>
</header>


<main>
    
        <h2>Estoque-app</h2>
        <p>Sistema web voltado para pequenos comércios, com o objetivo de ter um controle de estoque.</p>
        <p><strong>Tecnologias:</strong> Node.js, JWT, SQLite, Git/GitHub</p>
        <p><a href="?pagina=projetos">&larr; Voltar para projetos</a></p>

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
| `HTTP/1.1 200 OK` | O projeto 2 existe, então o `try` funcionou e nada mudou o status. Vale o padrão do PHP, 200. |
| Cabeçalhos (`Host`, `Date`, `Connection`, `X-Powered-By`, `Content-type`) | Adicionados pelo servidor embutido e pelo PHP. O `Content-type` é `text/html` porque nessa rota não chamei `header()`. |
| Item "Projetos" do menu com `class="ativo"` | `$menuAtivo` vale `projetos`, porque os detalhes de um projeto marcam o menu "Projetos". |
| `<h2>Estoque-app</h2>` | Vem do `$titulo`, que o `try` preencheu com `$projetoAtual->getTitulo()`. |
| Descrição e `Tecnologias:` | Vêm de `$projetoAtual->getDescricao()` e `$projetoAtual->getTecnologias()`, sempre dentro do `htmlspecialchars`. |

### 4.2 Um projeto que não existe

```
curl.exe -i "http://localhost:8000/?pagina=projeto&id=99"
```

```
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Sun, 01 Nov 2026 22:00:10 GMT
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
        <a href="?pagina=habilidades" >Habilidades</a>
        <a href="?pagina=projetos" class="ativo" aria-current="page">Projetos</a>
         <a class="botao-tema" href="?tema=escuro" title="Mudar para tema escuro" aria-label="Mudar para tema escuro">
            <svg class="icone-lua" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="icone-sol" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="bolinha"></span>
        </a>
    </nav>
</header>


<main>
    
        <h2>Projeto não encontrado</h2>
        <p>Não existe projeto com esse número.</p>
        <p><a href="?pagina=projetos">&larr; Voltar para projetos</a></p>

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
| `HTTP/1.1 404 Not Found` | O `getProjeto(99)` lançou a exceção, o `catch` pegou e chamou `http_response_code(404)`. |
| `<h2>Projeto não encontrado</h2>` | É o `$e->getMessage()`, ou seja, o texto do `throw new Exception('Projeto não encontrado')` da classe `Perfil`. |
| `Não existe projeto com esse número.` | Texto fixo do ramo `nao-encontrado` do HTML. |
| Item "Projetos" do menu com `class="ativo"` | O `$menuAtivo` é calculado **antes** do `if`, então o `catch` mudar `$pagina` para `nao-encontrado` não afeta o menu. |

O status 404 é definido antes de qualquer HTML sair. Se ele fosse chamado depois, daria o erro `headers already sent`.

### 4.3 A API em JSON

```
curl.exe -i "http://localhost:8000/?formato=json"
```


```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 01 Nov 2026 22:01:12 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8

{
    "nome": "Lucas Ferreira da Silva Filho",
    "curso": "Análise e Desenvolvimento de Sistemas",
    "campus": "IFCE Campus Boa Viagem",
    "cidade": "Boa viagem - CE",
    "apresentacao": "Olá! Meu nome é Lucas, sou estudante de Análise e Desenvolvimento de Sistemas. Gosto de programar em Python e JavaScript e estou sempre buscando aprender novas tecnologias eaprimorar minhas habilidades. Meu objetivo é me tornar um desenvolvedor Full Stack",
    "habilidades": [
        "HTML",
        "CSS",
        "PostgreSQL",
        "JavaScript",
        "Python",
        "Git",
        "GitHub",
        "Docker"
    ],
    "projetos": {
        "1": {
            "titulo": "VANTAGE",
            "descricao": "APP para gestão financeira de pequenosempresários.",
            "tecnologias": "FastAPI, Python, PostgreSQL, Docker,Git\/GitHub"
        },
        "2": {
            "titulo": "Estoque-app",
            "descricao": "Sistema web voltado para pequenos comércios, com o objetivo de ter um controle de estoque.",
            "tecnologias": "Node.js, JWT, SQLite, Git\/GitHub"
        },
        "3": {
            "titulo": "Sistema de pedidos para uma pizzaria",
            "descricao": "Sistema de pedidos online para pizzaria, com catálogo de produtos, carrinho de compras e geração automática de pedidos formatados para envio via WhatsApp.",
            "tecnologias": "HTML, CSS, JavaScript, Git\/GitHub"
        }
    }
}
```


| Parte da saída | Explicação |
|---|---|
| `Content-Type: application/json; charset=utf-8` | Vem do `header()` chamado antes de qualquer saída. Avisa que o corpo é JSON e não HTML. |
| `{` logo na primeira linha do corpo | Nenhum HTML foi enviado. O `exit` depois do `echo json_encode(...)` encerra o script antes do `<!DOCTYPE html>`. |
| `"nome"`, `"curso"`, `"campus"`, `"cidade"`, `"apresentacao"`, `"habilidades"`, `"projetos"` | São as chaves do array devolvido por `$perfil->paraArray()`. Os projetos ficam **dentro** do perfil, e na v1 ficavam ao lado. Os dados são os mesmos. |
| `"projetos": { "1": {...}, "2": {...}, "3": {...} }` | Cada projeto foi convertido pelo seu próprio `paraArray()`. As chaves 1, 2 e 3 vêm do `adicionarProjeto`, que numera a partir de 1, e por isso o JSON usa um objeto e não uma lista. |
| `"Análise"` com acento | Efeito de `JSON_UNESCAPED_UNICODE`. Sem ela, o PHP escreveria `An\u00e1lise`. |
| Identação de 4 espaços | Efeito de `JSON_PRETTY_PRINT`. |
| `Git\/GitHub` | O `json_encode` escreve a barra `/` como `\/`. É JSON válido e quem lê recebe `Git/GitHub`. |

---

## 5. Perguntas

**(a) Por que `json_encode($perfil)` devolve `{}`?**

O `json_encode` de um objeto só enxerga os atributos `public`. Os atributos do `Perfil` (e do `Projeto`) são `private`, então de fora do objeto o `json_encode` não vê nenhum e devolve um objeto vazio: `{}`. Por isso as classes têm o método `paraArray()`. Ele roda **dentro** da classe, onde os atributos `private` podem ser lidos, e monta um array comum com os dados. É esse array que o `json_encode` consegue transformar em JSON. Cada projeto também precisa do seu `paraArray()`, senão a lista de projetos sairia como `{}` dentro do JSON.

**(b) Os objetos `$perfil` e `$projeto` continuam na memória do servidor depois que a página é enviada? Por quê?**

Não. A cada pedido, o PHP começa o script do zero: cria os objetos com `new`, usa para montar a resposta e, quando o script termina, libera tudo da memória. O pedido seguinte (mesmo do mesmo usuário) roda o `index.php` de novo e cria objetos novos. Nada fica guardado de um pedido para o outro. É por isso que o tema precisa de **cookie**: o servidor não lembra, então o navegador guarda a escolha e manda de volta a cada pedido.

**(c) Por que os atributos são `private` e não `public`?**

Com `private`, só a própria classe altera os dados. Isso garante as regras que o construtor valida: se `$titulo` fosse `public`, qualquer código poderia fazer `$projeto->titulo = ''` depois da criação e o projeto ficaria sem título, burlando a validação. Os getters deixam ler sem deixar alterar. Também ajuda na manutenção: se eu mudar como um dado é guardado dentro da classe, o resto do código continua funcionando, porque só usa os métodos. E um erro de digitação (`getTitullo()`) aparece na hora como erro fatal, em vez de criar uma chave nova sem avisar.