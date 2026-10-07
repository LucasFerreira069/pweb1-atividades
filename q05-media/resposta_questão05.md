1. Explique o código original: const, os parênteses no cálculo e o operador ternário.
RESPOSTA:
O código original cria uma constante chamada MEDIA_APROVACAO com valor 7, que representa a média mínima para aprovação. Depois, as variáveis $n1 e $n2 armazenam as notas 6.5 e 8.0. A variável $media calcula a média das duas notas usando os parênteses para somá-las primeiro e depois dividir o resultado por 2. Por fim, o operador ternário verifica se a média é maior ou igual a 7: se for, $situacao recebe "Aprovado"; caso contrário, recebe "Em recuperação". Nesse exemplo, a média é 7.25, então a situação será Aprovado.


2. Modique o código para ler as notas da URL: $n1 = (float) ($_GET['n1'] ?? 0);
e o mesmo para n2.
3. Execute e copie as saídas de:
curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"
curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"

4. Copie as linhas do log dessas duas requisições e explique onde aparecem os valores das
notas.

1
[Wed Oct  7 19:11:09 2026] [::1]:49671 Accepted
[Wed Oct  7 19:11:09 2026] [::1]:52797 Closing
[Wed Oct  7 19:11:19 2026] [::1]:49671 [200]: GET /media.php?n1=5&n2=6
[Wed Oct  7 19:11:19 2026] [::1]:49671 Closing
[Wed Oct  7 19:11:19 2026] [::1]:54086 Accepted
[Wed Oct  7 19:11:19 2026] [::1]:56089 Accepted

2
[Wed Oct  7 19:12:32 2026] [::1]:56089 Closing
[Wed Oct  7 19:12:32 2026] [::1]:60801 Accepted
[Wed Oct  7 19:12:32 2026] [::1]:60801 [200]: GET /media.php?n1=9
[Wed Oct  7 19:12:32 2026] [::1]:60801 Closing
[Wed Oct  7 19:12:32 2026] [::1]:52173 Accepted
[Wed Oct  7 19:12:32 2026] [::1]:49842 Accepted
[Wed Oct  7 19:12:33 2026] [::1]:52173 [200]: GET /media.php?n1=9
[Wed Oct  7 19:12:33 2026] [::1]:52173 Closing

Os valores das notas aparecem na própria URL das requisições, após ?. Na primeira requisição, n1=5 e n2=6 representam as notas 5 e 6. Na segunda, n1=9 representa a primeira nota e, como n2 não foi informado, ele recebe o valor padrão 0.


5. Teste ?n1=abc&n2=10 e explique o resultado.
O valor "abc" não pode ser convertido para um número válido, então ao usar (float) ele resulta em 0. Assim, com n2 = 10, a média fica 5, portanto o aluno fica em recuperação.