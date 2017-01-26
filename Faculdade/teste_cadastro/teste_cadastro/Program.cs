using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace teste_cadastro
{
    class Program
    {
        public struct tipoPessoa
        {
            public string nome;
            public int cod;
        }

        static void Main(string[] args)
        {
           
            int x = 10;

            tipoPessoa[] pessoa = new tipoPessoa [x];
            x = 0;
            while (true)
            {
                
                
            
                
                Console.WriteLine("1 - cadastro");
                Console.WriteLine("2 - deletar");
                int op = int.Parse(Console.ReadLine());


               
                if (op == 1)
                {
                    Console.WriteLine("Digite o nome");
                   pessoa[x].nome  = Console.ReadLine();

                   pessoa[x].cod = x + 1;
                    x++;
                }


                if (op == 2)
                {
                    for (int i = 0; i < x; i++)
                    {
                        Console.WriteLine(pessoa[i].cod +" - "+ pessoa[i].nome);
                    }

                    Console.WriteLine("Escolha qual deve ser excluido:");
                    int nomeExc = int.Parse(Console.ReadLine());

                    for (int cont = 0; cont < x; cont++)
                    {
                        if (nomeExc == cont)
                        {
                            pessoa[cont-1].cod = 0;
                            pessoa[cont-1].nome = null;
                        }
                    }


                }

            }


            Console.ReadLine();
        }
    }
}
