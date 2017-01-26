SELECT DISTINCT(C.Chegada), Cat.NomeCategoria, P.NOME 
FROM PESSOA P INNER JOIN CATEGORIA Cat ON P.CodCategoria = Cat.CodCategoria
INNER JOIN Corrida C ON P.Codpessoa = C.CodPessoa 
WHERE C.Chegada= ( SELECT MIN(Chegada) FROM Corrida AS CH 
INNER JOIN Pessoa PE ON CH.CodPessoa = PE.Codpessoa
 INNER JOIN Categoria CA ON PE.CodCategoria = CA.CodCategoria
  WHERE PE.CodCategoria = C.CodCategoria )
  
   SELECT * FROM Corrida