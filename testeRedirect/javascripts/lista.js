$(document).ready(function() {

              var urlLista = "api/apiLista.php";
              var token ="1f3d2gs3f2fg3as2fdg3re2t1we46er45";


                          $.ajax({
                            method:"POST",
                            url: urlLista,
                            data: 'token='+ token

                          }).done(function(result){
                            var obj = JSON.parse(result);

                            for (var i = 0; i < obj.length; i++) {
                                 $('#lista').append('<div onclick="goUsuario('+obj[i].id+')"class="list-group-item">'+obj[i].nome+'<span class="glyphicon glyphicon-circle-arrow-right"></span></div>');
                          }

                          }).fail(function (erro){
                            alert("Erro: " + erro);
                          });


            });


//<p onclick="goUsuario('+obj[i].id+')"class="list-group-item">'+obj[i].nome+'<span class="glyphicon glyphicon-circle-arrow-right"></span></p>
