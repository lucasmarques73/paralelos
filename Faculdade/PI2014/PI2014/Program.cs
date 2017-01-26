using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PI2014
{
    class Program
    {
        static void Main(string[] args)
        {
            ConfigurarJanela();

            //Menu
            while (true)
            {
                try
                {
                    Console.Clear();
                    cabecalho("MENU PRINCIPAL - ESCOLHA UMA OPÇÃO");
                    Console.WriteLine("   1 - CONDOMINIO");
                    Console.WriteLine("   2 - MORADOR");
                    Console.WriteLine("   3 - DESPESAS");
                    Console.WriteLine("   4 - PAGAMENTOS");
                    Console.WriteLine("   0 - SAIR");
                    cabecalho("");
                    Console.Write("OPÇÃO:");
                    int op = int.Parse(Console.ReadLine());
                    if (op == 1)
                    {
                        Console.Clear();
                        cabecalho("MENU CONDOMÍNIO - ESCOLHA UMA OPÇÃO");
                        menu_condominio();
                    }
                    else if (op == 2)
                    {
                        Console.Clear();
                        // cabecalho("MENU MORADOR - ESCOLHA UMA OPÇÃO");
                        menu_morador();
                    }
                    else if (op == 3)
                    {
                        Console.Clear();
                        //   cabecalho("MENU DESPESAS - ESCOLHA UMA OPÇÃO");
                        menu_despesas();
                    }
                    else if (op == 4)
                    {
                        Console.Clear();
                        //  cabecalho("MENU PAGAMENTOS - ESCOLHA UMA OPÇÃO");
                        menu_pagamentos();
                    }
                    else if (op == 0)
                    {
                        break;
                    }
                    else
                    {
                        cabecalho("OPÇÃO INVÁLIDA!");
                        Console.Beep();
                        Console.ReadKey();
                    }
                  
                }
                catch (Exception ex)
                {
                    linha();
                    Console.WriteLine("");
                    Console.Write("ERRO:");
                    Console.WriteLine(ex.Message);
                    Console.Beep();

                    cabecalho("PRECIONE ALGUMA TELCA PARA VOLTAR AO MENU");
                 
                    Console.ReadLine();
                }
            }
        }

        #region Layout
        public static void linha()
        {
            Console.Write("|");
            for (int i = 1; i < 148; i++)
                Console.Write("-");
            Console.Write("|");
            
        }
        public static void cabecalho(string op)
        {
            int tam, espaco, i;


            linha();
            tam = op.Length;
            espaco = 75 - tam / 2;
            for (i = 0; i < espaco; i++)
            {
                Console.Write(" ");
                if (i == 0)
                    Console.Write("|");
            }
            Console.Write(op);

            for (i = (tam + espaco); i < 149; i++)
            {
                Console.Write(" ");
                if (i == 147)
                    Console.Write("|");
            }

            linha();
            Console.WriteLine("");
        }
        public static void ConfigurarJanela()
        {
            Console.Title = "SISTEMA DE GERENCIAMENTO DE CONDOMÍNIO";
            Console.BackgroundColor = ConsoleColor.DarkCyan;
            Console.ForegroundColor = ConsoleColor.White;
          //  Console.BufferHeight = 50;
           Console.BufferWidth = 150;
            Console.SetWindowSize(150, 50);
        }
        public static void loading()
        {
            Console.Clear();
            Console.WriteLine();
            Console.Write("(Loading) ");
            for (int ld = 0; ld < 69; ld++)
            {
                Thread.Sleep(25);
                Console.Write("║");
            }
            Thread.Sleep(300);
            Console.WriteLine();
            Console.Clear();
        }
        #endregion
        }
    }
}
