using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Menu_medias
{
    class Program
    {
        static void Main(string[] args)
        {
            double[] nota;
            double[] peso;
            double media, total_nota, total_peso;
            int menu, cont;

            //Menu

            do
            {
                Console.WriteLine("1 - Média Aritimética");
                Console.WriteLine("2 - Média Ponderada");
                Console.WriteLine("3 - Sair");
                Console.WriteLine("Digite a opção desejada: ");
                menu = Convert.ToInt16(Console.ReadLine());
            } while (menu <1 || menu >3);

            if (menu == 1)
            {
                
                total_nota = 0;
                nota = new double[2];


                    for (cont = 0; cont < 2; cont++)
                    {
                        Console.WriteLine("Digite a " + (cont+1)+ " nota: ");
                        nota[cont] = Convert.ToDouble(Console.ReadLine());
                        total_nota = total_nota + nota[cont];
                    }
                    
                    media = total_nota / 2;
                    Console.WriteLine("A média aritimética das notas é: "+media);

            }

            if (menu == 2)
            {
                total_nota = 0;
                total_peso = 0;
                nota = new double[3];
                peso = new double[3];


                for (cont = 0; cont < 3; cont++)
                {
                    Console.WriteLine("Digite a " + (cont + 1) + " nota: ");
                    nota[cont] = Convert.ToDouble(Console.ReadLine());
                    
                    Console.WriteLine("Digite o peso " + (cont + 1) + " nota: ");
                    peso[cont] = Convert.ToDouble(Console.ReadLine());
                    total_peso = total_peso + peso[cont];

                    total_nota = total_nota + (nota[cont] * peso[cont]);
                }

               media = total_nota/total_peso;
                Console.WriteLine("A média ponderada das notas é: " + media);
 
            }

            if (menu == 3)
            {
                Console.WriteLine("Obrigado!");
                Console.ReadKey();
            }

        }
    }
}
