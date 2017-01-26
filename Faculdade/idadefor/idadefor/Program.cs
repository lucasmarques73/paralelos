using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace idadefor
{
    class Program
    {
        static void Main(string[] args)
        {
            int qt, cont, total_idade = 0;
            int[] idade;
            double media;


            do
            {
                Console.WriteLine("Digite a quantidade de idades: ");
                qt = Convert.ToInt16(Console.ReadLine());

                if (qt == 0)
                {
                    Console.ReadKey();
                }
                else
                {

                    idade = new int[qt];

                    for (cont = 0; cont < qt; cont++)
                    {
                        Console.WriteLine("Digite a " + (cont + 1) + " idade");
                        idade[cont] = Convert.ToInt16(Console.ReadLine());
                        total_idade = total_idade + idade[cont];

                    }

                    media = total_idade / qt;

                    Console.WriteLine("A media das idades é : " + media);
                }

            } while (qt != 0);

        }
    }
}
