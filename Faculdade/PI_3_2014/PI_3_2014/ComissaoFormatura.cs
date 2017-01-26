using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PI_3_2014
{
    class ComissaoFormatura : Formando
    {
        private bool comissao;

        public ComissaoFormatura()
        { }

        public ComissaoFormatura(string nome, int cod, string cpf, string telefone1, string telefone2, string email, bool situacao, double multa, double saldo, bool comissao)
        {
            cadastroComissaoFormatura(nome, cod, cpf, telefone1, telefone2, email, situacao, multa, saldo, comissao);
        }

        public void cadastroComissaoFormatura(string nome, int cod, string cpf, string telefone1, string telefone2, string email, bool situacao, double multa, double saldo, bool comissao)
        {

            base.nome = nome;
            base.cod = cod;
            base.cpf = cpf;
            base.telefone1 = telefone1;
            base.telefone2 = telefone2;
            base.email = email;
            base.situacao = situacao;
            base.multa = multa;
            base.saldo = saldo;
            this.comissao = comissao;



        }
    }
}
