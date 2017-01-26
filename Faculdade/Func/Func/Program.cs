using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Func
{
    class Program
    {
        static void Main(string[] args)
        {
            int opcao = 0;

            do
           {
            Console.WriteLine("1 - Cadastros");
            Console.WriteLine("2 - Consultas");
            Console.WriteLine("3 - Calcular Preço do Condominio");
            Console.WriteLine("4 - Sair");
            Console.WriteLine("---------------------------------------");
            Console.WriteLine("Escolha opção -> ");
            opcao = Convert.ToInt16(Console.ReadLine());
            Console.Clear();
            
            if (opcao == 1)
            {
                Menu_Cadastro();
            }
            if (opcao == 4)
            {
                Environment.Exit(0);
            }
           
                
            } while (opcao != 4);
        }

        public static void Menu_Cadastro()
        {
            Console.WriteLine("Opção 1 Cadastro de Condominio");
            Console.WriteLine("Opção 2 Cadastro de Morador");
            Console.WriteLine("Opção 3 Cadastro de Contas");
            Console.WriteLine("Opção 4 Volta ao menu principal");
        }  
                            
    }
}
