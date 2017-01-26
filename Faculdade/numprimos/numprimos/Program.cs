using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace numprimos
{
    class Program
    {
        static void Main(string[] args)
        {
            int[] num = new int[10];
            int cont, total_primos;


            for (cont = 0; cont < 10; cont++)
            {
                Console.WriteLine("Digite o " + (cont + 1) + " numero: ");
                num[cont] = Convert.ToInt16(Console.ReadLine());
            }
                total_primos = 0;

                if ((num[cont] % num[cont] == 1) && (num[cont] % 1 == num[cont]))
                {
                    Console.WriteLine(num[cont]+ "é primo");    
                    total_primos = total_primos + 1;
                }
                Console.WriteLine(total_primos);
                
            
            
               
            
        }
    }
}
