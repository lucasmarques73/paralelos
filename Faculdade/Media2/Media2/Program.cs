using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Media2
{
    class Program
    {
        static void Main(string[] args)
        {
            double nota1, nota2, media;

            Console.WriteLine("Digite a primeira nota do aluno:");
            nota1 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a segunta nota do aluno:");
            nota2 = Convert.ToDouble(Console.ReadLine());

            media = (nota1 + nota2) / 2;

            if (media < 4.0)
            {
                Console.WriteLine("O Aluno foi Reprovado.");
            }
            else
            {
                if (media < 7.0)
                {
                    Console.WriteLine("O Aluno precisa fazer mais um exame.");
                }
                else
                {
                    Console.WriteLine("O Aluno foi Aprovado.");
                }
            
            }

        }
    }
}
