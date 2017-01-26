using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aumento_salario_11
{
    class Program
    {
        static void Main(string[] args)
        {
            double salario_atual, aumento, novo_salario;

            Console.WriteLine("Digite o valor do salario do funcionario:");
            salario_atual = Convert.ToDouble(Console.ReadLine());

            if (salario_atual <= 300)
            {
                aumento = salario_atual * 0.15;
                novo_salario = salario_atual + aumento;
                Console.WriteLine("Seu aumento foi de R$" + aumento + " .Seu novo salario é de R$" + novo_salario + ".");
            }
            else
            {
                if (salario_atual <= 600)
                {
                    aumento = salario_atual * 0.1;
                    novo_salario = salario_atual + aumento;
                    Console.WriteLine("Seu aumento foi de R$" + aumento + " .Seu novo salario é de R$" + novo_salario + ".");
                }
                else
                {
                    if (salario_atual <= 900)
                    {
                        aumento = salario_atual * 0.05;
                        novo_salario = salario_atual + aumento;
                        Console.WriteLine("Seu aumento foi de R$" + aumento + " .Seu novo salario é de R$" + novo_salario + ".");
                    }
                    else
                    {
                        Console.WriteLine("Seu salario é acima de R$900,00. Você não receberá aumento");
                    }
                }                
            }
        }
    }
}
