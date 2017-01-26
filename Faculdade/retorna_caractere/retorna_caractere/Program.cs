using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace retorna_caractere
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Digite um texto:");
            string texto = Console.ReadLine().ToUpper();

            Console.WriteLine("Digite o caractere procurado:");
            char letra = char.Parse(Console.ReadLine().ToUpper());

            int qt_letra = retorna_letra(texto, letra);


            Console.WriteLine("A quantidade de letras "+letra+" é: "+qt_letra);


            Console.ReadKey();
        }

        public static int retorna_letra(string texto, char letra)
        {
            int qt = 0;

            for (int i = 0; i < texto.Length; i++)
            {
                if (texto[i] == letra)
                    qt++;
            }

            return qt;
        }


    }
}
