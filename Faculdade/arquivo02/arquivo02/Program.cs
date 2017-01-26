using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;

namespace ConsoleApplication2
{
    class Program
    {
        static void Main(string[] args)
        {
            string nomeArquivo;    // pedindo ao usuário um nome de arquivo a ser aberto
            Console.Write("Digite o nome do arquivo a ser aberto: ");
            nomeArquivo = Console.ReadLine();

            StreamWriter arquivo_out;  // objeto a ser associado ao arquivo para escrita

            if (File.Exists(nomeArquivo))
                arquivo_out = new StreamWriter(nomeArquivo, true); // abrindo arquivo já existente para acrescimo de conteúdo
            else arquivo_out = new StreamWriter(nomeArquivo);      // criando arquivo caso ainda não exista

            Console.Write("Digite seu nome: ");  // lendo dados do usuário para salvar no arquivo
            string nome = Console.ReadLine();
            Console.Write("Telefone: ");
            string fone = Console.ReadLine();

            arquivo_out.WriteLine(nome + " - " + fone);  // salvando os dados lidos no arquivo
            arquivo_out.Close();                         // fechando o arquivo

            Console.WriteLine("\n\n ");    // saltando linhas na tela

            StreamReader arquivo_in = new StreamReader(nomeArquivo); // associando objeto ao arquivo e abrindo-0 para leitura

            string cadastro;
            while (!arquivo_in.EndOfStream)  // lendo linha por linha do arquivo até o final do arquivo e imprimindo na tela
            {
                cadastro = arquivo_in.ReadLine();
                Console.WriteLine("\n " + cadastro);
            }
            arquivo_in.Close();  // fechando o arquivo

            Console.ReadKey(); // aguardando o pressionar de uma tecla para encerrar o programa


        }
    }
}
