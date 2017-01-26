select * from movies
where ORIGINALTITLE like '%museum%'
select * from paises
select * from categorias

--1. selecionar todos os filmes que possuem rating maior que 8, exibindo o nome do filme e o rating, ordenados por rating em ordem descendente

select ORIGINALTITLE, RATING from movies where RATING > 8 order by RATING desc

--2. selecionar todos os filmes da categoria comédia, com rating maior que 8 e que tenham como país EUA, 
--exibindo o nome do filme sua categoria e ordenando pelo nome da categoria

select m.ORIGINALTITLE, c.categoria , p.Pais ,count(m.NUM) as quantidade
from  movies m
inner join  paises p  on COUNTRY = idPais
inner join  categorias c  on CATEGORY = idCategoria
where RATING > 8
and c.Categoria like '%Comédia%'
and p.Pais like '%EUA%'
group by c.Categoria, p.Pais, m.ORIGINALTITLE
order by c.Categoria

--3. selecionar os 10 filmes mais longos cadastrados (com o maior campo length), exibindo o nome do filme e a duração dele
-- (convertendo o campo para horas e minutos), ordenando pelo filme mais longo

select TOP 10
 ORIGINALTITLE, convert(varchar,LENGTH/60) + ':' + convert(varchar, LENGTH % 60) as duracao from movies
order by LENGTH desc

--4. selecionar todos os filmes do país Brasil, exibindo o nome do filme, o tamanho (length) e ano (year), ordenando pelo nome do filme

select ORIGINALTITLE, LENGTH, YEAR from movies
inner join paises on COUNTRY = idPais
where Pais like '%brasil%'
order by ORIGINALTITLE

--5. inserir mais 10 registros na tabela de filmes preenchendo no minimo os campos nome do filme, data de inclusao, num, pais e categoria

select MAX(num) from movies

insert into movies(TRANSLATEDTITLE,NUM,DATEADD,COUNTRY,CATEGORY)
 values ('Tropa de Elite',3234, GETDATE(), 5, 1)


-- 6. montar uma consulta que insira na tabela de filmes a selecao de todos os filmes que foram cadastrados na categoria comédia
