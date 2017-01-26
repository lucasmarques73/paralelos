using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace tabuada
{
    class Program
    {
        static void Main(string[] args)
        {
            int num, cont, result;

            Console.WriteLine("Digite o numero ");
            num = Convert.ToInt16(Console.ReadLine());

            for (cont = 0; cont < 10; cont++)
            {
                result = num * cont;
                Console.WriteLine(num+" x "+cont + " = " + result);
            }
        }
    }
}
