using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Atividade_ED2__10_02
{
    class Program
    {
        static void Main(string[] args)
        {
            int cont, tam, elemento;

            tam = 50;
            int[] vetor = new int [tam];
            

            Console.WriteLine("Digite o numero buscado");
            elemento = Convert.ToInt16(Console.ReadLine());

            cont = 0;
            for (int i = 0; i < tam; i++)
            {
                if (elemento == vetor[i])
                {
                    cont++;
                }
            }

            Console.WriteLine("O numero de comparações foi:"+cont);

        }
    }
}
