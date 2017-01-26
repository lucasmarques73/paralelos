$(document).ready(function() {

              var urlRec = "api/apiRecuperaNovo.php";
              var token ="1f3d2gs3f2fg3as2fdg3re2t1we46er45";

          $( "#btnEntrar" ).click(function() {

                  var login = document.getElementById('userLogin').value;
                  var senha = document.getElementById('userPassword').value;

                  var user = {Usuario: login ,Senha: senha, Token: token};

                  if (login == "") {
                    alert('O campo Login está em branco!');
                  }
                  else if (senha == "") {
                    alert('O campo senha está em branco!');
                  }
                  else {

                          $.ajax({
                            method:"POST",
                            url: urlRec,
                            data: 'token='+user.Token+'&user='+user.Usuario+'&pass='+user.Senha,
                            assync: "false"

                          }).done(function(result){
                            if(result == 'null' || result == 'Erro ao conectar com o banco!')
                            {
                              alert("Login ou Senha Inválidos!");
                            }
                            else{
                              alert("Logado Com Sucesso!");
                              var resultado = result.replace("[","");
                              var resultado = resultado.replace("]","");
                              localStorage.setItem("usuario",resultado);
                              window.location = 'pagina1.html';
                            }
                          }).fail(function (erro){
                            alert("Erro: " + erro);
                          });

                  }
            });


});
