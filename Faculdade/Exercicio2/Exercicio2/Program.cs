using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio2
{
    class Program
    {
        static void Main(string[] args)
        {
            double a, b, c, delta, x1, x2;

            Console.WriteLine("Coloque o primeiro numero da equação: ");
            a = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Coloque o segundo numero da equação: ");
            b = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Coloque o terceiro numero da equação: ");
            c = Convert.ToDouble(Console.ReadLine());

            delta = (b * b) - 4 * a * c;
            x1 = ((-1 * b) + Math.Sqrt(delta)) / (a * a);
            x2 = ((-1 * b) - Math.Sqrt(delta)) / (a * a);

            Console.WriteLine("O valor do Delta é: " + delta );
            Console.WriteLine("O valor do x1 é: " + x1);
            Console.WriteLine("O valor do x2 é: " + x2);
 
        }
    }
}
