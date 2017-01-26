using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace palavas_inverso
{
    class Program
    {
        static void Main(string[] args)
        {
            String Texto;

            Console.WriteLine("Digite uma frase:");
            Texto = Console.ReadLine();

 

                // Converte Texto para um Array de Caractere

                Char[] Charactere = Texto.ToCharArray();
                Array.Reverse(Charactere);

 

                // Cria String com Array de Caracteres invertidos

                String Reversed = new String(Charactere, 0, Charactere.Length);

                //Resultado

                Console.WriteLine(Reversed);

 
        }
    }
}
