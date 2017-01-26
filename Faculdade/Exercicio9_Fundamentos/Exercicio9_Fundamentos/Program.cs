using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio9_Fundamentos
{
    class Program
    {
        static void Main(string[] args)
        {
            // Criação dos vetores
            int cont, tam = 3;
            string[] nome; nome = new string[tam];
            int[] codigo; codigo = new int[tam];
            double[] preco; preco = new double[tam];
            double[] novopreco; novopreco = new double[tam];

            for (cont = 0; cont < tam ; cont++)
            {
                Console.WriteLine("Digite o nome do "+(cont+1)+"º produto:");
                nome[cont] = Console.ReadLine();

                Console.WriteLine("Digite o codigo do " + (cont + 1) + "º produto:");
                codigo[cont] = Convert.ToInt16(Console.ReadLine());

                Console.WriteLine("Digite o preço do " + (cont + 1) + "º produto:");
                preco[cont] = Convert.ToDouble(Console.ReadLine());
            }

            //Produção do Relatorio

            for (cont = 0; cont < tam; cont++)
            {
                if (codigo[cont] % 2 == 0) //se o codigo é par 
                {
                    if (preco[cont] > 1000)//se o preço é maior que mil
                    {
                        novopreco[cont] = preco[cont] * 20 /100 + preco[cont];// aumento de 20% para o produto
                    }
                    else
                    {
                        novopreco[cont] = preco[cont] * 15 /100 + preco[cont];// aumento de 15% para o produto
                    }
                }
                else  //o codigo é impar
                {
                    if (preco[cont] > 1000)//se o preço é maior que mil
                    {
                        novopreco[cont] = preco[cont] * 10 /100 + preco[cont];// aumento de 10% para o produto
                    }
                    else
                    {
                        novopreco[cont] = preco[cont];// nao recebe aumento
                    }
                }  
                
                //Fase de Saida
               
                    Console.WriteLine(nome[cont]+" "+codigo[cont]+" "+ preco[cont]+ " "+ novopreco[cont] );
                
            }

            Console.ReadKey();
        }
    }
}
