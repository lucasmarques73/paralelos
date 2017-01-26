using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace somanumerovetor
{
    class Program
    {
        static void Main(string[] args)
        {
            int tamanho = 5;
            int[] numeros = new int[tamanho];
            int cont, soma = 0;

            // Entrada de Dados

            for (cont=0; cont < tamanho ; cont ++)
            {
                Console.WriteLine("Digite o " + (cont+1 )+ "º número");
                numeros[cont] = Convert.ToInt16(Console.ReadLine());
                soma = numeros[cont] + soma;
            }
            //Apresentaçao do Resultado
            for (cont = 0; cont < tamanho-1; cont++)
            {
                Console.Write(numeros[cont] + " + ");
            }

            Console.WriteLine(numeros[cont]+ " = " + soma);
        }
    }
}
