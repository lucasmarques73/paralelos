using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exc_24_04
{
    class Ordena
    {
        private int TamVetor;
        private int[] Vetor;


        //Construtor Padrão
        public Ordena()
        {
            TamVetor = 1000;
            CriaVetor();

        }

        // Métodos
        private void CriaVetor()
        {
            // Criando o vetor
            Vetor = new int[TamVetor];

            // Preenchimento do vetor
            Random X = new Random(); // Comando de preenchimento aleatório

            for (int cont = 0; cont < TamVetor; cont++)
            {
                Vetor[cont] = X.Next(100); // Comando next(100) gera os números aleatórios nesse caso nunca > 100
            }
        }

        public void Imprime()
        {
            for (int cont = 0; cont < TamVetor; cont++)
                Console.Write(Vetor[cont] + " ");
        }


        public int Bolha()
        {
            int j = 1;
            bool troca = true;
            int aux;
            int NumComp = 0;


            while ((j < TamVetor) && (troca))
            {
                troca = false;
                for (int i = 0; i < TamVetor - j; i++)
                {
                    if (Vetor[i] > Vetor[i + 1])
                    {
                        aux = Vetor[i];
                        Vetor[i] = Vetor[i + 1];
                        Vetor[i + 1] = aux;
                        troca = true;
                        NumComp++;

                        
                    }
                }

            }

            return NumComp;
        }

        public int Insercao()
        {
            int eleito;
            int NumCompI = 0;
            int k;

            for (int i = 1; i < TamVetor; i++)
            {
                eleito = Vetor[i];
                
                k = i - 1;
                while ((k >= 0) && (Vetor[k] < eleito))
                {
                    Vetor[k + 1] = Vetor[k];
                   
                    k--;

                    NumCompI++;
                }
                Vetor[k + 1] = eleito;
                
            }

            return NumCompI;
        }

        public int Selecao()
        {
            int posmenor;
            int aux;
            int NumCompS = 0;

            for (int j = 0; j < TamVetor; j++)
            {
                posmenor = j;
                for (int i = j + 1; i < TamVetor; i++)
                {
                    if (Vetor[i] < Vetor[posmenor])
                    {
                        posmenor = i;
                        NumCompS++;
                    }

                    aux = Vetor[j];
                    Vetor[j] = Vetor[posmenor];
                    Vetor[posmenor] = aux;
                }
            }

            return NumCompS;
        }


    }
}