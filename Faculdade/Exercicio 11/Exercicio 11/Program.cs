using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Exercicio_11
{
    class Program
    {
        static void Main(string[] args)
        {
            int[] vetor = new int[10], par, impar;
            int cont, contpar=0,contimpar=0;
           

            //Fase de entrada
            for (cont = 0; cont < 10; cont++)
            {
                Console.Write("Digite o " + (cont+1)+ " numero: ");
                vetor[cont] = Convert.ToInt16(Console.ReadLine());
            }

            //Fase de processamento
            for(cont=0; cont < 10; cont++)
            {
                if (vetor[cont] % 2 == 0)
                    contpar++;
                else
                    contimpar++;
            }
            par = new int [contpar];
            impar = new int [contimpar];
            contpar = 0;
            contimpar = 0;
            for (cont = 0; cont < 10; cont++)
            {
                if (vetor[cont] % 2 == 0)
                {
                    par[contpar] = vetor[cont];
                    contpar++;
                }
                else
                {
                    impar[contimpar] = vetor[cont];
                    contimpar++;
                }

            }

            //Fase de saida
            Console.Write("Os numeros pares sao : ");
            for (cont = 0; cont < contpar; cont++)
            {
                Console.Write(" " +par[cont]+" ");
            }
            Console.WriteLine();
            Console.Write("Os numeros impares sao: ");
            for (cont = 0; cont < contimpar; cont++)
            {
                Console.Write(" "+impar[cont]+" ");
            }

        }
    }
}
