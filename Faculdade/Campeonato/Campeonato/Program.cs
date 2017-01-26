using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Campeonato
{
    class Program
    {
        static void Main(string[] args)
        {
            int Cv, Ce, Cs, Fv, Fe, Fs, PontosCv, PontosFv, PontosCe, PontosFe, TotalPontosC, TotalPontosF;
            string Ganhador;

            Console.WriteLine("Digite o numero de vitorias do Corinthians:");
            Cv = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero de empates do Corinthians:");
            Ce = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero de saldo de gols do Corinthians:");
            Cs = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero de vitorias do Flamengo:");
            Fv = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero de empates do Flamengo:");
            Fe = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite o numero de saldo de gols do Flamengo:");
            Fs = Convert.ToInt16(Console.ReadLine());

            PontosCv = Cv * 3;
            PontosCe = Ce * 1;
            TotalPontosC = PontosCv + PontosCe;

            PontosFv = Fv * 3;
            PontosFe = Fe * 1;
            TotalPontosF = PontosFv + PontosFe;

            if (TotalPontosC > TotalPontosF)
            {
                Ganhador = "Corinthians";
            }
            else
            {
                if (TotalPontosC < TotalPontosF)
                {
                    Ganhador = "Flamengo";
                }
                //Empatou, Vai ser consultado o Saldo de Gols
                else
                {
                    if (Cs > Fs)
                    {
                        Ganhador = "Corinthians";
                    }
                    else
                    {
                        if (Cs < Fs)
                        {
                            Ganhador = "Flamengo";
                        }
                        else
                        {
                            Ganhador = "Não houve ganhador, empatou em todos os critérios.";
                        }

                           }
                }

            }
            Console.WriteLine("Quem foi o ganhador: " + Ganhador);
        }

        
    }
}
