using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_03_06_14
{
    class Carro : Veiculo
    {
        private int numPortas;

        public Carro(string marca, double velocidade, int numPortas)
        {
            this.numPortas = numPortas;
           // base.setMarca(marca);
            base.Marca = marca;
                    
        }

        public int getPortas()
        {
            return this.numPortas;

        }
        public void setNumPortas(int numPortas)
        {
            this.numPortas = numPortas;
        }


        


    }
}
