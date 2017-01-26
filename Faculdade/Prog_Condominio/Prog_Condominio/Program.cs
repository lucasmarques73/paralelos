using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Prog_Condominio
{
    class Program
    {
        public struct tipo_data
        {
            public int dia, mes, ano;
        }
        public struct tipo_end
        {
            public string rua;
            public int num;
            public int complemento;
        }
        public struct  tipo_morador
        {
            public string nome;
            public string tel;
            public int num_dependentes;
            public int cpf;
            public tipo_end end;
            public tipo_data inicio_moradia;
            public tipo_data fim_moradia;
          
        }
        public struct tipo_condominio
        {
            public string nome;
            public int num_apartamentos;
        }
        static void Main(string[] args)
        {
            int opcao =0;
            tipo_morador[] morador;

            do
            {//Menu Principal
                Console.WriteLine("1 - Cadastros");
                Console.WriteLine("2 - Consultas");
                Console.WriteLine("3 - Calcular Preço do Condominio");
                Console.WriteLine("4 - Sair");
                Console.WriteLine("---------------------------------------");
                Console.WriteLine("Escolha opção -> ");
                opcao = Convert.ToInt16(Console.ReadLine());
                Console.Clear();

                switch (opcao)
                {
                    //Menu de Cadastros
                    case 1:

              do
                 {
                    Console.WriteLine("1 - Cadastro de Condomino");
                    Console.WriteLine("2 - Cadastro de Moradores");
                    Console.WriteLine("3 - Cadastro de Contas");
                    Console.WriteLine("4 - Voltar ao Menu Principal");
                    Console.WriteLine("---------------------------------------");
                    Console.WriteLine("Escolha opção -> ");
                    opcao = Convert.ToInt16(Console.ReadLine());
                    Console.Clear();

                    switch (opcao)
                    {
                        case 1:
                            Console.WriteLine("Opção 1 Cadastro de Condominio");
                            break;

                        case 2:
                            Console.WriteLine("Opção 2 Cadastro de Morador");
                            break;

                        case 3:
                            Console.WriteLine("Opção 3 Cadastro de Contas");
                            break;

                        case 4:
                            Console.WriteLine("Opção 4 Volta ao menu principal");
                            break;

                        default:
                            Console.WriteLine("Opção Inválida");
                            Console.ReadKey();
                            break;

                    }

                        } while (opcao != 4);
                
                break;
                        
                //Menu de Consultas
                    case 2:
                do
                {
                    Console.WriteLine("1 - Consulta de Condomino");
                    Console.WriteLine("2 - Consulta de Moradores");
                    Console.WriteLine("3 - Consulta de Contas");
                    Console.WriteLine("4 - Voltar ao Menu Principal");
                    Console.WriteLine("---------------------------------------");
                    Console.WriteLine("Escolha opção -> ");
                    opcao = Convert.ToInt16(Console.ReadLine());
                    Console.Clear();

                    switch (opcao)
                    {
                        case 1:
                            Console.WriteLine("Opção 1 Consulta de Condominio");
                            break;

                        case 2:
                            Console.WriteLine("Opção 2 Consulta de Morador");
                            break;

                        case 3:
                            Console.WriteLine("Opção 3 Consulta de Contas");
                            break;

                        case 4:
                            Console.WriteLine("Opção 4 Volta ao menu principal");
                            break;

                        default:
                            Console.WriteLine("Opção Inválida");
                            Console.ReadKey();
                            break;

                    }

                } while (opcao != 4);
                break;

                        //Sair do Programa
                    case 4:
                Console.WriteLine("Obrigado por usar nosso sistema;");
                Console.ReadKey();
                Environment.Exit(0);
                break;

                    //Caso opção digitada inválida
                    default:
                Console.WriteLine("Opção Inválida");
                Console.ReadKey();
                break;
            }
                Console.Clear();
            } while (opcao != 4);
        }
    }
}
