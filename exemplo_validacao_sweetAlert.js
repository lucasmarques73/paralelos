//VALIDAÇÂO DO FORMULÁRIO

if($('#cli_cpfcnpj').val() == "")//CAMPO CPF/CNPJ
{
  swal("Ops..","O campo CPF/CNPJ é obrigatório","error");
  setTimeout(function(){
    $('#cli_cpfcnpj').focus();
  }, 2000);
}
else if($('#cli_dsc').val() == "")//CAMPO RAZÃO SOCIAL
{
  swal("Ops..","O campo Razão Social é obrigatório","error");
  setTimeout(function(){
    $('#cli_dsc').focus();
  }, 2000);
}
else if($('#cli_sigla').val() == "")//CAMPO NOME FANTASIA
{
  swal("Ops..","O campo Nome Fantasia é obrigatório","error");
  setTimeout(function(){
    $('#cli_sigla').focus();
  }, 2000);
}
else if($('#cli_cel').val() == "")// CAMPO TELEFONE
{
  swal("Ops..","O campo Telefone é obrigatório","error");
  setTimeout(function(){
    $('#cli_cel').focus();
  }, 2000);
}

else{
  //SUBMIT DO FORMULÁRIO
  $(".form_cli").submit();
}
