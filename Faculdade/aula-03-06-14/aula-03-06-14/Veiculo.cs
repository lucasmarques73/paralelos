using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_03_06_14
{
    class Veiculo
    {
        private string marca;
        private double velocidade;

        public Veiculo()
        {
 
        }
        
        public Veiculo(string marca, double velocidade)
        {
            this.marca = marca;
            this.velocidade = velocidade;            
        }

        public string getMarca()
        {
            return this.marca;
        }

        public void setMarca(string marca)
        {
            this.marca = marca;
        }

        public string Marca
        {
            get { return marca; }
            set { this.marca = value; }
        }


    }
}
