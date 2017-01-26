$(document).ready(function() {

        var urlAtt = "api/apiAtualiza.php";
        var token ="1f3d2gs3f2fg3as2fdg3re2t1we46er45";
        var obj = localStorage.getItem('usuario');
        var usu = jQuery.parseJSON(obj);


        if (obj != null) {
          document.getElementById('userName').value = usu.nome;
          document.getElementById('userLogin').value = usu.login;
        }
        else{
          alert("Logar primeiro");
          localStorage.clear();
          window.location = 'index.html';
        }

        $( "#btnSalvar" ).click(function() {

                var nome = document.getElementById('userName').value;
                var login = document.getElementById('userLogin').value;
                var senha = document.getElementById('userPassword').value;
                var confirmaSenha = document.getElementById('confirmPassword').value;
                var id = usu.id;

                var user = {Id: id, Usuario: login ,Senha: senha, Token: token, Nome: nome};

                if (nome == "" ){
                  alert('O campo Nome está em branco!');
                }
                else if (login == "") {
                  alert('O campo Login está em branco!');
                }
                else if (senha == "") {
                  alert('O campo senha está em branco!');
                }
                else if (confirmaSenha == "") {
                  alert('O campo Confirmar Senha está em branco!');
                }
                else if (senha != confirmaSenha) {
                  alert('As senhas estão diferentes!');
                }
                else {
                          $.ajax({
                                     method:"POST",
                                     url: urlAtt,
                                     data: 'token='+user.Token+'&id='+user.Id+'&name='+user.Nome+'&user='+user.Usuario+'&pass='+user.Senha,
                                     assync: "false"

                           }).done(function(result){
                                     if (result == 'null') {
                                       alert("Não foi possível atualizar o cadastro!");
                                      }
                                     else{
                                        alert("Alterado Com Sucesso!");
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
