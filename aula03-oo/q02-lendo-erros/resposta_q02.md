1. Execute php q02-lendo-erros/erros.php. Copie toda a saída.
Warning: Undefined variable $nome in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 13

Deprecated: Creation of dynamic property Aluno::$ is deprecated in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 13

Fatal error: Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php:15 Stack trace: #0 {main} thrown in C:\Users\lucas\Documents\pweb1-atividades\aula03-oo\q02-lendo-erros\erros.php on line 15



2. Leia a primeira mensagem: qual linha ela aponta e o que diz? Corrija só esse erro e
execute de novo.
RESPOSTA: Isso acontece porque, dentro do método apresentar(), eu escrevi $nome sem indicar que ele pertence ao objeto.

3. Repita até o programa rodar sem nenhuma mensagem. Para o erro do curso, dê ao aluno
o curso 'ADS'.
4. Registre cada rodada no respostas.md e preencha a tabela da análise.

Respostas — Q02: Lendo erros

Rodada 1

Erro: variável $nome indefinida no método apresentar().

Correção: utilizar $this->nome.

Rodada 2

Erro: variável $nome indefinida na atribuição do atributo.

Correção: utilizar $aluno->nome.

Rodada 3

Erro: atribuição de uma string ao atributo semestre, declarado como int.

Correção: atribuir o número inteiro 3.

Rodada 4

Erro: atributo curso sem valor definido antes da leitura.

Correção: atribuir 'ADS' ao atributo.

Resultado final:
Curso: ADS Sou Carla, do 3o semestre.



