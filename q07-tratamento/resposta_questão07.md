1. Identique os dois problemas do código.
Nome pode não existir, sem ?nome=..., o código tenta acessar $_GET['nome'] mesmo sem esse valor existir.



2. Antes de corrigir: abra saudacao.php no navegador sem parâmetros e copie o log.
Depois execute
curl.exe -s "http://localhost:8000/q07-tratamento/saudacao.php?nome=<b>Oi</b
>"
Copie a saída. Faça um commit.
Olá,



3. Corrija: valor padrão Visitante com ?? e saída com htmlspecialchars.

Se nome existir, usa o nome.
Se não existir, usa "Visitante".


4. Depois de corrigir: repita o curl e compare o corpo das duas respostas.

Olá, <b>Oi</b>
como texto, e não como HTML em negrito.

5. No navegador, teste ?nome=<script>alert('Ataque')</script> antes e depois da cor-
reção (use o histórico de commits ou desfaça a correção temporariamente) e explique o

que é XSS.

Os dois problemas são a possibilidade de $_GET['nome'] não existir e a falta de proteção contra XSS, pois o valor recebido é exibido diretamente no HTML. A correção utiliza ?? 'Visitante' para definir um valor padrão e htmlspecialchars() para escapar caracteres HTML e impedir a execução de código malicioso.