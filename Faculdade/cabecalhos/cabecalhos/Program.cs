using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cabecalhos
{
    class Program
    {
        static void Main(string[] args)
        {
            cabecalho1();
            Console.WriteLine("-------------------------------------------------------");
            Console.WriteLine(" ");
            Console.WriteLine(" ");
            Console.WriteLine(" ");
            Console.WriteLine(" ");
            Console.WriteLine(" ");
            Console.WriteLine(" ");
            cabecalho("FDP");

            Console.ReadKey();
        }

        public static void cabecalho1()
        {
            Console.Clear();
            for (int i = 0; i < 79; i++)
                Console.Write("-");
            Console.WriteLine();
            Console.WriteLine("                        Controle de Estoque");
            for (int i = 0; i < 79; i++)
                Console.Write("-");
        }
        public static void cabecalho(string op)
        {
            int tam, espaco, i;

            Console.Clear();
            Console.Write("|");
            for (i = 1; i < 78; i++)
                Console.Write("-");
            Console.Write("|");
            tam = op.Length;
            espaco = 40 - tam / 2;
            for (i = 0; i < espaco; i++)
            {
                Console.Write(" ");
                if (i == 0)
                    Console.Write("|");
            }
                Console.Write(op);
            
                for (i = (tam+espaco); i < 79; i++)
                {
                    Console.Write(" ");
                    if (i == 77)
                        Console.Write("|");
                }
                        
                Console.Write("|");
            for (i = 1; i < 78; i++)
                Console.Write("-");
            Console.Write("|");
        }
    }
}
