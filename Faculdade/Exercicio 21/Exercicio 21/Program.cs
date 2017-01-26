using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_21
{
    class Program
    {
        static void Main(string[] args)
        {
            
            int tamanho=10,cont;
            int[] vet1=new int [tamanho], vet2 = new int [tamanho];
            //Fase de entrada
            for (cont = 0; cont < tamanho; cont++)
            {
                Console.Write("Digite o "+(cont+1)+"º valor: ");
                vet1[cont] = Convert.ToInt16(Console.ReadLine());
            }
            //Fase de processamento
            for (cont = 0; cont < tamanho; cont++)
            {
                if (vet1[cont] == 0)
                    vet2[cont] = 1;
                else
                    vet2[cont] = vet1[cont];
            }
            //Fase de saida
            Console.WriteLine("Primeiro vetor");
               for (cont = 0; cont < tamanho; cont++)
            {
                Console.WriteLine(vet1[cont]);
            }
               Console.WriteLine("Segundo vetor");
            for (cont = 0; cont < tamanho; cont++)
            {
                Console.WriteLine(vet2[cont]);
            }

        }
    }
}
