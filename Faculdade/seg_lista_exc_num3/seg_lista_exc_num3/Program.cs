using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace seg_lista_exc_num3
{
    class Program
    {
        public struct tipo_produto
        {
            public int cod;
            public string descricao;
            public double preco;
        }

        static void Main(string[] args)
        {

            int n = 12;
            tipo_produto[] produto = new tipo_produto[n];
            
            //Cadastro dos Produtos
            for (int i = 0; i < n; i++)
            {
                Console.WriteLine("Digite o código do "+(i+1)+"º produto:");
                produto[i].cod = int.Parse(Console.ReadLine());
                Console.WriteLine("Digite a descrição do " + (i + 1) + "º  produto:");
                produto[i].descricao = Console.ReadLine();
                Console.WriteLine("Digite o preço do " + (i + 1) + "º produto:");
                produto[i].preco = double.Parse(Console.ReadLine());
            }

            //Ordenando os produtos de acordo com o código pelo bubblesort

            int j = 1;
            bool troca = true;
            int auxcod;
            double auxpreco;
            string auxdescricao;

            while ((j < n) && (troca))
            {
                troca = false;
                for (int i = 0; i < n - j; i++)
                {
                    if (produto[i].cod > produto[i + 1].cod)
                    {
                        auxcod = produto[i].cod;
                        produto[i].cod = produto[i + 1].cod;
                        produto[i + 1].cod = auxcod;
                        auxdescricao = produto[i].descricao;
                        produto[i].descricao = produto[i + 1].descricao;
                        produto[i + 1].descricao = auxdescricao;
                        auxpreco = produto[i].preco;
                        produto[i].preco = produto[i + 1].preco;
                        produto[i + 1].preco = auxpreco;


                        troca = true;
                    }
                }

                j++;
            }

            //buscando o produto pelo codigo usando busca sequencial


            int buscacod;

            Console.WriteLine("Digite o código do produto procurado:");
            buscacod = int.Parse(Console.ReadLine());

            bool achou = false;

            int w = 0;

            while ((w < n) && (!achou))
            {
                if (buscacod == produto[w].cod)
                {
                    achou = true;
                }
                w++;
            }

            Console.WriteLine("Usando a busca sequencial foi feita "+w+" comparações");


            // //buscando o produto pelo codigo usando busca binaria

            achou = false;

            int cont = 0;
            int inicio = 0;
            int fim = n - 1;
            int meio = (inicio + fim) / 2;

            while ((inicio <= fim) && (!achou))
            {
                if (produto[meio].cod == buscacod)
                {
                    achou = true;
                }
                else
                {
                    if (buscacod < produto[meio].cod)
                    {
                        fim = meio - 1;
                    }
                    else
                    {
                        inicio = meio + 1;
                    }
                    meio = (inicio+fim)/2;
                }
                cont++;
            }

            Console.WriteLine("Usando a busca binária foi feita " + cont + " comparações");



            Console.ReadKey();
        }
    }
}
