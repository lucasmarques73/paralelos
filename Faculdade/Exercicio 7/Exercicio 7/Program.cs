using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_7
{
    class Program
    {
        static void Main(string[] args)
        {
            double[] vetor = new double[10];
            double soma=0;
            int negativo=0,cont;


            //Fase de entrada
            for (cont = 0; cont < 10; cont++)
            {
                Console.Write("Digite o "+ (cont+1)+ "º numero: ");
                vetor[cont] = Convert.ToInt16(Console.ReadLine());

            }
            //Fase de processamento
            for (cont = 0; cont < 10; cont++)
            {
                if (vetor[cont] < 0)
                    negativo++;
                else
                    soma = soma + vetor[cont];
            }

            //Fase de saida
            Console.WriteLine("Existem " + negativo+" numeros negativos.");
            Console.WriteLine("A soma dos numeros positivos é: " + soma);

        }
    }
}
