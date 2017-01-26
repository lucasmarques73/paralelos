using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Amigo : Pessoa
    {
        //Váriaveis de Instância
        private string diaDoAniversario;

        //Construtor Padrão
        public Amigo()
        { 
        }


        //Construtor com Paramêtro
        public Amigo(string nome, int idade, char sexo, string diaDoAniversario)
        {
            base.nome = nome;
            base.idade = idade;
            base.sexo = sexo;
            this.diaDoAniversario = diaDoAniversario;
        }
    }
}
