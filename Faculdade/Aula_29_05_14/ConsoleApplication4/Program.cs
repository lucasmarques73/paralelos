using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication4
{
    class Program
    {
        static void Main(string[] args)
        {

            Hora horario = new Hora(23,34,45);

            horario.AjustaHora(18, 35, 22);
            horario._hora = 21;



        }
    }
}
