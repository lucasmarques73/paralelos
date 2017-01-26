using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Roda_de_Cesar
{
    class Program
    {
        static void Main(string[] args)
        {
            //declaração das variáveis
            string palavra, encrypt = "";
            int chave;

            Console.WriteLine("Digite a chave de criptografia:");
            chave = int.Parse(Console.ReadLine());

            Console.Clear();

            while (true)
            {
                //Esta é a perfumaria que eu falei...
                //método write escreve na tela do prompt do usuario
                Console.Write("|---------------------------------|\n");
                Console.Write("| 1 - Criptografar um mensagem    |\n");
                Console.Write("| 2 - Decriptografar uma mensagem |\n");
                Console.Write("| 0 - Sair                        |\n");
                Console.Write("|---------------------------------|\n");
                Console.Write(" Escolha a opçao: ");

                //Aqui é feito uma conversão, pois o opcao é inicialmente uma string
                int opcao = int.Parse(Console.ReadLine());

                //depois da conversão o switch verifica a opcao digitada
                switch (opcao)
                {

                    //caso a opcao seja 1
                    case 1: Console.Write("Entre com a mensagem para ser criptografada: ");

                        //palavra é a variavel que o usuario vai digitar
                        //O método .ToLower() transforma qualquer letra maiúscula em minúscula
                        palavra = Console.ReadLine().ToLower();

                        //enquanto a palavra for menor que i
                        for (int i = 0; i < palavra.Length; i++)
                        {
                            //Devolve o codigo ASCII da letra
                            int ASCII = (int)palavra[i];

                            //Coloca a chave fixa adicionando 10 posições no numero da tabela ASCII
                            int ASCIIC = ASCII + chave;

                            //Concatena o texto e o coloca na variável
                            encrypt += Char.ConvertFromUtf32(ASCIIC);
                        }

                        //Mostra o resultado final, concatenando a variável em que está o texto cifrado
                        Console.Write("Resultado: " + encrypt);

                        //Aguarda o usuário pressionar uma tecla para sair
                        Console.ReadKey();

                        //representa o final do case 1
                        break;

                    //caso a opcao escolhida for 2
                    case 2: Console.Write("Entre com a mensagem para ser decriptografada: ");

                        palavra = Console.ReadLine().ToLower();

                        for (int i = 0; i < palavra.Length; i++)
                        {

                            int ASCII = (int)palavra[i];

                            //Coloca a chave fixa retirando 10 posições no numero da tabela ASCII
                            int ASCIIC = ASCII - chave;

                            encrypt += Char.ConvertFromUtf32(ASCIIC);

                        }

                        Console.Write(encrypt);

                        Console.ReadKey();

                        break;

                    case 0: ;
                        break;
                }
            }
        }
    }
}
