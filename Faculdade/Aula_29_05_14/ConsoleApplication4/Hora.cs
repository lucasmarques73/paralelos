using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication4
{
    class Hora
    {
        private int hora;           //0 a 23
        private int minuto;         //0 a 59
        private int segundo;        //0 a 59


        public Hora()
        {
             //atribuir valor zero (0) a todos atributos
            hora = 0;
            minuto = 0;
            segundo = 0;
            
        }

        public Hora(int hora, int minuto, int segundo) //Construtor com parametros
        {

            AjustaHora(hora, minuto, segundo);    
        }

        public void AjustaHora(int hora, int minuto, int segundo)// Metodo para alteraçao das horas
        {
            this.hora = (hora >= 0 && hora < 24) ? hora : 0; // interrogação indica if e dois pontos indica else

            this.minuto = (minuto >= 0 && minuto < 60) ? minuto : 0;

            this.segundo = (segundo >= 0 && segundo < 60) ? segundo : 0;

        }

        public int _hora// Propriedade para alteraçao das horas, minutos ou segundos
        {
            set
            {
                this.hora = (value >= 0 && value < 24) ? hora : 0; // interrogação indica if e dois pontos indica else
            }
            get
            {
                return this.hora;
            }
        }
         public int _minuto// Propriedade para alteraçao das horas, minutos ou segundos
        {
            set
            {
             this.minuto = (value >= 0 && value < 60) ? hora : 0; // interrogação indica if e dois pontos indica else
            }
            get
            {
                return this.minuto;
            }

        }
         public int _segundo// Propriedade para alteraçao das horas, minutos ou segundos
        {
            set
            {
                this.segundo = (value >= 0 && value < 60) ? hora : 0; // interrogação indica if e dois pontos indica else
            }
            get
            {
                return this.segundo;
            }

        }

    }
}
