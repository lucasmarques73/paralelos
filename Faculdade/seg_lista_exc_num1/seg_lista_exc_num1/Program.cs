using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace seg_lista_exc_num1
{
    class Program
    {

        public struct tipo_funcionario
        {
            public string nome;
            public double salario;
        }

        static void Main(string[] args)
        {

            int n = 5;
            tipo_funcionario[] funcionario = new tipo_funcionario[n];

         for (int i = 0; i < n; i++)
			{
    
	    		 Console.WriteLine("Digite o nome do "+(i+1)+"º funcionario");
                 funcionario[i].nome = Console.ReadLine();

                 Console.WriteLine("Digite o salario do " + (i+1) + "º funcionario");
                 funcionario[i].salario = Convert.ToDouble(Console.ReadLine());
			}


            //Em ordem crescente de salário pelo BubbleSort
         int j = 1;
         bool troca = true;
         double aux;
         string auxnome;

         while ((j<n) && (troca))
             
         {
             troca = false;
             for (int i = 0; i < n-j; i++)
             {
                 if (funcionario[i].salario > funcionario[i+1].salario)
                 {
                     aux = funcionario[i].salario;
                     funcionario[i].salario = funcionario[i + 1].salario;
                     funcionario[i + 1].salario = aux;
                     auxnome = funcionario[i].nome;
                     funcionario[i].nome = funcionario[i + 1].nome;
                     funcionario[i + 1].nome = auxnome;

                     troca = true;
                 }
             }

             j++;
         }

         for (int i = 0; i < n; i++)
         {
             Console.WriteLine("O nome do " + (i + 1) + "º funcionario: "+funcionario[i].nome);
             Console.WriteLine("O salario do " + (i + 1) + "º funcionario: " + funcionario[i].salario);
         }

         Console.WriteLine("--------------------------------------------------------------------------------------");
            //Em ordem decrescente de salario pelo InsertionSort

         double eleito;
         string eleitonome;
            int k;

         for (int i = 1; i < n; i++)
         {
             eleito = funcionario[i].salario;
             eleitonome = funcionario[i].nome;
             k = i-1;
             while ((k >=0)  &&  (funcionario[k].salario < eleito))
	            {
                    funcionario[k + 1].salario = funcionario[k].salario;
                    funcionario[k + 1].nome = funcionario[k].nome;
                    k--;
	            }
             funcionario[k + 1].salario = eleito;
             funcionario[k + 1].nome = eleitonome;
         }
            

         for (int i = 0; i < n; i++)
         {
             Console.WriteLine("O nome do " + (i + 1) + "º funcionario: " + funcionario[i].nome);
             Console.WriteLine("O salario do " + (i + 1) + "º funcionario: " + funcionario[i].salario);
         }


         Console.WriteLine("----------------------------------------------------------------------------------------------------------");

         //Em ordem alfabetica pelo SelectionSort

         int posmenor;

         for (int i = 0; i < n; i++)
         {
             posmenor = i;
             for (int l = i+1; l < n; l++)
             {
                 int comp = funcionario[posmenor].nome.CompareTo(funcionario[l].nome);

                 if (comp == 1)
                 {


                     posmenor = l;

                    
                 }
             }
             auxnome = funcionario[i].nome;
             funcionario[i].nome = funcionario[posmenor].nome;
             funcionario[posmenor].nome = auxnome;
             aux = funcionario[i].salario;
             funcionario[i].salario = funcionario[posmenor].salario;
             funcionario[posmenor].salario = aux;
         }

         for (int i = 0; i < n; i++)
         {
             Console.WriteLine("O nome do " + (i + 1) + "º funcionario: " + funcionario[i].nome);
             Console.WriteLine("O salario do " + (i + 1) + "º funcionario: " + funcionario[i].salario);
         }

         Console.ReadKey();
        }
    }
}
