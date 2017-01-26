using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace cliente_struct_ex6_lista01
{
    class Program
    {
        struct tipo_aluno
        {
            public string nome_aluno;
            public string nome_disciplina;
            public double media_final;
        }
        static void Main(string[] args)
        {
            int numalunos = 0;
            tipo_aluno[] aluno = new tipo_aluno[30];
            char nvaluno;

            int cont = 0;

            do
            {


                Console.WriteLine("Digite o nome do " + (cont + 1) + "º aluno:");
                aluno[cont].nome_aluno = Console.ReadLine().ToUpper();
                Console.WriteLine("Digite o nome da disciplina: ");
                aluno[cont].nome_disciplina = Console.ReadLine().ToUpper();
                Console.WriteLine("Digite a média final:");
                aluno[cont].media_final = Convert.ToDouble(Console.ReadLine().ToUpper());

                Console.Clear();
                cont++; numalunos++;

                Console.WriteLine("Novo Aluno: S/N");
                nvaluno = Convert.ToChar(Console.ReadLine().ToUpper());
                Console.Clear();

            } while (nvaluno == 'S');

            // Consultando ALuno
            string alunopesquisado;
            do
            {
                Console.WriteLine("Digite o nome do aluno a ser pesquisado");
                alunopesquisado = Console.ReadLine().ToUpper();


                for (cont = 0; cont <= numalunos; cont++)
                {
                    if (alunopesquisado == aluno[cont].nome_aluno)
                    {
                        Console.WriteLine("Nome da Disciplina: " + aluno[cont].nome_disciplina);
                        Console.WriteLine("Média Final: " + aluno[cont].media_final);
                    }
                }
            } while (alunopesquisado != "FIM");
        }
    }
}
