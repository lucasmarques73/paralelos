using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;

namespace Prog_arquivo
{
    class Program
    {
        static void Main(string[] args)
        {
            string nomeArquivo;

            Console.WriteLine("Nome do Arquivo:");
            nomeArquivo = Console.ReadLine();
            
            //Escirta

            StreamWriter escrita;

            if (File.Exists(nomeArquivo))
                escrita = new StreamWriter(nomeArquivo, true);

            else
                escrita = new StreamWriter(nomeArquivo);

            Console.WriteLine("Nome:");
            string nome = Console.ReadLine();
            Console.WriteLine("Telefone:");
            string fone = Console.ReadLine();

            escrita.WriteLine(nome + " - " + fone);
            escrita.Close();

            Console.WriteLine("\n\n");

            //Leitura

            StreamReader leitura = new StreamReader(nomeArquivo);
            string texto;

            while (!leitura.EndOfStream)
            {
                texto = leitura.ReadLine();
                Console.WriteLine(texto);
            }
            leitura.Close();

            Console.ReadKey();
        }
    }
}
