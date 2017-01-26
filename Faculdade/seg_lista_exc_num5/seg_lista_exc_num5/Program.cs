using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace seg_lista_exc_num5
{
    class Program
    {
        static void Main(string[] args)
        {

           
            int n = 15;
           
            int[] num = new int [n];

            int j = 0;
            int i = 0;



            while (j<n)
            {
                Console.Clear();
                Console.WriteLine("Digite o " +( j + 1) + "º  numero:");
                num[j] = int.Parse(Console.ReadLine());

                if (j>0)
                {
                    while (i < j)
                    {
                        if (num[j] == num[i])
                        {
                            
                            Console.WriteLine("Numero Inválido");
                            j--;
                            Console.ReadKey();
                        }

                        i++;

                    }
                    i = 0;
                }
                                
                j++;

                
            }


            //ordenando os numeros usando bubblesort
            int l = 1;
            bool troca = true;
            int aux;
            

            while ((l < n) && (troca))
            {
                troca = false;
                for (int k = 0; k < n - l; k++)
                {
                    if (num[k] > num[k + 1])
                    {
                        aux = num[k];
                        num[k] = num[k + 1];
                        num[k + 1] = aux;
                        
                        troca = true;
                    }
                }

                j++;
            }

            
            Console.WriteLine("Procurando um numero:");
            int numproc = int.Parse(Console.ReadLine());

            //busca sequencial
            bool achou = false;

            int w = 0, posvetor = 0;

            while ((w < n) && (!achou))
            {
                if (numproc == num[w])
                {
                    achou = true;
                    posvetor = w;
                }
                w++;
            }
            if (achou == false)
            {
                Console.WriteLine("Numero Digitado não foi encontrado");
            }
            else
            {
                Console.WriteLine("O Numero digitado encontra-se na posição" + posvetor);
            }

           
            //busca binaria
            achou = false;

            int cont = 0;
            int inicio = 0;
            int fim = n - 1;
            int meio = (inicio + fim) / 2;

            while ((inicio <= fim) && (!achou))
            {
                if (num[meio] == numproc)
                {
                    achou = true;
                    posvetor = meio;
                }
                else
                {
                    if (numproc < num[meio])
                    {
                        fim = meio - 1;
                    }
                    else
                    {
                        inicio = meio + 1;
                    }
                    meio = (inicio + fim) / 2;
                }
                cont++;
            }

            if (achou == false)
            {
                Console.WriteLine("Numero Digitado não foi encontrado");
            }
            else
            {
                Console.WriteLine("O Numero digitado encontra-se na posição" + posvetor);
            }

            Console.ReadKey();

        }
    }
}
