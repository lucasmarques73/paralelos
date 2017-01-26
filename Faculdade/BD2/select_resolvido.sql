--1. selecionar todos os paises da tabela de pais, 
--ordenando pelo nome do pais
select * from paises
order by pais 

--2. selecionar todos os filmes da tabela de filmes que 
--possuem como ator alguem que possua nicolas no nome, 
--ordenando pelo nome do filme
select * from movies
where actors like '%nicolas%'
order by originaltitle

--3. selecionar todos os filmes da categoria terror, 
--ordenados pela categoria
select m.originaltitle, m.translatedtitle, c.categoria, p.pais
from 
movies m inner join categorias c on m.category = c.idcategoria
inner join paises p on m.country = p.idpais
where c.categoria like '%Terror%'

--4. selecionar todos os filmes onde o campo pais é 
--igual a brasil
select m.originaltitle, p.pais
from movies m inner join paises p on m.country = p.idpais
where p.pais like '%Brasil%'

--5. contar quantos filmes existem por país, ordenando por pais
--sum, count, avg, min, max
select pais, count(num) as quantidade
from movies inner join paises on movies.country = paises.idpais
group by pais
order by pais

--6. contar quantos filmes existem por categoria, ordenando 
--a lista pela quantidade de filmes de forma descendente
select top 5  categoria, count(num) as quantidade
from movies inner join categorias on movies.category = categorias.idcategoria
group by categoria
order by quantidade desc

--7. montar uma consulta que retorne na primeira coluna o ano da 
--data de inclusao do filme (campo dateadd), na segunda a quantidade 
--de filmes incluidos neste ano
select year(dateadd), count(num)
from movies
group by year(dateadd)

--8. montar uma consulta que exiba na primeira coluna a categoria dos filmes, 
--na segunda a quantidade de filmes por categoria e na terceira o nome do filme 
--mais novo incluido nessa categoria
select categoria, count(num) as quantidade, 
(
select TOP 1 maisnovo.dateadd 
from movies maisnovo
where maisnovo.category = c.idcategoria
order by maisnovo.dateadd desc
) as datamaisnovo
from movies m inner join categorias c on m.category = c.idcategoria
group by idcategoria,categoria



