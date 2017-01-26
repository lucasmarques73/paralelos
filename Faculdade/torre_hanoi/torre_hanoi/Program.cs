using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace torre_hanoi
{
    class Program
    {
        static void Main(string[] args)
        {

           Console.WriteLine("Entre com numero de discos");
            double numero = Convert.ToDouble(Console.ReadLine());
       
           
            
            moverTorre(numero, 'A', 'B', 'C');
            Console.WriteLine("\nEste é o Numero de Discos: " + numero);
        //    Console.WriteLine("\nNumero de Movimentos: " + cont);
            Console.ReadLine();
        }
    
        public static void moverTorre(double n, char origem, char dest, char aux)
        {
            if (n == 1)
            {
                Console.WriteLine("Mova disco de "+ origem +" para "+ dest);
            }
            else
            {
                moverTorre(n - 1, origem, aux, dest);
                Console.WriteLine("Mova disco de " + origem + " para " + dest);
                moverTorre(n - 1, aux, dest, origem);
            }
        }
        
    }
}
