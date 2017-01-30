
      $(document).ready(function(){

        var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
              options = {onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
              }
            };

            $('#telefone').mask(maskBehavior, options);

       $("form#formContato").validate({
        rules:{
            mensagem:{          required: true },
            nome:{              required: true },
            telefone:{          required: true },
            email:{             required: true, email: true }
        },
        messages:{
            mensagem:{          required: "Escreva sua mensagem" },
            nome:{              required: "Informe seu nome" },
            telefone:{          required: "Podemos ligar pra você. Informe um telefone." },
            email:{             required: "Informe seu e-mail", email: "Informe um e-mail válido" }
        },
        submitHandler: function(form){
            var dados = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "enviaMail.php",
                data: dados,
                beforeSend: function(){
                    $('div#formSending').removeClass('sucesso');
                    $('div#formSending').removeClass('erro');
                    $('div#formSending').removeClass('envioMultiplo');
                    $('div#formSending').addClass('show');
                    $('header#site').addClass('mt50');
                    $('div#formSending').addClass('enviando');

                },
                success: function(retorno){
                    if(retorno == 'success')
                    {
                        setTimeout(function(){
                            $('div#formSending').removeClass('enviando');
                            $('div#formSending').addClass('sucesso');

                            $("input[name='nome']").val("");
                            $("input[name='email']").val("");
                            $("input[name='telefone']").val("");
                            $("textarea[name='mensagem']").val("");
                        },1000);
                    }
                    else if(retorno == 'erro[1]')
                    {
                        setTimeout(function(){
                            $('div#formSending').removeClass('enviando');
                            $('div#formSending').addClass('envioMultiplo');
                        },1000);
                    }
                    else if(retorno == 'erro[2]' || retorno == 'erro[3]')
                    {
                        setTimeout(function(){
                            $('div#formSending').removeClass('enviando');
                            $('div#formSending').addClass('erro');
                        },1000);
                    }
                },
                error: function(retorno){
                    setTimeout(function(){
                        $('div#formSending').removeClass('enviando');
                        $('div#formSending').addClass('erro');
                    },1000);
                }
            });
        }
    });

      });
