using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace seg_lista_exc_num2
{
    class Program
    {
        static void Main(string[] args)
        {
            try
            {
                int n = 10;
                int[] num = new int[n];

                for (int i = 0; i < 10; i++)
                {
                    Console.WriteLine("Digite o"+(i+1)+"º numero:");
                    num[i] = Convert.ToInt16(Console.ReadLine());
                }


                int j = 1;
                bool troca = true;
                int aux;

                //ordenando o vetor


                while ((j < n) && (troca))
                {
                    troca = false;
                    for (int i = 0; i < n - j; i++)
                    {
                        if (num[i] > num[i + 1])
                        {
                            aux = num[i];
                            num[i] = num[i + 1];
                            num[i + 1] = aux;


                            troca = true;
                        }
                    }

                    j++;
                }

                //O menor número e quantas vezes ele aparece no vetor;


                int cont = 1;

                for (int i = 0; i < n - 1; i++)
                {
                    if (num[0] == num[i + 1])
                    {
                        cont++;
                    }

                }


                Console.WriteLine("O menor numero é: " + num[0] + " e ele aparece: " + cont + " vezes.");
                //o maior numero e quantas vezes ele aparece no setor;

                int cont1 = 1;



                for (int i = n - 1; i > 0; i--)
                {
                    if (num[n - 1] == num[i - 1])
                    {
                        cont1++;
                    }
                }


                Console.WriteLine("O maior numero é: " + num[n - 1] + " e ele aparece: " + cont1 + " vezes.");


            }catch(Exception ex)
            {
             
                
                Console.Write("ERRO:");
                Console.WriteLine(ex.Message);
                Console.Beep();
                
                Console.ReadLine();
            }
            Console.ReadKey();
        }
    }
}
