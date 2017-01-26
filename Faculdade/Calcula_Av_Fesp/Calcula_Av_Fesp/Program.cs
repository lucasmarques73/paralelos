using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Calcula_Av_Fesp
{
    class Program
    {
        public static void ler_nota()
        {
            string situacao = " ";

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
                situacao = "Aprovado";
            }
            else if (nota_final >= 4)
            {
                situacao = "Avaliação Final";
            }
            else 
            {
                situacao = "Reprovado";
            }

            Console.WriteLine(situacao);

        }

        public static void turma()
        {
            Console.WriteLine("Tamanho da turma:");
            int tam_turma = int.Parse(Console.ReadLine());

            for (int i = 0; i < tam_turma; i++)
            {
                Console.WriteLine("Nome do Aluno:");
                string nome = Console.ReadLine();

                ler_nota();
            }
        }
    
        
        static void Main(string[] args)
        {
            turma();

            Console.ReadKey();
        }
    }
}
