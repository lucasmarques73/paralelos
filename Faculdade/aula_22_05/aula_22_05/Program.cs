using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Program
    {
        static void Main(string[] args)
        {

            Pessoa pessoa1 = new Pessoa("João", "Medeiros");

            Funcionario pessoa2 = new Funcionario("Leonardo","Messias", 1000.00);

            Professor pessoa3 = new Professor("Antonio", "Silva", 1500.00);


            string nomeCompletoPessoa1 = pessoa1.getNomeCompleto();
            Console.WriteLine("Nome: "+ nomeCompletoPessoa1);

            string nomeCompletoPessoa2 = pessoa2.getNomeCompleto();
            Console.WriteLine("Nome: " + nomeCompletoPessoa2);
            double primeiroSalarioPessoa2 = pessoa2.getSalarioPrimeiraParcela();
            Console.WriteLine("1ª parcela do salário:" + primeiroSalarioPessoa2);
            double segundaSalarioPessoa2 = pessoa2.getSalarioSegundaParcela();
            Console.WriteLine("2ª parcela do salário:" + segundaSalarioPessoa2);

            string nomeCompletoPessoa3 = pessoa3.getNomeCompleto();
            Console.WriteLine("Nome: " + nomeCompletoPessoa3);
            double primeiroSalarioPessoa3 = pessoa3.getSalarioPrimeiraParcela();
            Console.WriteLine("1ª parcela do salário:" + primeiroSalarioPessoa3);
            double segundaSalarioPessoa3 = pessoa3.getSalarioSegundaParcela();
            Console.WriteLine("2ª parcela do salário:" + segundaSalarioPessoa3);


            Console.ReadKey();
        }
    }
}
