using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;                                        //Entrada/Saida
using System.Runtime.Serialization.Formatters.Binary;   //Para arquivos binários

namespace ConsoleApplication2
{
    class Program
    {
        static void Main(string[] args)
        {
            string nomeArquivo;    // pedindo ao usuário um nome de arquivo a ser aberto
            //            Console.Write("Digite o nome do arquivo a ser aberto: ");
            //            nomeArquivo = Console.ReadLine();
            nomeArquivo = (@"f:\UEMG\FIP\Disciplinas\BSI\2P_AP-ED1\2013_2\codigos_testes\arqbin.dat");

            FileStream arquivo;         // objeto a ser associado ao arquivo binário

            if (File.Exists(nomeArquivo))
                arquivo = new FileStream(nomeArquivo, FileMode.Append);       // abrindo arquivo já existente para acrescimo de conteúdo
            else arquivo = new FileStream(nomeArquivo, FileMode.CreateNew);   // criando arquivo caso ainda não exista

            BinaryWriter bw = new BinaryWriter(arquivo);
            string nome;
            Console.Write("Nome a ser armazenado em arquivo: ");
            nome = Console.ReadLine();
            bw.Write(nome);
            bw.Close();

            arquivo = new FileStream(nomeArquivo, FileMode.Open);
            BinaryReader br = new BinaryReader(arquivo);
            nome = br.ReadString();
            Console.WriteLine("\n" + nome);
            br.Close();

            Console.ReadKey(); // aguardando o pressionar de uma tecla para encerrar o programa

        }
    }
}
