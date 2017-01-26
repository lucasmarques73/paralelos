using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Calcula_Salario
{
    class Program
    {
        static void Main(string[] args)
        {
            double salario, comissao, novo_salario;

            Console.WriteLine("Coloque o valor do salario: ");
            salario = Convert.ToDouble(Console.ReadLine());
            comissao = salario * 4 / 100;
            novo_salario = salario + comissao;
            Console.WriteLine("O valor da comissão é: "+ comissao);
            Console.WriteLine("O valor do salario com a comissãp é:"+ novo_salario);
        }
    }
}
