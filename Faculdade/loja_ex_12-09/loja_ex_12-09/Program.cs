using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace loja_ex_12_09
{
    class Program
    {
       public struct tipo_loja
        {
           public string descricao;
           public int cod_mercadoria, qt_estoque;
           public double preco_custo, preco_venda;
        }
        static void Main(string[] args)
        {
            string nome_arquivo;
            tipo_loja[] loja = new tipo_loja[50];
            Console.WriteLine("Nome Arquivo:");
            nome_arquivo = Console.ReadLine();

            StreamWriter escrita;

            if (File.Exists(nome_arquivo))
                escrita = new StreamWriter(nome_arquivo, true);
            else escrita = new StreamWriter(nome_arquivo);

            int cont = 0, nummercadoria = 0;
            char nvprod;

            do
            {

                Console.WriteLine("Descrição:");
                loja[cont].descricao = Console.ReadLine();
                Console.WriteLine("Código:");
                loja[cont].cod_mercadoria = Convert.ToInt16(Console.ReadLine());
                Console.WriteLine("Quantidade em Estoque:");
                loja[cont].qt_estoque = Convert.ToInt16(Console.ReadLine());
                Console.WriteLine("Preço de custo:");
                loja[cont].preco_custo = Convert.ToDouble(Console.ReadLine());
                Console.WriteLine("Preço de venda:");
                loja[cont].preco_venda = Convert.ToDouble(Console.ReadLine());

                Console.Clear();
                
                cont++;
                nummercadoria++;

                Console.WriteLine("Novo Produto: S/N");
                nvprod = Convert.ToChar(Console.ReadLine().ToUpper());
                Console.Clear();

            } while (nvprod == 'S');

            for (cont = 0; cont < nummercadoria; cont++)
            {
                Console.WriteLine("Descrição: "+loja[cont].descricao);
                Console.WriteLine("Codigo: "+loja[cont].cod_mercadoria);
                Console.WriteLine("Quantidade em Estoque: "+loja[cont].qt_estoque);
                Console.WriteLine("Preço de custo: "+loja[cont].preco_custo);
                Console.WriteLine("Preço de Venda: "+loja[cont].preco_venda);

                
            }

          for (cont = 0; cont < nummercadoria; cont++)
            {
                escrita.WriteLine("Descrição: "+loja[cont].descricao);
                escrita.WriteLine("Codigo: "+loja[cont].cod_mercadoria);
                escrita.WriteLine("Quantidade em Estoque: "+loja[cont].qt_estoque);
                escrita.WriteLine("Preço de custo: "+loja[cont].preco_custo);
                escrita.WriteLine("Preço de Venda: "+loja[cont].preco_venda);

                
            }

            escrita.Close();

          } 
        }
    }

