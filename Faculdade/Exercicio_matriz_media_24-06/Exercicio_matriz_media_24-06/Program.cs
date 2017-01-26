using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio_matriz_media_24_06
{
    class Program
    {
        static void Main(string[] args)
        {
            int i, j, media, soma;
            int Nlinhas = 10;
            int Ncolunas = 10;
            int[,] m = new int[Nlinhas, Ncolunas];

            /// Preenchimento da matriz

            for (i = 0; i < Nlinhas; i++)
            {
                for (j = 0; j < Ncolunas; j++)
                {
                    Console.WriteLine("Forneça um valor:");
                    m[i, j] = Convert.ToInt16(Console.ReadLine());
                }
            }

            //Calcular a media dos elementos da diagonal principal
            media = 0;
            soma = 0;
            for (i = 0; i < Nlinhas; i++)
            {
                soma = soma + m[i, i];                
            }

            media = soma / Nlinhas;

            Console.WriteLine("A media dos elementos da diagonal principal é : " + media);

        }
    }
}
