using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PI_3_2014
{
    class Formando
    {
        protected string nome;
        protected int cod;
        protected string cpf;
        protected string telefone1;
        protected string telefone2;
        protected string email;
        protected bool situacao;
        protected double multa;
        protected double saldo;

        public Formando()
        { }

        public Formando(string nome,int cod, string cpf, string telefone1, string telefone2, string email, bool situacao, double multa,double saldo)
        {
            cadastroFormando(nome, cod, cpf, telefone1, telefone2, email, situacao, multa, saldo);
        }

        public void cadastroFormando(string nome,int cod, string cpf, string telefone1, string telefone2, string email, bool situacao, double multa,double saldo)
        {

            this.nome = nome;
            this.cod =cod ;
            this.cpf = cpf;
            this.telefone1 = telefone1;
            this.telefone2 = telefone2;
            this.email = email;
            this.situacao = situacao;
            this.multa = multa;
            this.saldo = saldo;



        }


    }
}
