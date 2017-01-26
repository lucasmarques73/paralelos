using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Condominio
{
    class Program
    {
        static void Main(string[] args)
        {
            //Variaves

            int NumAp, cont, qtDespesas = 0;
            double ValorAgua, ValorEnergia, ValorTotalOutrasDespesas = 0, ValorTotal, ValorAP , y = 0;
            double[] ValorOutrasDespesas;
            string x;
            string[] NomeOutrasDespesas;

            //Entrada de Dados

            Console.WriteLine("Digite o numero de apartamentos no predio: ");
            NumAp = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o valor a ser pago sobre a agua: ");
            ValorAgua = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite o valor a ser pago sobre a energia: ");
            ValorEnergia = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Existe mais despesas a serem calculadas: ");
            Console.WriteLine("Digite S - Sim ou N - Não");
            x = Console.ReadLine();

           // do
            //{

                if (x == "S")
                {
                    Console.WriteLine("Quantas novas despesas serão calculadas: ");
                    qtDespesas = Convert.ToInt16(Console.ReadLine());

                    ValorOutrasDespesas = new double[qtDespesas];
                    NomeOutrasDespesas = new string[qtDespesas];


                    for (cont = 0; cont < qtDespesas; cont++)
                    {
                        Console.WriteLine("Digite o nome da " + (cont + 1) + "ª despesa:");
                        NomeOutrasDespesas[cont] = Console.ReadLine();

                        Console.WriteLine("Digite o valor da " + (cont + 1) + "ª despesa:");
                        ValorOutrasDespesas[cont] = Convert.ToDouble(Console.ReadLine());

                        //Calculando somente as outras despesas

                        ValorTotalOutrasDespesas = ValorTotalOutrasDespesas + ValorOutrasDespesas[cont];
                    }
                }

            //} while ((x != "S") || (x != "N"));

            //Calculo das Despesas

            ValorTotal = ValorTotalOutrasDespesas + ValorEnergia + ValorAgua;
            ValorAP = ValorTotal / NumAp;

            //Saida Dos Valores

            Console.WriteLine("O total de despesas do prédio: R$"+ValorTotal);
            Console.WriteLine("O valor de despesas com agua: R$" +ValorAgua);
            Console.WriteLine("O valor de despesas com energia: R$" +ValorEnergia);
            Console.WriteLine("O valor total gasto com outras despesas: R$"+ ValorTotalOutrasDespesas);

            
           
            if (ValorTotalOutrasDespesas > y)
            {
                

                for (cont = 0; cont < qtDespesas; cont++) 
                {

                    Console.WriteLine("O valor gasto com " + NomeOutrasDespesas[cont] + ": R$" + ValorOutrasDespesas[cont]);
                }
            }
            
            
            Console.WriteLine("O valor a ser pago por cada apartamento: R$"+ ValorAP);
        }
    }
}
