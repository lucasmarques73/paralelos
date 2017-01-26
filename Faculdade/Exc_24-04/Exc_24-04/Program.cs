using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Exc_24_04
{
    class Program
    {
        static void Main(string[] args)
        {

            Ordena obj = new Ordena();

           int NumCompBolha = obj.Bolha();
           Console.WriteLine("O numero de comprações é :"+NumCompBolha);

           int NumCompInsercao = obj.Insercao();
           Console.WriteLine("O numero de comprações é :" + NumCompInsercao);

           int NumCompSelecao = obj.Selecao();
           Console.WriteLine("O numero de comprações é :" + NumCompSelecao);
            

        }
    }
}
