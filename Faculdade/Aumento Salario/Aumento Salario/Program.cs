using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Aumento_Salario
{
    class Program
    {
        static void Main(string[] args)
        {
            double salario, salario_novo;

            Console.WriteLine("Digite o salario do funcionario:");
            salario = Convert.ToDouble(Console.ReadLine());

            if (salario >= 500)
            {
                Console.WriteLine("Seu salario é superior ou igual a R$500,00. Você não recebera reajuste.");
            }
            else
            {
                salario_novo = salario + (salario * 0.3);
                Console.WriteLine("Vôce recebeu um reajuste salarial, seu novo salario é:" + salario_novo);
            }
            
        }
    }
}
