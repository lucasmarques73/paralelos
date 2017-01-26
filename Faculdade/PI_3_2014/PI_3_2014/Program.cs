using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PI_3_2014
{
    public struct tipoFormando
    {
        public string nome;
        public int cod;
        public string cpf;
        public string telefone1;
        public string telefone2;
        public string email;
        public bool situacao;
        public double multa;
        public double saldo;
    }

    class Program
    {
        static void Main(string[] args)
        {
            while (true)
            {
                  try
                {
                    Console.Clear();
                    Console.WriteLine("MENU PRINCIPAL - ESCOLHA UMA OPÇÃO");
                    Console.WriteLine("   1 - FORMANDOS");
                    Console.WriteLine("   2 - COMISSÃO DE FORMATURA");
                    Console.WriteLine("   3 - RECEITAS");
                    Console.WriteLine("   4 - DESPESAS");
                    Console.WriteLine("   0 - SAIR");
                    
                    Console.Write("OPÇÃO:");
                    int op = int.Parse(Console.ReadLine());
                    if (op == 1)
                    {
                        Console.Clear();
                        menuFormandos();
                        
                    }
                    else if (op == 2)
                    {
                        Console.Clear();
                        
                       
                    }
                    else if (op == 3)
                    {
                        Console.Clear();
                       
                    }
                    else if (op == 4)
                    {
                        Console.Clear();
                       
                    }
                    else if (op == 0)
                    {
                        break;
                    }
                    else
                    {
                        Console.WriteLine("OPÇÃO INVÁLIDA!");
                        Console.Beep();
                        Console.ReadKey();
                    }
                  
                }
                catch (Exception ex)
                {
                    
                    Console.WriteLine("");
                    Console.Write("ERRO:");
                    Console.WriteLine(ex.Message);
                    Console.Beep();

                    Console.WriteLine("PRECIONE ALGUMA TELCA PARA VOLTAR AO MENU");
                 
                    Console.ReadLine();
                }
            }
            
        }

#region menus

        public static void menuFormandos()
        {
            Console.Clear();

            Console.WriteLine("MENU FORMANDOS - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR FORMANDO");
            Console.WriteLine("   2 - CONSULTAR FORMANDOS");
            Console.WriteLine("   3 - EXCLUIR FORMANDO");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");
            
            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                Console.WriteLine("CADASTRO DE FORMANDO");
                cadastroFormandos();
              
            }
            else if (op == 2)
            {
                Console.Clear();
                Console.WriteLine("CONSULTA DE FORMANDO");
                
            }
            else if (op == 3)
            {
                Console.Clear();
                Console.WriteLine("EXCLUSÃO DE FORMANDO");
                
            }
            else if (op == 0)
            {

            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
        }
        public static void menuGrupoFormando()
        {
            Console.Clear();

            Console.WriteLine("MENU COMISSÃO DE FORMATURA - ESCOLHA UMA OPÇÃO");
            Console.WriteLine("   1 - CADASTRAR FORMANDO NA COMISSÃO");
            Console.WriteLine("   2 - CONSULTAR FORMANDOS NA COMISSÃO");
            Console.WriteLine("   3 - EXCLUIR FORMANDO DA COMISSÃO");
            Console.WriteLine("   0 - VOLTAR PARA MENU PRINCIPAL");

            Console.Write("OPÇÃO:");
            int op = int.Parse(Console.ReadLine());
            if (op == 1)
            {
                Console.Clear();
                Console.WriteLine("CADASTRO DE FORMANDO NO GRUPO");

            }
            else if (op == 2)
            {
                Console.Clear();
                Console.WriteLine("CONSULTA DE FORMANDO NO GRUPO");

            }
            else if (op == 3)
            {
                Console.Clear();
                Console.WriteLine("EXCLUSÃO DE FORMANDO DO GRUPO");

            }
            else if (op == 0)
            {

            }
            else
            {
                Console.WriteLine("OPÇÃO INVÁLIDA!");
                Console.Beep();
                Console.ReadKey();
            }
 
        }





#endregion

        public static void cadastroFormandos()
        {

            tipoFormando formando;
            Formando formandos = new Formando();

            Console.WriteLine("DIGITE O NOME:");
            formando.nome = Console.ReadLine().Replace(';', ' ').ToUpper(); 
            Console.WriteLine("DIGITE O CPF:");
            formando.cpf = Console.ReadLine().Replace(';', ' ').ToUpper(); 
            Console.WriteLine("DIGITE O TELEFONE1:");
            formando.telefone1 = Console.ReadLine().Replace(';', ' ').ToUpper(); 
            Console.WriteLine("DIGITE O TELEFONE2:");
            formando.telefone2 = Console.ReadLine().Replace(';', ' ').ToUpper(); 
            Console.WriteLine("DIGITE O EMAIL:");
            formando.email = Console.ReadLine().Replace(';', ' ').ToUpper();


            formando.saldo = 0;
            formando.situacao = false;
            formando.multa = 0;

       


        }



    }
}
