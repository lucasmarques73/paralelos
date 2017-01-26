using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;

namespace ConsoleApplication4
{
    class Program
    {
        struct mercadoria
        {
            public int codigo, quant;
            public string descricao;
            public double preco_custo, preco_venda;
        }

        static void Main(string[] args)
        {
            mercadoria[] mercadorias = new mercadoria[50];

            int cont = 0;
            int i, opcao;
            string nomeArquivo;

            nomeArquivo = @"C:\Users\Lucas\Desktop\exerc01.txt";

            do
            {
                Console.Clear();
                Console.WriteLine("Escolha uma opcao: \n");
                Console.WriteLine("1 - Cadastrar mercadoria");
                Console.WriteLine("2 - Salvar em arquivo");
                Console.WriteLine("0 - Sair");
                Console.Write("\nOpcao: ");
                opcao = Convert.ToInt16(Console.ReadLine());

                switch (opcao)
                {
                    case 1:
                        Console.WriteLine("\n\nCadastro de Mercadoria");
                        cont++;
                        mercadorias[cont - 1].codigo = cont;
                        Console.WriteLine("Codigo da mercadoria: " + mercadorias[cont - 1].codigo);
                        Console.Write("Descricao: ");
                        mercadorias[cont - 1].descricao = Console.ReadLine();
                        Console.Write("Quantidade: ");
                        mercadorias[cont - 1].quant = Convert.ToInt16(Console.ReadLine());
                        Console.Write("Preco de Custo: ");
                        mercadorias[cont - 1].preco_custo = Convert.ToDouble(Console.ReadLine());
                        Console.Write("Preco de Venda: ");
                        mercadorias[cont - 1].preco_venda = Convert.ToDouble(Console.ReadLine());
                        Console.WriteLine("\nCadastro realizado");
                        Console.WriteLine("Pressione qq tecla p/ continuar");
                        Console.ReadKey();
                        break;
                    case 2:
                        StreamWriter arquivo_out = new StreamWriter(nomeArquivo);      // criando arquivo caso ainda não exista

                        for (i = 0; i < cont; i++)
                        {
                            arquivo_out.WriteLine(mercadorias[i].codigo);
                            arquivo_out.WriteLine(mercadorias[i].descricao);
                            arquivo_out.WriteLine(mercadorias[i].quant);
                            arquivo_out.WriteLine(mercadorias[i].preco_custo);
                            arquivo_out.WriteLine(mercadorias[i].preco_venda);
                        }
                        arquivo_out.Close();
                        Console.WriteLine("Dados salvos com sucesso.");
                        Console.ReadKey();
                        break;
                    case 0:
                        Console.WriteLine("mensagem_saida");
                        break;
                    default: Console.WriteLine("Opcao errada! Tente novamente");
                        break;
                }
            } while (opcao != 0);



            /*
            (");



            Console.Write("Digite seu nome: ");  // lendo dados do usuário para salvar no arquivo
            string nome = Console.ReadLine();
            Console.Write("Telefone: ");
            string fone = Console.ReadLine();

            arquivo_out.WriteLine(nome + " - " + fone);  // salvando os dados lidos no arquivo
            arquivo_out.Close();                         // fechando o arquivo
            */

            Console.ReadKey();
        }
    }
}
