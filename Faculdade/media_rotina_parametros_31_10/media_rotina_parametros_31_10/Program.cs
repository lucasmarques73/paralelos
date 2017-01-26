using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace media_rotina_parametros_31_10
{
    class Program
    {
        public static double media(double av1, double av2, double av3)
        {

            double media = ((av1 * 0.5) + (av2 * 0.2) + (av3 * 0.3));

            return (media);

        }
        static void Main(string[] args)
        {
           double nav1, nav2,  nav3;
           Console.WriteLine("AV1:");
           nav1 = double.Parse(Console.ReadLine());
           Console.WriteLine("AV2:");
           nav2 = double.Parse(Console.ReadLine());
           Console.WriteLine("AV3:");
           nav3 = double.Parse(Console.ReadLine());

            double media_aluno = media(nav1, nav2, nav3);

            Console.WriteLine("A media do aluno:"+media_aluno);

            Console.ReadKey();
        }

      

    }
}
