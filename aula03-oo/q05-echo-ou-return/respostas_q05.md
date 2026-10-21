1. Execute o código original e copie a saída.
Área: 48 Perímetro: 28 

2. Acrescente temporariamente, no m do arquivo, a linha var_dump($sala->area());.
Execute, copie a saída e desfaça.
Área: 48 Perímetro: 28 Área: 48 NULL

3. Refatore a classe:
 area() e perimetro() passam a devolver um float, sem echo;
 acrescente o atributo string $nome e o método ehQuadrado(): bool;
4. Crie três ambientes do campus: Sala de aula (8 Ö 6), Laboratório (7 Ö 7) e Biblioteca
(12 Ö 9). Coloque os três em um array e, com um foreach, mostre a área de cada um,
se é quadrado ou retângulo, e a área total.

5. Por m, mostre quantos metros de rodapé a biblioteca precisa (o perímetro).

Sala de aula: área 48 m² - Retângulo Laboratório: área 49 m² - Quadrado Biblioteca: área 108 m² - Retângulo Área total: 205 m² Rodapé da biblioteca: 42 metros