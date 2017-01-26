using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Nota_Aluno_Ex3_22_04
{
    class Program
    {
        static void Main(string[] args)
        {
            double nota1, nota2, nota3, media, maior_nota;

            Console.WriteLine("Digite a primeira nota do aluno:");
            nota1 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a segunda nota do aluno:");
            nota2 = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a terceira nota do aluno:");
            nota3 = Convert.ToDouble(Console.ReadLine());

            media = (nota1 + nota2 + nota3) / 3;

            if (nota1 >= nota2)
            {
                if (nota1 >= nota3)
                {
                    maior_nota = nota1;
                }
                else
                {
                    maior_nota = nota3;
                }
            }
            else
            {
                if (nota2 >= nota3)
                {
                    maior_nota = nota2;
                }
                else
                {
                    maior_nota = nota3;
                }
            }

            Console.WriteLine("A primeira nota do aluno foi: "+nota1);
            Console.WriteLine("A segunda nota do aluno foi: " + nota2);
            Console.WriteLine("A terceira nota do aluno foi: " + nota3);
            Console.WriteLine("A media das notas do aluno foi: " + media);
            Console.WriteLine("A maior nota do aluno foi: " + maior_nota);
        }
    }
}
