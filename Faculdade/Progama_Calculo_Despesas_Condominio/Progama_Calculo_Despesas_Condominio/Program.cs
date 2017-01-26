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
            // Desenvolvido por Lucas Marques e Vitor Kallas - 1º Periodo de Sistemas de Informaçao - FESP
            // Programa de Calculo das Despesas do Condominio 

            //Variaves

            int NumAp, cont, qtDespesas = 0;
            double ValorAgua, ValorEnergia, ValorTotalOutrasDespesas = 0, ValorTotal, ValorAP, y = 0;
            double[] ValorOutrasDespesas;
            string[] NomeOutrasDespesas;

            //Entrada de Dados

            Console.WriteLine("Digite o numero de apartamentos no predio: ");
            NumAp = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o valor a ser pago sobre a agua: ");
            ValorAgua = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite o valor a ser pago sobre a energia: ");
            ValorEnergia = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Quantas novas despesas serão calculadas: ");
            qtDespesas = Convert.ToInt16(Console.ReadLine());

            ValorOutrasDespesas = new double[qtDespesas];
            NomeOutrasDespesas = new string[qtDespesas];

            // Se houver outras despesas ele entra neste IF para calcular quantas for necessario.

            if (qtDespesas != 0)
            {

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




            //Calculo das Despesas

            ValorTotal = ValorTotalOutrasDespesas + ValorEnergia + ValorAgua;
            ValorAP = ValorTotal / NumAp;

            //Saida Dos Valores

            Console.WriteLine("O total de despesas do prédio: R$" + Math.Round(ValorTotal, 2));
            Console.WriteLine("O valor de despesas com agua: R$" + Math.Round(ValorAgua, 2));
            Console.WriteLine("O valor de despesas com energia: R$" + Math.Round(ValorEnergia, 2));
            Console.WriteLine("O valor total gasto com outras despesas: R$" + Math.Round(ValorTotalOutrasDespesas, 2));

            //Se houver outras despesas ele vai exibir o nome e o valor de cada despesa separadamente.

            if (ValorTotalOutrasDespesas > y)
            {


                for (cont = 0; cont < qtDespesas; cont++)
                {

                    Console.WriteLine("O valor gasto com " + NomeOutrasDespesas[cont] + ": R$" + Math.Round(ValorOutrasDespesas[cont], 2));
                }
            }


            Console.WriteLine("O valor a ser pago por cada apartamento: R$" + Math.Round(ValorAP, 2));

            Console.ReadKey();
        }
    }
}
