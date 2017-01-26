using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Maior_Entre_dois
{
    class Program
    {
        static void Main(string[] args)
        {
            int num1, num2;

            Console.WriteLine("Digite o numero 1:");
            num1 = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero 2:");
            num2 = Convert.ToInt16(Console.ReadLine());

            if (num1 > num2)
            {
                Console.WriteLine("O primeiro numero é maior");
            }
            else
            {
                Console.WriteLine("O segundo numero é maior");
            }
        
        }
    }
}
