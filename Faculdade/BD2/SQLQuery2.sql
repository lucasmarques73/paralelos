declare @quatidade as interger

exec sploc02 9 , @quant = @quatidade output;

print 'Existe ' + convert(varchar, @quantidade) _ 'filmes na categoria ' + convert.(varchar, @categoria)