using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_19
{
    class Program
    {
        static void Main(string[] args)
        {
            int[] vet1 = new int[10], vet2 = new int[10], vet3 = new int[10];
            int cont;

           
            //Fase de entrada

            for (cont = 0; cont < 10; cont++)
            {
                Console.Write("Digite o valor do 1º vetor na " + (cont+1) + "ª posição: ");
                vet1[cont] = Convert.ToInt16(Console.ReadLine());
            }
            for (cont = 0; cont < 10; cont++)
            {
                Console.Write("Digite o valor do 2º vetor na " + (cont + 1) + "ª posição: ");
                vet2[cont] = Convert.ToInt16(Console.ReadLine());
            }

            //Fase de processamento

            for (cont = 0; cont < 10; cont++)
            {
                vet3[cont] = vet1[cont] * vet2[cont];
                Console.WriteLine("Produto do vetor 1 com o 2 de indice " +(cont+1)+" é : " + vet3[cont]);
            }



        }
    }
}
