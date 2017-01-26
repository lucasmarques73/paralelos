using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_20
{
    class Program
    {
        static void Main(string[] args)
        {
            

            int tamanho=50, cont;
            int[] vetor = new int[tamanho];


            //Fase de entrada
            for (cont = 0; cont < tamanho; cont++)
            {
                Console.Write("Digite o " +(cont+1)+"º valor: ");
                vetor[cont] = Convert.ToInt16(Console.ReadLine());
            }

            //Fase de processamento e saida
            Console.Write("Os numeros positivos são: ");
            for (cont = 0; cont < tamanho; cont++)
            {
                if(vetor[cont]>0)
                    Console.Write(" " +vetor[cont]+" ");
            }

        }
    }
}
