using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Professor:Funcionario
    {


        //Construtor sem parametro
        public Professor()
        { 
        }

        public Professor(string nome, string sobrenome, double salario)
        {
            base.nome = nome;
            base.sobrenome = sobrenome;
            base.salario = salario;
        }


        //Construtor com parametro
        public Professor(string nome, string sobrenome, int idade, char sexo, double salario)
        {

            base.nome = nome;
            base.sobrenome = sobrenome;
            base.idade = idade;
            base.sexo = sexo;
            base.salario = salario;



        }
        
        public override double getSalarioPrimeiraParcela()
        {

            double primeiraParcela;

            primeiraParcela = salario;

            return primeiraParcela;
        }

        public override double getSalarioSegundaParcela()
        {
            double segundaParcela = 0;
            
            return segundaParcela ;
        }
        

       
    }
}
