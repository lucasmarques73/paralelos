using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exercicio_Kleber_Classe_Vetor
{
    class Ordena
    {
        // Variáveis de instância
        private int[] vetor;
        private int TamVetor;

        // Construtores - Sempre o nome do construtor é igual ao da classe.
        public Ordena()
        {
            TamVetor = 10;
            CriarVetor();
        }

        public Ordena(int tamanho)
        {
            TamVetor = tamanho;
            CriarVetor();
        }

        // Métodos
        private void CriarVetor()
        {
            // Criando o vetor
            vetor = new int[TamVetor];

            // Preenchimento do vetor
            Random X = new Random(); // Comando de preenchimento aleatório

            for (int cont = 0; cont < TamVetor; cont++)
            {
                vetor[cont] = X.Next(100); // Comando next(100) gera os números aleatórios nesse caso nunca > 100
            }
        }
        public void Imprime()
        {
            for (int cont = 0; cont < TamVetor; cont++)
                Console.Write(vetor[cont] + " ");
        }

        public void Bolha()
        {
            int j = 1; bool troca = true;
            while ((j < TamVetor) && (troca))
            {
                troca = false;
                for (int i = 0; i < (TamVetor - j); i++)
                {
                    int aux = vetor[i];
                    vetor[i] = vetor[i + 1];
                    vetor[i + 1] = aux;
                    troca = true;
                }
                j++;
            }
        }

    }
}
