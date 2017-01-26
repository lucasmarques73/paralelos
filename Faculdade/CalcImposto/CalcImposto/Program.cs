using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CalcImposto
{
    class Program
    {
        static void Main(string[] args)
        {

            int cod, setor, idade;
            double area, salario, desconto;
            string ocupacao;

            double imp1, imp2, imp3, imp4, imp5;
            bool isento = false;


            Console.WriteLine("Digite o código:");
            cod = Convert.ToInt16(Console.ReadLine());
            Console.WriteLine("Digite o setor:");
            setor = Convert.ToInt16(Console.ReadLine());
            Console.WriteLine("Digite a idade:");
            idade = Convert.ToInt16(Console.ReadLine());

            Console.WriteLine("Digite a area:");
            area = Convert.ToDouble(Console.ReadLine());
            Console.WriteLine("Digite o salario:");
            salario = Convert.ToDouble(Console.ReadLine());
            Console.WriteLine("Digite o desconto:");
            desconto = Convert.ToDouble(Console.ReadLine());

            Console.WriteLine("Digite a ocupação");
            ocupacao = Console.ReadLine().ToUpper();

            imp1 = 10 * (cod / setor) + area;
            imp2 = cod * (setor % 5) - (idade / 2);
            imp3 = Math.Pow(idade,2) + (salario / 4) - (cod * 3);
            imp4 = cod + Math.Pow(setor,2) - Math.Round(desconto);
            imp5 = 1 + (2 * Math.Pow(setor,3)) - (2 * idade) - (9 * Math.Truncate(salario - 1));

            if (ocupacao == "APOSENTADO")
            {
                isento = true;
            }

            Console.WriteLine("IMP1: "+imp1);
            Console.WriteLine("IMP2: " + imp2);
            Console.WriteLine("IMP3: " + imp3);
            Console.WriteLine("IMP4: " + imp4);
            Console.WriteLine("IMP5: " + imp5);
            Console.WriteLine("Isento:" + isento);


            Console.ReadKey();
        }
    }
}
