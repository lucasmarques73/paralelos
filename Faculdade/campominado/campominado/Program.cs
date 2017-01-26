using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CampoMinado
{
    class Program
    {
        static void Main(string[] args)
        {

            int[] tabuleiro;
            int[] bombas;
            int cont, vetor;

            Console.Write("Digite o tamanho do Campo Minado: ");
            vetor = Convert.ToInt16(Console.ReadLine());

            tabuleiro = new int[vetor];
            bombas = new int[vetor];

            Console.WriteLine("Digite o '1' se houver bomba, e '0' se não houver bomba!");

            for (cont = 0; cont < vetor; cont++)
            {
                Console.Write("Digite o valor para a " + (cont + 1) + "ª posição : ");
                tabuleiro[cont] = Convert.ToInt16(Console.ReadLine());
            }

            for (cont = 0; cont < vetor; cont++)
            {
                if (cont == 0)
                    bombas[cont] = tabuleiro[cont] + tabuleiro[cont + 1];

                else
                {
                    if (cont == vetor - 1)
                        bombas[cont] = tabuleiro[cont] + tabuleiro[cont - 1];

                    else
                        bombas[cont] = tabuleiro[cont - 1] + tabuleiro[cont] + tabuleiro[cont + 1];


                }
            }


            for (cont = 0; cont < vetor; cont++)
                Console.WriteLine(bombas[cont]);

            Console.ReadKey();








        }
    }
}
