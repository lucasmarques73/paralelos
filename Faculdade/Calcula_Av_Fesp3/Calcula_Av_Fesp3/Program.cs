using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Calcula_Av_Fesp
{
    class Program
    {
        public static int ler_nota()
        {
            int situacao = 0;

            Console.Clear();

            Console.WriteLine("Digite a nota da AV1:");
            double av1 = double.Parse(Console.ReadLine());

            Console.WriteLine("Digite a nota da AV2:");
            double av2 = double.Parse(Console.ReadLine());

            Console.WriteLine("Digite a nota da AV3:");
            double av3 = double.Parse(Console.ReadLine());

            double nota_final = (av1 * 0.5) + (av2 * 0.2) + (av3 * 0.3);

            if (nota_final >= 6)
            {
                situacao = 1;
            }
            else if (nota_final >= 4)
            {
                situacao = 2;
            }
            else
            {
                situacao = 3;
            }

            return(situacao);

        }

        public static void turma()
        {
            Console.WriteLine("Tamanho da turma:");
            int tam_turma = int.Parse(Console.ReadLine());

            for (int i = 0; i < tam_turma; i++)
            {
                Console.WriteLine("Nome do Aluno:");
                string nome = Console.ReadLine();

                int md = ler_nota();

                if (md == 1)
                {
                    Console.WriteLine("Aprovado");
                }
                else if (md == 2)
                {
                    Console.WriteLine("Avaliação Final");
                }
                else
                {
                    Console.WriteLine("Reprovado");
                }

            }
        }


        static void Main(string[] args)
        {
            turma();

            Console.ReadKey();
        }
    }
}
