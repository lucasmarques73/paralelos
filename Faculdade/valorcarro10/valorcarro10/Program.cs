using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace valorcarro10
{
    class Program
    {
        static void Main(string[] args)
        {
            double custo_de_fabrica, imposto, distribuidor, valor_final;

            Console.WriteLine("Digite o custo de fabrica do carro:");
            custo_de_fabrica = Convert.ToDouble(Console.ReadLine());

            if (custo_de_fabrica < 12000)
            {
                distribuidor = custo_de_fabrica * 0.05;
                valor_final = custo_de_fabrica + distribuidor;
            }
            else
            {
                if (custo_de_fabrica <= 25000)
                {
                    distribuidor = custo_de_fabrica * 0.1;
                    imposto = custo_de_fabrica * 0.15;
                    valor_final = custo_de_fabrica + distribuidor + imposto;
                }
                else
                {
                    distribuidor = custo_de_fabrica * 0.15;
                    imposto = custo_de_fabrica * 0.20;
                    valor_final = custo_de_fabrica + distribuidor + imposto;
                }
            }

            Console.WriteLine("O valor do carro para o consumidor é R$" + valor_final);
        }
    }
}
