using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio_Matriz_24_06
{
    class Program
    {
        static void Main(string[] args)
        {
            int i, j  ,soma; 
            int Nlinhas = 5; 
            int Ncolunas = 5;
            int[ , ] m = new int[Nlinhas , Ncolunas];
            
            /// Preenchimento da matriz
            
            for (i = 0; i < Nlinhas; i++)
            {
                for (j = 0; j < Ncolunas; j++)
                {
                    Console.WriteLine("Forneça um valor:");
                    m[i,j]= Convert.ToInt16( Console.ReadLine());
                }
            }

            // Soma dos elementos da linha 4

            soma = 0;
            for (j = 0; j < Ncolunas ;j++ )
            {
                soma = soma + m[ 4 , j ];                
            }
            Console.WriteLine("A soma dos elementos da linha 4 é :" + soma);

            

            // Soma dos elementos da coluna 2
            soma = 0;
            for (i = 0; i < Nlinhas; i++)
            {
                soma = soma + m[i, 2];                
            }
            Console.WriteLine("A soma dos elementos da coluna 2 é :" + soma);

            //Soma dos elementos da diagonal principal
            soma = 0;
            for (i = 0; i < Nlinhas; i++)
            {
                soma = soma + m[i, i];
            }
            Console.WriteLine("A soma dos elementos da diagonal principal é : "+ soma);

            //Soma dos elementos da diagonal secundaria
            soma = 0;
            for (i = 0; i < Nlinhas; i++)
            {
                soma = soma + m[i,4- i];
            }
            Console.WriteLine("A soma dos elementos da diagonal secundaria é : " + soma);

            Console.ReadKey();

        }
    }
}
