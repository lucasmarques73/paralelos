using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace valida_data
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Digite uma data:(DD/MM/AAAA)");
            string data = Console.ReadLine();


            int dia, mes, ano;

            string[] data2 = data.Split('/');
            dia = int.Parse(data2[0]);
            mes = int.Parse(data2[1]);
            ano = int.Parse(data2[2]);

            Console.WriteLine(dia+"/"+mes+"/"+ano);
            
             if (valida_data(data) == false)
            {
                Console.WriteLine("Data inválida");
            }
             else Console.WriteLine("Data Válida");

            Console.ReadKey();
        }

        public static bool valida_data(string data)
        {
            int dia, mes, ano;

            string[] data2 = data.Split('/');
            dia =int.Parse( data2[0]);
            mes = int.Parse(data2[1]);
            ano = int.Parse(data2[2]);

            if ((mes >= 1) || (mes >= 12))
            {
                if ((mes == 1) || (mes == 3) || (mes == 5) || (mes == 7) || (mes == 8) || (mes == 10) || (mes == 12))
                    if((dia >= 1) && (dia <= 31))
                            return true;
            }
               else if((mes == 4)|| (mes == 6)||(mes == 9)||(mes == 11))
            {
                 if((dia>=1)&&(dia <=30))
                   return true;
            }
            else if ((ano % 4 == 0) && (ano % 400 != 0))
            {
                if ((dia >= 1) && (dia <= 29))
                    return true;
                else if ((dia >= 1) && (dia <= 28))
                {
                    return true;
                }
            }
            else
            {
                return false;
            }

            return false;
            


            
        }

       
    }
}
