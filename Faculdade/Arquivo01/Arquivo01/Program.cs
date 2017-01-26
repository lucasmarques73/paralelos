using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;  //biblioteca para acesso a arquivos

namespace ConsoleApplication1
{
    class Program
    {
        static void Main(string[] args)
        {
            string nomeArquivo;    // pedindo ao usuário um nome de arquivo a ser aberto
            Console.Write("Digite o nome do arquivo a ser aberto: ");
            nomeArquivo = Console.ReadLine();

            StreamWriter escrita;  // objeto a ser associado ao arquivo para escrita

            if (File.Exists(nomeArquivo))
                escrita = new StreamWriter(nomeArquivo, true); // abrindo arquivo já existente para acrescimo de conteúdo
            else escrita = new StreamWriter(nomeArquivo);      // criando arquivo caso ainda não exista

            Console.Write("Digite seu nome: ");  // lendo dados do usuário para salvar no arquivo
            string nome = Console.ReadLine();
            Console.Write("Telefone: ");
            string fone = Console.ReadLine();

            escrita.WriteLine(nome + " - " + fone);  // salvando os dados lidos no arquivo
            escrita.Close();                         // fechando o arquivo

            Console.WriteLine("\n\n ");    // santando linhas na tela

            StreamReader leitura = new StreamReader(nomeArquivo); // associando objeto ao arquivo e abrindo-0 para leitura

            string cadastro;
            while (!leitura.EndOfStream)  // lendo linha por linha do arquivo até o final do arquivo e imprimindo na tela
            {
                cadastro = leitura.ReadLine();
                Console.WriteLine("\n " + cadastro);
            }
            leitura.Close();  // fechando o arquivo

            Console.ReadKey(); // aguardando o pressionar de uma tecla para encerrar o programa

        }
    }
}
