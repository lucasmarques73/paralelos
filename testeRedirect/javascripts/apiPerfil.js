$(document).ready(function() {

                  var urlPerfil = "api/apiPerfil.php";
                  var token ="1f3d2gs3f2fg3as2fdg3re2t1we46er45";
                  var id =  JSON.parse(sessionStorage.getItem('Id'));

                  $.ajax({
                    method:"POST",
                    url: urlPerfil,
                    data: 'token='+token+'&id='+id,
                    assync: "false"

                  }).done(function(result){

                      var resultado = result.replace("[","");
                      var resultado = resultado.replace("]","");
                      var obj = JSON.parse(resultado);

                      document.getElementById('userName').value = obj.nome;
                      document.getElementById('userLogin').value = obj.login;

                  }).fail(function (erro){
                    alert("Erro: " + erro);
                  });
});
