using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace verbo
{
    class Program
    {
        static void Main(string[] args)
        {
            string verbo, radical;
            int tamanho;

            Console.WriteLine("Digite o verbo: ");
            verbo = Console.ReadLine();

            tamanho = verbo.Length;

            radical = verbo.Substring(0, tamanho - 2);

            Console.WriteLine("Eu " + radical + "o.");
            Console.WriteLine("Tu " + radical + "as.");
            Console.WriteLine("Ele/Ela " + radical + "a.");
            Console.WriteLine("Nós " + radical + "amos.");
            Console.WriteLine("Vós " + radical + "ais.");
            Console.WriteLine("Eles/Elas " + radical + "am.");
        }
    }
}
