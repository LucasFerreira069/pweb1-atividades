1. Execute php q01-do-array-a-classe/livro-array.php e veja a saída.
2. Crie o arquivo livro.php, na mesma pasta, começando com <?php e
declare(strict_types=1);.
3. Escreva a classe Livro com os cinco dados do array como atributos tipados: escolha
o tipo certo para cada um (string, int, float ou bool).
4. Crie dois objetos: o Vidas Secas e outro livro à sua escolha (que tal um autor cearense?).
Mostre os dois com echo, no mesmo formato do array, e faça um var_dump do segundo.
5. Troque temporariamente o ano do primeiro livro por um texto ('1938', com aspas).
Execute, copie o erro e desfaça a alteração.
RESPOSTA:
Fatal error: Uncaught TypeError: Cannot assign string to property Livro::$ano of type int in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q01-do-array-a-classe\livro.php:16 Stack trace: #0 {main} thrown in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q01-do-array-a-classe\livro.php on line 16

O atributo $ano foi declarado como int, mas eu tentei atribuir um texto (string). Com declare(strict_types=1);, essa atribuição não é convertida automaticamente.