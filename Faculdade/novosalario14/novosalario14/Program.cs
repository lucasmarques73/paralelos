using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace novosalario14
{
    class Program
    {
        static void Main(string[] args)
        {
            double salario, novo_salario;

            Console.WriteLine("Digite o salario do funcionario:");
            salario = Convert.ToDouble(Console.ReadLine());

            if (salario <= 300)
            {
                novo_salario = salario + (salario * 0.5);
            }
            else
            {
                if (salario <= 500)
                {
                    novo_salario = salario + (salario * 0.4);
                }
                else
                {
                    if (salario <= 700)
                    {
                        novo_salario = salario + (salario * 0.3);
                    }
                    else
                    {
                        if (salario <= 800)
                        {
                            novo_salario = salario + (salario * 0.2);
                        }
                        else
                        {
                            if (salario <= 1000)
                            {
                                novo_salario = salario + (salario * 0.1);
                            }
                            else
                            {
                                novo_salario = salario + (salario * 0.05);
                            }
                        }
                    }
                }
            }

            Console.WriteLine("Seu salario com aumento vai ser de R$" + novo_salario);

        }
    }
}
