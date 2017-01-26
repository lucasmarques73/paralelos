using System;
using System.Collections.Generic;
using System.Text;

namespace SistemaBancario
{
    class Program
    {
        struct Tipo_Conta
        {
            public int numConta;
            public double saldo;
            public string nomeCliente;
        }
        static void Main(string[] args)
        {
            Tipo_Conta[] contas = new Tipo_Conta[15];
            int opcao, qdadeContas, ContasCadastradas = 0;

            do
            {
                Console.WriteLine("1. Cadastrar contas.");
                Console.WriteLine("2. Consultar contas de um cliente.");
                Console.WriteLine("3. Excluir conta de menor saldo.");
                Console.WriteLine("4. Sair.");
                Console.WriteLine("----------------------------------");
                Console.Write("Escolha Opção => ");
                opcao = Convert.ToInt16(Console.ReadLine());
                Console.Clear();
                switch (opcao)
                {
                    case 1: //Cadastrando contas...
                        Console.Write("Quantas contas deseja cadastrar? ");
                        qdadeContas = Convert.ToInt16(Console.ReadLine());
                        if (qdadeContas + ContasCadastradas <= 15)
                        {
                            for (int cont = 1; cont <= qdadeContas; cont++)
                            {
                                Console.Clear();
                                Console.WriteLine("Dados da " + cont + "ª conta.");
                                Console.Write("Número da conta => ");
                                contas[ContasCadastradas].numConta = Convert.ToInt16(Console.ReadLine());
                                //Verifica se número da conta já existe
                                int i = 0;
                                while (i < ContasCadastradas)
                                {
                                    if (contas[ContasCadastradas].numConta ==
                                        contas[i].numConta)
                                    {
                                        Console.WriteLine("Conta já existe!!!");
                                        Console.Write("NOVO número da conta => ");
                                        contas[ContasCadastradas].numConta = Convert.ToInt16(Console.ReadLine());
                                        i = 0;
                                    }
                                    else
                                        i++;
                                }
                                Console.Write("Saldo da conta => ");
                                contas[ContasCadastradas].saldo = Convert.ToDouble(Console.ReadLine());
                                Console.Write("Nome do proprietário da conta => ");
                                contas[ContasCadastradas].nomeCliente = Console.ReadLine();
                                ContasCadastradas++;
                            }
                            Console.WriteLine(qdadeContas + " conta(s) cadastrada(s) com sucesso!!!");
                            Console.ReadKey();
                        }
                        else
                        {
                            Console.WriteLine("Quantidade de contas extrapola máximo permitido!");
                            Console.ReadKey();
                        }
                        break;
                    case 2: //Consultando contas de um determinado cliente
                        if (ContasCadastradas != 0)
                        {
                            Console.Write("Informe nome do cliente: ");
                            string clientePesquisado = Console.ReadLine();
                            int ContasEncontradas = 0;
                            Console.Clear();
                            Console.WriteLine("Contas do Cliente: " + clientePesquisado);
                            Console.WriteLine("------------------ ");
                            for (int cont = 0; cont < ContasCadastradas; cont++)
                                if (clientePesquisado == contas[cont].nomeCliente)
                                {
                                    Console.WriteLine("Número da conta: " + contas[cont].numConta);
                                    Console.WriteLine("Saldo da conta: " + contas[cont].saldo);
                                    Console.WriteLine("------------------ ");
                                    ContasEncontradas++;
                                }

                            if (ContasEncontradas == 0)
                                Console.WriteLine("Não há contas para este cliente!!!");
                        }
                        else
                            Console.WriteLine("NÃO HÁ CONTAS CADASTRADAS!!!");
                        Console.ReadKey();
                        break;
                    case 3: //Excluindo conta que possui o menor saldo...
                        if (ContasCadastradas != 0)
                        {
                            double menorSaldo = contas[0].saldo;
                            int posicao = 0;
                            //Procurando conta...
                            for (int cont = 0; cont < ContasCadastradas; cont++)
                                if (contas[cont].saldo < menorSaldo)
                                {
                                    menorSaldo = contas[cont].saldo;
                                    posicao = cont;
                                }
                            Console.WriteLine("Conta a ser excluída:");
                            Console.WriteLine("Número: " + contas[posicao].numConta);
                            Console.WriteLine("Saldo: " + contas[posicao].saldo);
                            Console.WriteLine("Proprietário: " + contas[posicao].nomeCliente);
                            Console.Write("Confirma exclusão (S/N)? ");
                            char exclui = Convert.ToChar(Console.ReadLine().ToUpper());

                            if (exclui == 'S')
                            {
                                //Copiando última conta cadastrada para a posição da conta excluída...
                                contas[posicao] = contas[ContasCadastradas - 1];
                                ContasCadastradas--;
                                Console.WriteLine("Conta excluída com sucesso!!!");
                            }
                            else
                                Console.WriteLine("Conta não excluída!!!");
                        }
                        else
                            Console.WriteLine("NÃO HÁ CONTAS CADASTRADAS!!!");
                        Console.ReadKey();
                        break;
                    case 4:
                        Console.WriteLine("Saindo...Obrigado por usar nosso sistema...");
                        Console.ReadKey();
                        break;
                    default:
                        Console.WriteLine("Opção Inválida!!!");
                        Console.ReadKey();
                        break;

                }
                Console.Clear();
            } while (opcao != 4);
        }
    }
}
