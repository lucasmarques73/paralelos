using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace senha17
{
    class Program
    {
        static void Main(string[] args)
        {
            string senha;

            Console.WriteLine("Digite a senha por favor.");
            senha = Console.ReadLine();

            if (senha == "4531")
            {
                Console.WriteLine("Acesso Liberado!");
            }
            else
            {
                Console.WriteLine("Acesso Negado!");
            }
        }
    }
}
