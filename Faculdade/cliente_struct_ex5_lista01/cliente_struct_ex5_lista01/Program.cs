using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cliente_struct_ex5_lista01
{
    class Program
    {
        public struct tipo_func
        {
            public string nome, end, fone, email;
            public double salario;
        }
        static void Main(string[] args)
        {
            int max = 50;
            tipo_func[] funcionarios = new tipo_func[max];
            double totalsalario = 0, maiorsalario = 0;
            int i = 0, pos_maior = 0;

            do
            {
                Console.WriteLine("Digite o "+(i+1)+"º nome: ");
                funcionarios[i].nome = Console.ReadLine().ToUpper();

                if (funcionarios[i].nome == "FIM")
                {
                    Console.WriteLine("Soma dos salarios é: R$" + totalsalario);
                    Console.WriteLine("O Maior salario é de R$" + maiorsalario + " do funcionario " + funcionarios[pos_maior].nome);
                    Console.WriteLine("Obrigado");
                   

                    Environment.Exit(0);

            
 
                }
                else
                {
                    Console.WriteLine("Digite o Endereço:");
                    funcionarios[i].end = Console.ReadLine().ToUpper();
                    Console.WriteLine("Digite o Telefone:");
                    funcionarios[i].fone = Console.ReadLine().ToUpper();
                    Console.WriteLine("Digite o email:");
                    funcionarios[i].email = Console.ReadLine().ToUpper();
                    Console.WriteLine("Digite o Salario");
                    funcionarios[i].salario = Convert.ToDouble(Console.ReadLine());


                    totalsalario += funcionarios[i].salario;

                    if (funcionarios[i].salario > maiorsalario)
                    {
                        maiorsalario = funcionarios[i].salario;
                        pos_maior = i;
                    }

                    Console.Clear();
                }

                i++;

            } while ((funcionarios[i].nome != "FIM") || (i < max));

            Console.WriteLine("Soma dos salarios é: R$"+totalsalario);
            Console.WriteLine("O Maior salario é de R$"+maiorsalario+" do funcionario "+funcionarios[pos_maior].nome);
            Console.WriteLine("Obrigado");
        }
    }
}
