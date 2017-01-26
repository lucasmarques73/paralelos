using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace credito_banco_exercicio_9
{
    class Program
    {
        static void Main(string[] args)
        {

            double saldo_medio, valor_credito;

            Console.WriteLine("Digite o saldo medio do cliente:");
            saldo_medio = Convert.ToDouble(Console.ReadLine());

            if (saldo_medio <= 200.00)
            {
                valor_credito = saldo_medio * 0.1;
                Console.WriteLine("Seu saldo medio é: " + saldo_medio + " e Seu credito é: " + valor_credito);
            }
            else
            {
                if (saldo_medio < 300.00)
                {
                    valor_credito = saldo_medio * 0.2;
                    Console.WriteLine("Seu saldo medio é: " + saldo_medio + " e Seu credito é: " + valor_credito);
                }
                else
                {
                    if (saldo_medio < 400.00)
                    {
                        valor_credito = saldo_medio * 0.25;
                        Console.WriteLine("Seu saldo medio é: " + saldo_medio + " e Seu credito é: " + valor_credito);
                    }
                    else
                    {
                        if (saldo_medio > 400.00)
                        {
                            valor_credito = saldo_medio * 0.3;
                            Console.WriteLine("Seu saldo medio é: " + saldo_medio + " e Seu credito é: " + valor_credito);
                        }
                    }
                }

                
            }
        }
    }



}

 
