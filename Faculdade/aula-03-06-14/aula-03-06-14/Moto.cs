using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_03_06_14
{
    class Moto:Veiculo
    {
        private string tamanho;

        public Moto(string marca, double velocidade, string tamanho)
        {
            this.tamanho = tamanho;
            base.setMarca(marca);
        }



    }
}
