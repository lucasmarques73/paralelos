using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Par_ou_Impar
{
    class Program
    {
        static void Main(string[] args)
        {
            int VMaria, VJoao, soma;
            
            Console.WriteLine("Digite o valor de Maria:");
            VMaria = Convert.ToInt16(Console.ReadLine());
            
            Console.WriteLine("Digite o valor de João:");
            VJoao = Convert.ToInt16(Console.ReadLine());

            soma = VMaria + VJoao;

            if (soma % 2 == 0)
            {
                Console.WriteLine("Maria é a vencedora");
            }
            else
            {
                Console.WriteLine("Joao é o vencedor");
            }
        }
    }
}
