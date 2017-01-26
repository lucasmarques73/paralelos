using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Menu_Usuario
{
    class Program
    {

        public static void Menu_1()//Rotina sem retorno
        {
            int opcao;

            //Menu
            Console.Clear();
            Console.WriteLine("MENU: \n");
            Console.WriteLine(" 1 - CADASTRAR: ");
            Console.WriteLine(" 2 - EDITAR: ");
            Console.WriteLine(" 3 - REMOVER: ");
            Console.WriteLine(" 4 - LISTAR: ");
            Console.WriteLine(" 5 - CONSULTAR: ");
            Console.WriteLine(" 0 - SAIR: ");
            Console.Write("\n Opção:");
            opcao = int.Parse(Console.ReadLine());

            switch (opcao)
            {
                case 1: Console.WriteLine("Cadastro");
                    break;
                case 2: Console.WriteLine("Edição");
                    break;
                case 3: Console.WriteLine("Remoçao");
                    break;
                case 4: Console.WriteLine("Listagem");
                    break;
                case 5: Console.WriteLine("Busca");
                    break;
                case 0: Console.WriteLine("Saida");
                    break;
                default:
                    Console.WriteLine("Opção Invalida");
                    break;
            }
        }
        public static int menu_2()//Rotina com retorno
        {
            int opcao;

            //Menu
            Console.Clear();
            Console.WriteLine("MENU: \n");
            Console.WriteLine(" 1 - CADASTRAR: ");
            Console.WriteLine(" 2 - EDITAR: ");
            Console.WriteLine(" 3 - REMOVER: ");
            Console.WriteLine(" 4 - LISTAR: ");
            Console.WriteLine(" 5 - CONSULTAR: ");
            Console.WriteLine(" 0 - SAIR: ");
            Console.Write("\n Opção:");
            opcao = int.Parse(Console.ReadLine());
            return (opcao);
        }

        static void Main(string[] args)
        {
            int op;

            //Chamando a rotina menu_1
          //  Menu_1();

            //Chamando menu_2
            do
                op = menu_2();
            while ((op < 0) || (op > 5));
                        switch (op)
            {
                case 1: Console.WriteLine("Cadastro");
                    break;
                case 2: Console.WriteLine("Edição");
                    break;
                case 3: Console.WriteLine("Remoçao");
                    break;
                case 4: Console.WriteLine("Listagem");
                    break;
                case 5: Console.WriteLine("Busca");
                    break;
                case 0: Console.WriteLine("Saida");
                    break;
                default:
                    Console.WriteLine("Opção Invalida");
                    break;
            }

        }


        
    }
}
