using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MariaeJoão
{
    class Program
    {
        static void Main(string[] args)
        {
            int N, R, Maria=0, Joao=0, cont;

            Console.Write("Dgite o numero de partidas : " );
            N = Convert.ToInt16(Console.ReadLine());

            for (cont = 1; cont <= N; cont++)
            {
                Console.WriteLine("Digite 0 para Maria vencedora e 1 para Joao vencedor.");
                Console.Write("Vencedor da " + cont + "ª partida foi: ");
                R = Convert.ToInt16(Console.ReadLine());

                if (R == 0)
                    Maria++;
                else
                    Joao++;
                
            }

            Console.WriteLine("Maria venceu "+Maria+" vezes e Joao venceu "+Joao+" vezes");
        }
    }
}
