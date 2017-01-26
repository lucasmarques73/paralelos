using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Calcula_Av_Fesp
{
    class Program
    {
        public static double media()
        {
            
            Console.Clear();

            Console.WriteLine("Digite a nota da AV1:");
            double av1 = double.Parse(Console.ReadLine());

            Console.WriteLine("Digite a nota da AV2:");
            double av2 = double.Parse(Console.ReadLine());

            Console.WriteLine("Digite a nota da AV3:");
            double av3 = double.Parse(Console.ReadLine());

            double media = (av1 * 0.5) + (av2 * 0.2) + (av3 * 0.3);

            return (media);
                

        }

        public static void turma()
        {
            Console.WriteLine("Tamanho da turma:");
            int tam_turma = int.Parse(Console.ReadLine());

            for (int i = 0; i < tam_turma; i++)
            {
                Console.WriteLine("Nome do Aluno:");
                string nome = Console.ReadLine();

              double  md = media();

              if (md >= 6)
              {
                  Console.WriteLine("Aprovado");
              }
              else if (md >= 4)
              {
                  Console.WriteLine ("Avaliação Final");
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
