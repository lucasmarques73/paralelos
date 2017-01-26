using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace investimento15
{
    class Program
    {
        static void Main(string[] args)
        {
            int tipo;
            double valor_investimento, valor_final;

            Console.WriteLine("Pressione 1 para Poupança e 2 para Fundos de Renda Fixa:");
            tipo = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o valor de seu investimento: ");
            valor_investimento = Convert.ToDouble(Console.ReadLine());

            switch (tipo)
            {
                case 1:
                    valor_final = valor_investimento + (valor_investimento * 0.03);
                    Console.WriteLine("Investindo na Poupança o valor do seu investimento mensal será de " + valor_final);
                    break;
                case 2:
                    valor_final = valor_investimento + ( valor_investimento * 0.04);
                    Console.WriteLine("Investindo nos Fundos de Renda Fixa o valor do seu investimento mensal será de "+valor_final);
                    break;
                default:
                    Console.WriteLine("Tipo de investimento incorreto.");
                    break;
            }
        }
    }
}
