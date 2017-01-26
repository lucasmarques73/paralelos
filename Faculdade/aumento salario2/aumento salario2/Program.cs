using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aumento_salario2
{
    class Program
    {
        static void Main(string[] args)
        {
            double salario, salario_novo;

            Console.WriteLine("Digite o salario do funcionario:");
            salario = Convert.ToDouble(Console.ReadLine());

            if (salario <= 300)
            {
                salario_novo = salario + (salario * 0.35);
                Console.WriteLine("Seu salario foi reajustado. Seu novo salario é: R$"+ salario_novo);
            }
            else
            {
                salario_novo = salario + (salario * 0.15);
                Console.WriteLine("Seu salario foi reajustado. Seu novo salario é: R$"+ salario_novo);
            }
        }
    }
}
