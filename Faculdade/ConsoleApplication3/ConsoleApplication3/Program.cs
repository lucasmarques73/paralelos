using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication3
{
    class Program
    {
        static void Main(string[] args)
        {
            double nota1, nota2, nota3, nota4, media;

            Console.WriteLine("Digite a primeira nota do aluno:");
            nota1 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a segunda nota do aluno:");
            nota2 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a terceira nota do aluno:");
            nota3 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a quarta nota do aluno:");
            nota4 = Convert.ToDouble(Console.ReadLine());

            media = (nota1 + nota2 + nota3 + nota4) / 4;

            if (media >= 7)
            {
                Console.WriteLine("O aluno foi aprovado! Sua nota foi: " + media);
            }
            else
            {
                Console.WriteLine("O aluno foi reprovado! Sua nota foi: "+ media);
            }
            }
    }
}
