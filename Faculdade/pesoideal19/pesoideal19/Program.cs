using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace pesoideal19
{
    class Program
    {
        static void Main(string[] args)
        {
            double altura, peso_ideal;
            string sexo;

            Console.WriteLine("Digite sua altura em metros e usando virgula para separar:");
            altura = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite seu sexo, sendo H para homem e M para mulher:");
            sexo = Console.ReadLine();

            switch (sexo)
            {
                case "H":
                    peso_ideal = (72.7 * altura) - 58;
                    Console.WriteLine("Seu peso ideal é: " + peso_ideal);
                    break;

                case "M":
                    peso_ideal = (62.1 * altura) - 44.7;
                    Console.WriteLine("Seu peso ideal é: " + peso_ideal);
                    break;
                    
                default:
                    Console.WriteLine("Sexo invalido.");
                    break;
            }

                    
        }
    }
}
