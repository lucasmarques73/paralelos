using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ConsoleApplication8
{
    class Program
    {
        static void Main(string[] args)
        {
            double[,] Matriz = new double[6, 3];
            double maior, menor;
            int LMai, CMai, LMen, CMen, i, j;

            //preenchimento da matriz
            for (i = 0; i < 6; i++)
                for (j = 0; j < 3; j++)
                {
                    Console.Write("Informe um valor: ");
                    Matriz[i, j] = Convert.ToDouble(Console.ReadLine());
                }

            //
            menor = maior = Matriz[0, 0];
            LMai = LMen = CMai = CMen = 0;

            for (i = 0; i < 6; i++)
                for (j = 0; j < 3; j++)
                {
                    if (Matriz[i, j] > maior)
                    {
                        maior = Matriz[i, j];
                        LMai = i;
                        CMai = j;
                    }
                    else if (Matriz[i, j] < menor)
                    {
                        menor = Matriz[i, j];
                        LMen = i;
                        CMen = j;

                    }
                }
            Console.WriteLine("O maior valor é:" + maior);
            Console.WriteLine("Ele esta na linha:" + (LMai + 1));
            Console.WriteLine("Ele esta na coluna:" + (CMai + 1));
            Console.WriteLine("-------------------------------------");
            Console.WriteLine("O maior valor é:" + menor);
            Console.WriteLine("Ele esta na linha:" + (LMen + 1));
            Console.WriteLine("Ele esta na coluna:" + (CMen + 1));
            Console.WriteLine("-------------------------------------");

            Console.ReadKey();
        }
    }
}