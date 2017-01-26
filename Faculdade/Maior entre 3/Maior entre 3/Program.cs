using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Maior_entre_3
{
    class Program
    {
        static void Main(string[] args)
        {
            int num1, num2, num3;

            Console.WriteLine("Digite o numero 1:");
            num1 = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero 2:");
            num2 = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero 3:");
            num3 = Convert.ToInt16(Console.ReadLine());

            if (num1 > num2)
            {
                if (num1 > num3)
                {
                    Console.WriteLine("O primeiro numero é maior");
                }
                else
                {
                    Console.WriteLine("O terceiro numero é maior");
                }
            }
            else
            {
                if (num2 > num3)
                {
                    Console.WriteLine("O segundo numero é maior");
                }
                else
                {
                    Console.WriteLine("O terceiro numero é maior");
                }
            }
        }
    }
}
