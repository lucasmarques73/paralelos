-- drop procedure sppessoa

Create PROCEDURE spLoc01
AS

select * from movies

RETURN


create PROCEDURE sploc02
		@categoria int,
		@quant int = 0 output
AS
BEGIN

		select @quant = count (num) from movies where CATEGORY = @categoria
END
GO


create PROCEDURE sploc03
		
		@categoria int,
		@valor varchar(100) output


AS
BEGIN

		declare @quant as int