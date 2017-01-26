using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace matriz_aleatória
{
    class Program
    {
        static void Main(string[] args)
        {
            int x = 0, y = 0;
            
            Random random = new Random();

            x = int.Parse(Console.ReadLine());
            y = int.Parse(Console.ReadLine());

            int[,] num = new int[x, y];

            for (int i = 0; i < x; i++)
            {
                for (int k = 0; k < y; k++)
                {
                    num[i,k] = random.Next(0,100);
                }
                
            }

            for (int i = 0; i < x; i++)
            {
                for (int k = 0; k < y; k++)
                {
                    Console.WriteLine(num[i,k]);
                }

            }

            Console.ReadLine();

        }
    }
}
