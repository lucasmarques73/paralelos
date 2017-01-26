using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio1_22_04
{
    class Program
    {
        static void Main(string[] args)
        {
            string nome;
            int x, y;

            Console.Write("Digite um nome: ");
            nome = Console.ReadLine();
          

            x = nome.Length - 1;
            y = nome.Length - 0;

            if (nome[0] == 'A' || nome[0] == 'a' || nome[0] == 'E' || nome[0] == 'e' || nome[0] == 'I' || nome[0] == 'i' || nome[0] == 'O' || nome[0] == 'o' || nome[0] == 'U' || nome[0] == 'u')
            {
                Console.WriteLine("A primeira letra é vogal: " + nome[0]);
            }
            else
            {
                Console.WriteLine("A primeira letra é consoante: " + nome[0]);
            }

            if (nome[x] >= 'A' && nome[x] <= 'Z')
                Console.WriteLine("A ultima letra é maiuscula: " + nome[x]);
            else
            {
                Console.WriteLine("A ultima letra é minuscula: " + nome[x]);
            }
        }
    }
}
