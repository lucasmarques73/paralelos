using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_4
{
    class Program
    {
        static void Main(string[] args)
        {
            int[] vetor = new int[15];
            int cont;

           
            for (cont = 0; cont < 15; cont++)
            {
                Console.Write("Digite o " + (cont+1) + "º numero do vetor: ");
                vetor[cont] = Convert.ToInt16(Console.ReadLine());

            }
            for (cont = 0; cont < 15; cont++)
            {
                if (vetor[cont] == 30)
                {
                    
                    Console.WriteLine("Existe numero igual a 30 na posição: " + (cont+1));
                    
                }

            }



        }
    }
}
