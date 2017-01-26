using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace procura_pal
{
    class Program
    {
        static void Main(string[] args)
        {
            while (true)
            {
                Console.Clear();
                Console.WriteLine("Digite o texto:");
                string frase = Console.ReadLine().ToUpper();

                int posicao = procura_pal(frase, 0, "WINW");

                Console.WriteLine(posicao);
                Console.ReadKey();
            }
        }
        static int procura_pal(string frase, int i, string pal)
        {
            int j=i,c=0;
            bool def = false, def2 = false;

            do
            {
                if (frase[j] == pal[0])
                {
                    if (frase[j + 1] == pal[1])
                    {
                        if (frase[j + 2] == pal[2])
                        {
                            if (frase[j + 3] == pal[3])
                            {
                                c = j;
                                def2 = false;
                                def = true;
                            }
                            else
                            {
                                def2 = true;
                                def = true;
                            }
                        }
                        else
                        {
                            def2 = true;
                            def = true;
                        }
                    }
                    else
                    {
                        def2 = true;
                        def = true;
                    }
                }
                
                if (def2 == true)
                    c = -1;

                j++;
            } while (def != true);

          





            return (c);
        }
    }
}
