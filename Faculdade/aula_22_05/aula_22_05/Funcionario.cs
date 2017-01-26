using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Funcionario : Pessoa
    {
        //Váriaveis de Instância
        protected int matricula;
        protected double salario;

        //Construtor sem parametro
        public Funcionario()
        { 
        }

        public Funcionario(string nome, string sobrenome,double salario)
        {
            base.nome = nome;
            base.sobrenome = sobrenome;
            this.salario = salario;
 
        }


        //Construtor com parametro
        public Funcionario(string nome, string sobrenome, int idade, char sexo, double salario)
        {

            base.nome = nome;
            base.sobrenome = sobrenome;
            base.idade = idade;
            base.sexo = sexo;
            this.salario = salario;



        }


        public void setSalario(int valor)
        {
            if (valor > 0)
            {
                this.salario = valor;
            }

        }

        public virtual double getSalarioPrimeiraParcela()
        {
            double primeiraParcela;

            primeiraParcela = this.salario * 0.6;

            return primeiraParcela;
        }

        public virtual double getSalarioSegundaParcela()
        {
            double segundaParcela;

            segundaParcela = salario * 0.4;

            return segundaParcela;
        }



    }
}
