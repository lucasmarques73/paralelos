using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Switch
{
    class Program
    {
        static void Main(string[] args)
        {
            string mes;

            string sDataAtual = System.DateTime.Now.ToString("dd/MM/yyyy");



           // Console.WriteLine(sDataAtual);

           // Console.WriteLine("Digite um numero de 1 a 12:");
            //mes = Convert.ToInt16(Console.ReadLine());

            switch (mes)
            {
                case 1:
                    Console.WriteLine("Mes de Janeiro!");
                    break;

                case 2:
                    Console.WriteLine("Mes de Fevereiro!");
                    break;

                case 3:
                    Console.WriteLine("Mes de Março!");
                    break;

                case 4:
                    Console.WriteLine("Mes de Abril!");
                    break;

                case 5:
                    Console.WriteLine("Mes de Maio!");
                    break;

                case 6:
                    Console.WriteLine("Mes de Junho!");
                    break;

                case 7:
                    Console.WriteLine("Mes de Julho!");
                    break;

                case 8:
                    Console.WriteLine("Mes de Agosto!");
                    break;

                case 9:
                    Console.WriteLine("Mes de Setembro!");
                    break;

                case 10:
                    Console.WriteLine("Mes de Outubro!");
                    break;

                case 11:
                    Console.WriteLine("Mes de Novembro!");
                    break;

                case 12:
                    Console.WriteLine("Mes de Dezembro!");
                    break;

                default:
                    Console.WriteLine("Mês INEXISTENTE");
                    break;

            }



        }
    }
}
