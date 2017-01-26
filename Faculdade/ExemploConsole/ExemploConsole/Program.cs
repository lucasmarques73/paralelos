using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ExemploConsole
{
    class Program
    {
        static void Main(string[] args)
        {
            IntArray b;
            b = new IntArray(2,2);
            b[0, 0] = -3;
            b[0, 1] = 8;
            b[1, 0] = -2;
            b[1, 1] = 1;

            for (int i = 0; i < b.sizeP; i++)
            {
                for (int j = 0; j < b.sizeQ; j++)
                {
                    Console.WriteLine(b[i, j]);
                }

                Console.ReadLine();
            }
        }
    }
}
