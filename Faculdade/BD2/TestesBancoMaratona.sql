select * from tblEventos

insert into tblEventos (nomeEvento, descricaoEvento, dataEvento, valorInscricao, dataInicioInsc, dataFimInsc, localEvento)
values ('Maratona de Passos', 'descricao da maratona', convert(datetime, '15/09/2014 14:00:00'), 10, convert(date, '04/09/2014 00:00:00'), convert(date, '14/09/2014 10:00:00'), 'Praça da Matriz')

insert into tblEventos (nomeEvento, descricaoEvento, dataEvento, valorInscricao, dataInicioInsc, dataFimInsc, localEvento)
values ('Maratona de Itaú de Minas', 'descricao da maratona', convert(datetime, '20/09/2014 17:00:00'), 25, convert(date, '04/09/2014 00:00:00'), convert(date, '15/09/2014 10:00:00'), 'Praça da Matriz')

select * from tblCategorias

insert into tblCategorias (Categoria, IdadeInicial, IdadeFinal, codEvento) values ('Junior', 0, 5, 1)
insert into tblCategorias (Categoria, IdadeInicial, IdadeFinal, codEvento) values ('Jovem', 6, 10, 1)
insert into tblCategorias (Categoria, IdadeInicial, IdadeFinal, codEvento) values ('Adulto', 11, 60, 1)
insert into tblCategorias (Categoria, IdadeInicial, IdadeFinal, codEvento) values ('Senior', 61, 100, 1)

delete from tblCategorias where codEvento = 1

insert into tblCategorias (Categoria, IdadeInicial, IdadeFinal, codEvento)
select Categoria, IdadeInicial + 10, IdadeFinal + 10, 2 from tblCategorias where codEvento = 1

select * from tblPessoa

update tblPessoa set nome = 'Fulano'
update tblPessoa set nome = nome + ' ' + convert(varchar, codpessoa)

select * from tblInscricao

insert into tblInscricao (codpessoa, codEvento, dtInscricao, vlPago, codCategoria, numInscricao)
values (5, 1, getdate(), 10, 5, '00001')

insert into tblInscricao (codpessoa, codEvento, dtInscricao, vlPago, codCategoria, numInscricao)
values (9, 1, getdate(), 10, 4, '00001')

select codcategoria, count(codinscricao) 
from tblInscricao 
group by codcategoria

select * from tblInscricao
select * from tblTempo

insert into tblTempo (codInscricao, TempoInicio, TempoFinal)
values (1, convert(datetime, '07/09/2014 12:10:00'), convert(datetime, '07/09/2014 14:11:00'))

insert into tblTempo (codInscricao, TempoInicio, TempoFinal)
values (2, convert(datetime, '07/09/2014 12:11:00'), convert(datetime, '07/09/2014 14:15:00'))

insert into tblTempo (codInscricao, TempoInicio, TempoFinal)
values (3, convert(datetime, '07/09/2014 12:09:00'), convert(datetime, '07/09/2014 14:18:00'))

insert into tblTempo (codInscricao, TempoInicio, TempoFinal)
values (4, convert(datetime, '07/09/2014 12:08:00'), convert(datetime, '07/09/2014 14:04:00'))

insert into tblTempo (codInscricao, TempoInicio, TempoFinal)
values (5, convert(datetime, '07/09/2014 12:12:00'), convert(datetime, '07/09/2014 14:06:00'))

select * from tblInscricao
select * from tblTempo

--preciso de uma consulta que, no final, me mostre por categoria o nome 
--do atleta vencedor com o seu tempo (registrado na tabela de chegadas)

--1
select i.codpessoa, i.codcategoria, t.TempoInicio, t.TempoFinal 
from tblInscricao i inner join tbltempo t on i.codInscricao = t.codInscricao
where i.codEvento = 1

--2
select i.codcategoria, i.codpessoa,  
datediff(SECOND, t.TempoInicio, t.TempoFinal) as tempoAtleta
from tblInscricao i inner join tbltempo t on i.codInscricao = t.codInscricao
where i.codEvento = 1

--3
select p.nome, c.IdadeInicial, c.IdadeFinal, t.TempoInicio, t.TempoFinal,
datediff(SECOND, t.TempoInicio, t.TempoFinal) as tempo  
from tblInscricao i inner join tbltempo t on i.codInscricao = t.codInscricao
inner join tblPessoa p on i.codPessoa = p.codPessoa
inner join tblCategorias c on i.codCategoria = c.codCategoria
where datediff(SECOND, t.TempoInicio, t.TempoFinal) in 
(
select  
min(datediff(SECOND, t.TempoInicio, t.TempoFinal)) as tempoAtleta
from tblInscricao i inner join tbltempo t on i.codInscricao = t.codInscricao
where codEvento in (select codEvento ev from tblEventos ev where ev.nomeevento like '%Passos%')
group by i.codcategoria
)
