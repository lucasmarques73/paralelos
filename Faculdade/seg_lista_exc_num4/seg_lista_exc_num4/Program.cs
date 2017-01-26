using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace seg_lista_exc_num4
{
    class Program
    {
        public struct tipo_aluno
        {
            public string nome;
            public double nota1;
            public double nota2;
            public double media;
        }
        static void Main(string[] args)
        {
            int n = 8;
            tipo_aluno[] aluno = new tipo_aluno [n];
            
            for (int i = 0; i < n; i++)
            {
                Console.WriteLine("Digite o nome do "+(i+1)+"º aluno:");
                aluno[i].nome = Console.ReadLine();
                Console.WriteLine("Digite a 1ª nota do " + (i + 1) + "º aluno:");
                aluno[i].nota1 = double.Parse(Console.ReadLine());
                Console.WriteLine("Digite a 2ª nota do " + (i + 1) + "º aluno:");
                aluno[i].nota2 = double.Parse(Console.ReadLine());

                aluno[i].media = ((aluno[i].nota1 * 2) + (aluno[i].nota2 * 3)) / 5;

            }

            //Ordenando os alunos pela nota 1
            int j = 1;
            bool troca = true;
            double auxnota1,auxnota2,auxmedia;
            string auxnome;
            

            while ((j < n) && (troca))
            {
                troca = false;
                for (int i = 0; i < n - j; i++)
                {
                    if (aluno[i].nota1 > aluno[i + 1].nota1)
                    {
                        auxnota1 = aluno[i].nota1;
                        aluno[i].nota1 = aluno[i + 1].nota1;
                        aluno[i + 1].nota1 = auxnota1;
                        auxnota2 = aluno[i].nota2;
                        aluno[i].nota2 = aluno[i + 1].nota2;
                        aluno[i + 1].nota2 = auxnota2;
                        auxnome = aluno[i].nome;
                        aluno[i].nome = aluno[i + 1].nome;
                        aluno[i + 1].nome = auxnome;
                        auxmedia = aluno[i].media;
                        aluno[i].media = aluno[i + 1].media;
                        aluno[i + 1].media = auxmedia;

                        troca = true;
                    }
                }

                j++;
            }
            for (int i = 0; i < n; i++)
            {
                Console.WriteLine("Aluno "+(i+1)+" nome:"+aluno[i].nome+" nota1: "+aluno[i].nota1);
            }

            Console.WriteLine("-------------------------------------------------------------------");
            //Ordenando os alunos pela média e mostrando os alunos reprovados


            int posmenor;

            for (int i = 0; i < n; i++)
            {
                posmenor = i;
                for (int l = i + 1; l < n; l++)
                {
                    int comp = aluno[posmenor].nome.CompareTo(aluno[l].nome);

                    if (comp == 1)
                    {


                        posmenor = l;


                    }
                }
                auxnota1 = aluno[i].nota1;
                aluno[i].nota1 = aluno[posmenor].nota1;
                aluno[posmenor].nota1 = auxnota1;
                auxnota2 = aluno[i].nota2;
                aluno[i].nota2 = aluno[posmenor].nota2;
                aluno[posmenor].nota2 = auxnota2;
                auxnome = aluno[i].nome;
                aluno[i].nome = aluno[posmenor].nome;
                aluno[posmenor].nome = auxnome;
                auxmedia = aluno[i].media;
                aluno[i].media = aluno[posmenor].media;
                aluno[posmenor].media = auxmedia;
            }
            Console.WriteLine("Alunos Reprovados");
            for (int e = 0; e < n; e++)
            {
                if (aluno[e].media <=7)
                {
                    Console.WriteLine("Aluno: "+aluno[e].nome+" Média: "+aluno[e].media);
                    
                }
            }

            Console.ReadKey();
        }
    }
}
