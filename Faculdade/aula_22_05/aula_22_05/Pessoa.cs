using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Pessoa
    {

        //Váriaveis de Instância
        protected string nome;
        protected string sobrenome;
        protected int idade;
        protected char sexo;

        //Construtor Padrão
        public Pessoa()
        { 

        }


        public Pessoa(string nome, string sobrenome)
        {
            this.nome = nome;
            this.sobrenome = sobrenome;
        }
        //Construtor com Paramêtro
        public Pessoa(string nome, string sobrenome, int idade, char sexo)
        {
            this.nome = nome;
            this.sobrenome = sobrenome;
            this.idade = idade;
            this.sexo = sexo;
        }

        public string getNomeCompleto()
        {

            string nomeCompleto = nome + " " + sobrenome;

            return nomeCompleto;


        }


    }

   

    


}
