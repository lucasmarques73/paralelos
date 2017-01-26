using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Divisores
{
    class Program
    {
        static void Main(string[] args)
        {
            int divisor, numero1, numero2;

            Console.WriteLine("Digite um numero inteiro:");
            numero1 = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite um segundo numero inteiro:");
            numero2 = Convert.ToInt16(Console.ReadLine());

            for (divisor = 1; divisor <= numero1 / 2; divisor++)
            {
                if (numero1 % divisor == 0)
                {
                    Console.Write(divisor + " - ");
                }
            }
            Console.WriteLine(numero1);

            for (divisor = 1; divisor <= numero2 / 2; divisor++)
            {
                if (numero2 % divisor == 0)
                {
                    Console.Write(divisor + " - ");
                }
            }
            Console.WriteLine(numero2);

            }
    }
}
