using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reg_Cliente_Bancario
{
    class Program
    {
        struct Tipo_Conta
        {
            public int num;
            public double saldo;
            public string nome_cliente;
        }

        static void Main(string[] args)
        {

            int opcao, qdadecontas = 0, contas_cadastradas = 0, cont, posicao;
            Tipo_Conta[] contas = new Tipo_Conta[15];
            string nome_cliente;
            double menor_saldo;

            do
            {
                Console.Clear();
                Console.WriteLine("1 - Cadastrar contas:");
                Console.WriteLine("2 - Vizualizar contas do cliente:");
                Console.WriteLine("3 - Excluir conta:");
                Console.WriteLine("4 - Sair:");
                Console.WriteLine("Digite a opção desejada:");
                opcao = Convert.ToInt16(Console.ReadLine());

                if (opcao == 1)
                {
                    Console.WriteLine("Voce ainda pode cadastrar " + (15 - qdadecontas));
                    Console.Write("Quantas contas serão cadastradas:");
                    qdadecontas = Convert.ToInt16(Console.ReadLine());

                    if (qdadecontas + contas_cadastradas <= 15)
                    {
                        for (cont = 1; cont < qdadecontas; cont++)
                        {
                            Console.Write("Digite o numero da Conta:");
                            contas[contas_cadastradas].num = Convert.ToInt16(Console.ReadLine());

                            for ( cont = 0; cont < contas_cadastradas; cont ++)
                                if (contas[contas_cadastradas].num == contas[cont].num)
                                {
                                    Console.WriteLine("Conta Invalida!");
                                    Console.WriteLine("Digite novamente a conta.");
                                    cont = 0;
                                }
                            Console.Write("Digite o saldo da Conta:");
                            contas[contas_cadastradas].saldo = Convert.ToInt16(Console.ReadLine());

                            Console.Write("Digite o nome do Cliente:");
                            contas[contas_cadastradas].nome_cliente = Console.ReadLine();

                            contas_cadastradas++;
                        }
                    }

                    Console.WriteLine("Você não pode cadastrar mais contas!");

                }
                else if (opcao == 2)
                {
                    Console.WriteLine("Qual o nome do cliente:");
                    nome_cliente = Console.ReadLine();

                    for (cont = 0; cont < contas_cadastradas; cont++)
                    {
                        if (contas[cont].nome_cliente == nome_cliente)
                        {
                            Console.WriteLine("O numero da conta: " + contas[cont].num);
                            Console.WriteLine("O saldo da conta: R$" + contas[cont].saldo);
                        }
 
                    }

                }
                else if (opcao == 3)
                {
                    if (contas_cadastradas != 0)
                    {
                        menor_saldo = contas[0].saldo;
                        posicao = 0;

                        for (cont = 1; cont < contas_cadastradas; cont++)
                        {
                            if (contas[cont].saldo < menor_saldo)
                            {
                                menor_saldo = contas[cont].saldo;
                                posicao = cont;
                            }
                        }

                        contas[posicao] = contas[contas_cadastradas - 1];

                        contas_cadastradas--;
                    }
 
                }

            } while (opcao != 4);
            Console.WriteLine("Obrigado!");
        }
    }
}


