using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace calculadora_rotina_parametro_31_10
{
    class Program
    {
        static void Main(string[] args)
        {
            int n1, n2, cod, resultado;

            Console.WriteLine("Primeiro Numero");
            n1 = int.Parse(Console.ReadLine());
            Console.WriteLine("Segundo Numero");
            n2 = int.Parse(Console.ReadLine());
            Console.WriteLine("Codigo da Operação");
            cod = int.Parse(Console.ReadLine());

            resultado = calc(n1, n2, cod);

            Console.WriteLine("Resultado:"+resultado);

            Console.ReadKey();
        }


        public static int calc(int num1, int num2, int op)
        {
            int result = 0;

                switch(op)
                {
                    case 1:
                        result = num1 + num2;
                        break;
                    case 2:
                        result = num1 - num2;
                        break;
                    case 3:
                        result = num1 * num2;
                        break;
                    case 4:
                        result = num1 / num2;
                        break;
                 }
                return (result);
        }
    }
}
