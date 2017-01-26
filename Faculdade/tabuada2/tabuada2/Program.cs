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

            for (num = 1; num <= 10; num++)
            {
                for (cont = 0; cont < 10; cont++)
                {
                    result = num * cont;
                    Console.WriteLine(num + " x " + cont + " = " + result);
                }
            }
        }
    }
}
