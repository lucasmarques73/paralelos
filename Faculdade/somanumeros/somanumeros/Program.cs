using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace somanumeros
{
    class Program
    {
        static void Main(string[] args)
        {

            int[] numeros;
            int resultado;

            numeros = new int[5];

            Console.WriteLine("Digite o 1º número:");
            numeros[0] = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o 2º número:");
            numeros[1] = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o 3º número:");
            numeros[2] = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o 4º número:");
            numeros[3] = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o 5º número:");
            numeros[4] = Convert.ToInt16(Console.ReadLine());

            resultado = numeros[0] + numeros[1] + numeros[2] + numeros[3] + numeros[4] ;  

            Console.WriteLine("Os numero digitados foram:");
            Console.WriteLine(numeros[0] + " + " + numeros[1] + " + " + numeros[2] + " + " + numeros[3] + " + " + numeros[4] + " = " + resultado);
        }
    }
}
