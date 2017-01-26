using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CalculaDivisao
{
    class Program
    {
        static void Main(string[] args)
        {
            int dividendo, divisor, quociente, resto;

            Console.WriteLine("Coloque o valor do dividendo: ");
            dividendo = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Coloque o valor do divisor: ");
            divisor = Convert.ToInt16(Console.ReadLine());

            quociente = dividendo / divisor;
            resto = dividendo % divisor;

            Console.WriteLine("O valor do dividendo é: "+dividendo);
            Console.WriteLine("O valor do divisor é: " + divisor);
            Console.WriteLine("O valor do quociente é: " + quociente);
            Console.WriteLine("O valor do resto é: " + resto);


        }
    }
}
