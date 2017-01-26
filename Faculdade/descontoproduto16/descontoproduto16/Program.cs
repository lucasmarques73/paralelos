using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace descontoproduto16
{
    class Program
    {
        static void Main(string[] args)
        {
            string cod_produto;
            double preco_atual, desconto, novo_preco;

            Console.WriteLine("Digite o Codigo do Produto:");
            cod_produto = Console.ReadLine();

            Console.WriteLine("Digite o preço do produto:");
            preco_atual = Convert.ToDouble(Console.ReadLine());

            if (preco_atual < 30)
            {
                Console.WriteLine("O produto " + cod_produto + " não recebe desconto.");
            }
            else
            {
                if (preco_atual <= 100)
                {
                    desconto = preco_atual * 0.1;
                    novo_preco = preco_atual - desconto;
                }
                else
                {
                    desconto = preco_atual * 0.15;
                    novo_preco = preco_atual - desconto;
                }

                Console.WriteLine("O produto " + cod_produto + " recebe o desconto de R$" + desconto + ". E seu novo preço é R$" + novo_preco);
            }                       
        }
    }
}
