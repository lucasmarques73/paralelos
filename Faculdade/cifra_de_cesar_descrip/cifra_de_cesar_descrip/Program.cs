using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cifra_de_Cesar
{
    class Program
    {
        static void Main(string[] args)
        {
            string texto_crip_asc = "", texto_cript = "", texto_original = "", texto_tabela = "";
            int chave;

            Console.WriteLine("Digite a chave");
            chave = int.Parse(Console.ReadLine());
            Console.WriteLine("Digite um texto");
            texto_original = Console.ReadLine().ToUpper();
           //texto_original = "VJNSINZJKNSINVZENSINKVOKNSINZENSINUVLKJTYNGKNNSINVJNSINNRVIVNSINQLNSINVZEWRTYNMINNSINNVEENSINUVINSINKVOKNSINZENSINGFIKLXZVJZJTYNSINXVJTYIZVSVENSINNFIUVENSINNRVIVNGKNNSINZTYNSINNVZJJNGKNNSINZTYNSINNVZJJNMINNSINVJNSINZJKNSINEZTYKNSINWRZINGKNNSINYVIQCZTYVENSINXCLVTBNLVEJTYVENSINQLDNSINXVNZEEVINVONNVONNVON";

            
            Console.WriteLine(texto_original);
            Console.WriteLine(texto_tabela);

            for (int i = 0; i < texto_original.Length; i++)
            {
                //Devolve o codigo ASCII da letra
                int ASCII = (int)texto_original[i];

                //Coloca a chave fixa adicionando n posições no numero da tabela ASCII
                int ASCIIC = ASCII - chave;

                int texto_menos_65 = ASCIIC - 65;

                int mod = (texto_menos_65 % 26);

                int texto_mais_65 = mod + 65;

                if (texto_mais_65 < 65)
                    texto_mais_65 = texto_mais_65 + 26;
                
                //Concatena o texto e o coloca na variável
                texto_crip_asc += Char.ConvertFromUtf32(ASCIIC);
                texto_cript += Char.ConvertFromUtf32(texto_mais_65);
            }

            texto_tabela = texto_cript.ToUpper().Replace("WBRW", " ").Replace("WVRW", ",").Replace("WPTW", ".").Replace("WPVW", ";").Replace("WDPW", ":").Replace("WEXW", "!").Replace("WINW", "?").Replace("WHFW", "-");
         
            
            Console.WriteLine("----------------------------------------------------");
            Console.WriteLine(texto_tabela);
            Console.WriteLine("----------------------------------------------------");
            Console.WriteLine(texto_crip_asc);
            Console.WriteLine("----------------------------------------------------");
            Console.WriteLine(texto_cript);
            Console.WriteLine("----------------------------------------------------");
            Console.ReadKey();

        }
    }
}
