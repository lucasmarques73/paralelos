using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace maioridade18
{
    class Program
    {
        static void Main(string[] args)
        {
            int idade;

            Console.WriteLine("Digite sua idade:");
            idade = Convert.ToInt16(Console.ReadLine());

            if (idade >= 18)
            {
                Console.WriteLine("Você é maior de idade.");
            }
            else
            {
                Console.WriteLine("Você é menor de idade.");
            }
        }
    }
}
